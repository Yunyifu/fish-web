<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace api\common\controllers;

use common\models\User;
use common\models\UserOauth;
use common\models\Goods;
use common\models\Demand;
use common\models\Order;
use common\service\UserService;
use common\util\CacheUtil;
use common\util\Constants;
use common\util\Utils;
use common\util\YunPianManager;
use yii\base\UserException;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UnauthorizedHttpException;
use Yii;

/**
 * user
 *
 * @author Ather.Shu Apr 22, 2015 11:52:56 AM
 */
class UserController extends BaseController {

    public $needLoginActions = [ 
        'index',
        'bind',
        'update',
        'logout' 
    ];

    /**
     * {get} /users/check-mobile 检测手机号是否已注册
     * @apiVersion 0.1.0
     * @apiParam {string} mobile 手机号
     *
     * @apiGroup user
     *
     * @apiSuccess data 1已注册 0未注册
     * @apiSuccessExample 范例
     * {
     * "data": 1
     * }
     */
    /**
     * 检测手机号是否已注册
     *
     * @throws UnauthorizedHttpException
     * @return number
     */
    public function actionCheckMobile() {
        $mobile = $this->getParam( 'mobile', null, true );
        if( empty( $mobile ) ) {
            throw new UnauthorizedHttpException();
        }
        $count = UserOauth::find()->where( [ 
            'type' => Constants::OAUTH_MOBILE,
            'external_uid' => $mobile 
        ] )->count();
        if( $count > 0 ) {
            return 1;
        }
        return 0;
    }

    /**
     * @api {post} /users/code 获取手机验证码
     * @apiVersion 0.1.0
     * @apiParam {string} mobile 手机号
     * @apiParam {int} type 0代表正常注册 1代表重置密码
     * @apiGroup user
     *
     * @apiSuccessExample （调试阶段默认验证码8888）
     * {
     * "data": "验证码发送成功，请注意查收",
     * "api_code": 200
     * }
     */
    /**
     * 获取短信验证码
     */
    public function actionCode() {
        $mobile = $this->getParam( 'mobile' );
        $type = $this->getParam('type');
        if($type == 0)
        {
            $isReg = UserOauth::find()->where( [
                'type' => Constants::OAUTH_MOBILE,
                'external_uid' => $mobile
                ] )->count();
            if($isReg){
                throw new UserException('您的手机号码已注册，请直接登陆');
            }
        }

        if( empty( $mobile ) ) {
            throw new UnauthorizedHttpException();
        }
        $code = 8888;
        // $code = rand( 1000, 9999 );
        CacheUtil::setCache( Constants::CACHE_USER_MOBILE_CODE, $code, [ 
            'mobile' => $mobile 
        ] );
        $rtn = true;
        // $rtn = YunPianManager::sendSMS( $mobile, $code );
        if( $rtn === true ) {
            return "验证码发送成功，请注意查收";
        } else {
            throw new UserException( $rtn );
        }
    }

    /**
     * 登录某个device(可能会注册)
     */
    private function loginDevice($user) {
        $device = \Yii::$app->getRequest()->getHeaders()->get( 'Device' );
        
        $userDevice = UserService::loginDevice($user, $device);
        $this->userDevice = $userDevice;
        \Yii::$app->user->login( $user);
        //$id = $user->getId();
        return [
            'token' => $userDevice->access_token,
            'user' => $user ,
            //'id' => $id

        ];
    }

    /**
     * @api {post} /users/login 手机号密码登录
     * @apiVersion 0.1.0
     *
     * @apiParam {string} username 手机号
     * @apiParam {string} password 密码
     *
     * @apiGroup user
     *
     * @apiSuccessExample 范例
     *
     * {
        "token": "5922dfb409c22_1495457716",
        "user": {
            "id": 7,
            "nickname": "用户149545734357",
            "avatar": "/img/avatar.png",
            "gender": 0,
            "birthday": null,
            "reg_time": 1495457344,
            "oauths": [
            {
            "type": 1,
            "external_uid": "15889891234",
            "external_name": "yifu3"
            }
            ],
            "devices": [
            {
            "device": "123",
            "last_active": 1495457344
            },
            {
            "device": "in",
            "last_active": 1495457716
            }
            ],
            "referee": null
            },
        "api_code": 200
        }
     *
     */

    public function actionLogin() {

        $username = $this->getParam( 'username' );
        $password = $this->getParam( 'password' );

        if( empty( $username ) || empty( $password ) ) {
            throw new UnauthorizedHttpException();
        }
        // $user = User::findByUsername( $username );
        $oauth = UserOauth::findOne( [ 
            'external_uid' => $username,
            'type' => Constants::OAUTH_MOBILE 
        ] );
        if( !empty( $oauth ) ) {
            /* @var $user User */
            $user = $oauth->user;
        }
        if( empty( $user ) || !$user->validatePassword( $password ) ) {
            throw new UserException( '手机号或者密码错误' );
        } else {

            return $this->loginDevice( $user );
        }
    }

    /**
     * @api {post} /users/oauth 第三方(含手机)注册或登录
     * @apiDescription 只有未登录时会调用
     * @apiVersion 0.1.0
     *
     * @apiParam {int} type 第三发登录类型，1手机 2微博 3QQ 4微信app 5微信公众号
     * @apiParam {string} external_uid 第三方uid，可能是手机号
     * @apiParam {string} external_name 第三方昵称，可能是手机号
     * @apiParam {string} token 第三方token，可能是手机验证码
     * @apiParam {string} password 如果是手机注册，必须设置密码
     * @apiParam {string} other 如果是微信登录必填，传入unionId
     * @apiParam {string} avatar 非必填，头像地址（如果第三方有）
     * @apiParam {int} gender 非必填，性别 0女 1男
     *
     * @apiGroup user
     *
     * @apiSuccess {string} id 用户id
     * @apiSuccessExample 没有则注册，否则登录
     * {
     *  {
        "token": "5922de40a162b_1495457344",
        "user": {
            "id": 7,
            "nickname": "用户149545734357",
            "avatar": "/img/avatar.png",
            "gender": null,
            "birthday": null,
            "reg_time": 1495457344,
            "oauths": [
            {
            "type": 1,
            "external_uid": "15889891234",
            "external_name": "yifu3"
            }
            ],
            "devices": [
            {
            "device": "123",
            "last_active": 1495457344
            }
            ],
            "referee": null
            },
        "api_code": 200
    }
     * }
     */
    /**
     * 手机号注册登录、第三方注册登录
     */
    public function actionOAuthLogin() {
        $referee = $this->getParam( 'referee' );
        if( !empty( $referee ) ) {
            $referee = Utils::decryptId( $referee, Constants::ENC_TYPE_USER );
        }
        $datas = [
            'type' => $this->getParam( 'type', Constants::OAUTH_MOBILE ),
            'externalUid' => $this->getParam( 'external_uid' ),
            //'username' => $this->getParam( 'username' ),
            'externalName' => $this->getParam( 'external_name' ),
            //'nickname' => $this->getParam( 'nickname' ),
            'token' => $this->getParam( 'token' ),
            'other' => $this->getParam( 'other' ),
            
            'password' => $this->getParam( 'password' ),
            'gender' => $this->getParam( 'gender', 0 ),
            'avatar' => $this->getParam( 'avatar' ),
            'referee' => $referee,
        ];

        $user = UserService::register($datas);
        return $this->loginDevice( $user );
    }

    /**
     * @api {post} /users/reset-pwd 修改或重置密码
     * @apiVersion 0.1.0
     *
     * @apiParam {string} mobile 手机号
     * @apiParam {string} code 手机验证码
     * @apiParam {string} password 新密码
     *
     * @apiGroup user
     *
     * @apiSuccessExample 范例
     * 同登录
     */
    /**
     * 重置密码或者修改密码
     *
     * @throws UserException
     */
    public function actionResetPwd() {
        $mobile = $this->getParam( 'mobile' );
        $code = $this->getParam( 'code' );
        $pwd = $this->getParam( 'password' );
        
        $ocode = CacheUtil::getCache( Constants::CACHE_USER_MOBILE_CODE, [ 
            'mobile' => $mobile 
        ] );
        if( empty( $ocode ) || $ocode != $code ) {
            throw new UserException( '验证码错误' );
        }
        if( empty( $pwd ) ) {
            throw new UserException( '请设置新密码' );
        }
        if( strlen( $pwd ) < 6 ) {
            throw new UserException( '密码长度不能小于6' );
        }
        $user = User::findByOAuth( Constants::OAUTH_MOBILE, $mobile );
        if( empty( $user ) ) {
            throw new NotFoundHttpException( '用户不存在' );
        }
        $user->password = $pwd;
        $user->save();
        return $this->loginDevice( $user );
    }

    /**
     * @api {post} /users/logout 退出登录
     * @apiVersion 0.1.0
     *
     * @apiGroup user
     * @apiPermission token
     *
     * @apiSuccessExample 范例
     * {
     * "data": 1,
     * "api_code": 200
     * }
     */
    /**
     * 退出
     *
     * @return number
     */
    public function actionLogout() {
        $userDevice = $this->userDevice;
        // 重新生成access token、清空推送cid
        $userDevice->logout();
        return 1;
    }

    /**
     * @api {get} /users 取当前登录用户信息
     * @apiVersion 0.1.0
     *
     * @apiGroup user
     * @apiPermission token
     *
     * @apiSuccessExample 范例
     * 同第三方登录里的user
     */
    /**
     * 获取基本个人信息
     */
    public function actionIndex() {
        $user = \Yii::$app->getUser()->getIdentity();
        return $user;
    }

    /**
     * @api {post} /users/bind 绑定（换绑）手机号、微信
     * @apiVersion 0.1.0
     *
     * @apiGroup user
     * @apiPermission token
     *
     * @apiParam {int} type 第三发登录类型，1手机 2微博 3QQ 4微信app 5微信公众号
     * @apiParam {string} external_uid 第三方uid，可能是手机号
     * @apiParam {string} external_name 第三方昵称，可能是手机号
     * @apiParam {string} token 第三方token，可能是手机验证码
     * @apiParam {string} other 如果是微信登录必填，传入unionId
     *
     * @apiSuccessExample 范例
     * 同获取当前登录用户信息
     */
    /**
     * 重新绑定第三方
     */
    public function actionBind() {
        /* @var User $user */
        $user = \Yii::$app->getUser()->identity;
        
        $datas = [
            'type' => $this->getParam( 'type', Constants::OAUTH_MOBILE ),
            'externalUid' => $this->getParam( 'external_uid' ),
            'externalName' => $this->getParam( 'external_name' ),
            'token' => $this->getParam( 'token' ),
            'other' => $this->getParam( 'other' ),
        ];
        $oauth = UserService::bind($user, $datas);
        return $user;
    }

    /**
     * @api {post} /users 更新当前登录用户资料
     * @apiVersion 0.1.0
     *
     * @apiGroup user
     * @apiPermission token
     *
     * @apiParam {string} nickname 昵称
     * @apiParam {string} avatar 头像
     * @apiParam {string} push_cid 推送cid（如个推cid）
     * @apiParam {int} gender 性别（0为女，1为男）
     * @apiParam {string} birthday 生日（字符串如1985-12-26）
     *
     * @apiSuccessExample 范例（注：更新哪些字段就传哪些字段）
     * 同获取当前登录用户信息
     */
    /**
     * 更新个人信息
     */
    public function actionUpdate() {
        /* @var $user User */
        $user = $this->getUser();
        // // 设置推荐人
        // $referee = $this->getParam( 'referee' );
        // if( !empty( $referee ) ) {
        // $referee = Utils::decryptId( $referee, Constants::ENC_TYPE_USER );
        // if( $user->referee_id ) {
        // throw new UnauthorizedHttpException( '推荐人仅允许设置一次' );
        // }
        // if( $user->findOne( $referee ) == null ) {
        // throw new NotFoundHttpException( '推荐人不存在' );
        // }
        // $user->referee_id = $referee;
        // }
        // 更改昵称、头像
        $nickName = $this->getParam( 'nickname' );
        if( !empty( $nickName ) ) {
            $user->nickname = $nickName;
        }
        $avatar = $this->getParam( 'avatar' );
        if( !empty( $avatar ) ) {
            $user->avatar = $avatar;
        }
        // 更改性别、生日
        $gender = $this->getParam( 'gender' );
        if( isset( $gender ) ) {
            $user->gender = $gender;
        }
        $birthday = strtotime( $this->getParam( 'birthday' ) );
        if( !empty( $birthday ) ) {
            $user->birthday = $birthday;
        }
        // 更改推送cid
        $pushCid = $this->getParam( "push_cid" );
        if( !empty( $pushCid ) ) {
            $this->userDevice->push_cid = $pushCid;
            $this->userDevice->save();
        }
        if( $user->save() ) {
            return $user;
        } else {
            throw new UserException( '用户信息更新失败' );
        }
    }

    /**
     * @api {post} /user/mygoods/ 我的发布-供应信息
     * @apiVersion 0.1.0
     *
     * @apiGroup user
     * @apiPermission token
     * @apiParam {int} good_id 商品id，如果不传，则默认显示该用户的所有
     * @apiParam {int} page 第几页，分页用,如果不传，则默认显示该用户的所有
     * @apiParam {int} pageSize 每页显示多少条,如果不传，则默认显示该用户的所有
     *
     * @apiSuccessExample 范例（注：点击之后默认显示供应信息）
     *
     *{
            "data": [
                {
                    "id": 1,
                    "title": "杭州湾鱿鱼1吨，欢迎采购！",
                    "thumb": "2/123.jpg",
                    "user_id": 4,
                    "category_id": 1,
                    "num": 1,
                    "price": "198.00",
                    "area": "杭州湾码头",
                    "position": "中国浙江杭州",
                    "status": 1,
                    "desc": "杭州湾有新鲜鱿鱼1吨，量大从优！",
                    "pic": "/2/1.jpg||/2/2.jpg",
                    "created_at": 1,
                    "updated_at": null,
                    "rank": 9999,
                    "username": "15889897125",
                    "nickname": "用户1494929694644",
                    "avatat": "123456789",
                    "gender": 0,
                    "categoryId": 1,
                    "categoryName": "鱼类",
                    "categoryParent_id": null
                },
                {
                    "id": 3,
                    "title": "杭州湾贝壳2吨，欢迎采购！",
                    "thumb": "2/123.jpg",
                    "user_id": 4,
                    "category_id": 1,
                    "num": 1,
                    "price": "198.00",
                    "area": "杭州湾码头2",
                    "position": "中国浙江杭州2",
                    "status": 1,
                    "desc": "杭州湾有新鲜鱿鱼1吨，量大从优！",
                    "pic": "/2/1.jpg||/2/2.jpg",
                    "created_at": 2,
                    "updated_at": null,
                    "rank": 9999,
                    "username": "15889897125",
                    "nickname": "用户1494929694644",
                    "avatat": "123456789",
                    "gender": 0,
                    "categoryId": 1,
                    "categoryName": "鱼类",
                    "categoryParent_id": null
                },
            ],
            "api_code": 200
      }
     */
    public function actionMygoods()
    {
        $userId = $this->getUser()->getId();
        $goods_id = $this->getParam('goods_id');
        $page = $this->getParam('page',0);
        $pageSize = $this->getParam('pageSize',20);
        if(empty($goods_id))
        {
            //$result = Goods::findAll(['user_id' => $userId]);
            $query = Goods::find()->where(['user_id'=>$userId])->andWhere(['status' => 1]);
            //$count = $query->count();
            //$pager = new Pagination(['totalCount' => $count,'pageSize'=> $pageSize,'page'=>$page]);
            $query = $query->offset($page*$pageSize)->limit($pageSize)->orderBy('updated_at DESC')->all();
            return $query;
        }elseif($goods_id)
        {
            $result = Goods::find()->where('user_id = :uid and id = :gid',[":uid" => $userId, ":gid" => $goods_id])->one();
            if(!empty($result))
            {
                return $result;
            }else{
                throw new BadRequestHttpException('不能编辑不属于自己的信息！');
            }

        }
        return '您还未发布过该类信息';

    }

    /**
     * @api {post} /user/mydemand 我的发布-需求信息信息
     * @apiVersion 0.1.0
     *
     * @apiGroup user
     * @apiPermission token
     * @apiParam {int} demand_id 需求信息id,如果不传，则默认显示该用户的所有
     * @apiParam {int} page 第几页，分页用,如果不传，则默认显示该用户的所有
     * @apiParam {int} pageSize 每页显示多少条,如果不传，则默认显示该用户的所有
     *
     * @apiSuccessExample 范例
     *
     *{
        "data": [
            {
            "id": 1,
            "title": "新疆喀什地区需求咸鱼1吨~",
            "thumb": "2/5.jpg",
            "user_id": 4,
            "category_id": 1,
            "num": "1",
            "price": "2000.00",
            "area": "新疆地区",
            "position": "中国新疆喀什市",
            "status": 1,
            "desc": "我们这里想买鱼，有人有货吗？",
            "pic": "2/123.jpg||2/234.jpg",
            "created_at": 1,
            "updated_at": null,
            "demandstatus": "要新鲜",
            "otherstatus": "我其它需求是尽快发货",
            "username": "15889897125",
            "nickname": "用户1494929694644",
            "avatat": "123456789",
            "gender": 0,
            "categoryId": 1,
            "categoryName": "鱼类",
            "categoryParent_id": null
             }
             ]
        "api_code": 200
     * }
     */
    public function actionMydemand()
    {
        $userId = $this->getUser()->getId();
        $demand_id = $this->getParam('demand_id');
        $page = $this->getParam('page');
        $pageSize = $this->getParam('pageSize');
        if(empty($demand_id))
        {
            $query = Demand::find()->where(['user_id'=>$userId])->andWhere(['status' => 1]);
            //$count = $query->count();
            //$pager = new Pagination(['totalCount' => $count,'pageSize'=> $pageSize,'page'=>$page]);
            $query = $query->offset($page*$pageSize)->limit($pageSize)->orderBy('updated_at DESC')->all();
            return $query;
        }elseif($demand_id)
        {
            $result = Goods::find()->where('user_id = :uid and id = :gid',[":uid" => $userId, ":gid" => $demand_id])->one();
            if(!empty($result))
            {
                return $result;
            }else{
                throw new BadRequestHttpException('不能编辑不属于自己的信息！');
            }

        }
        return '您还未发布过该类信息';

    }

    /**
     * @api {post} /user/sell 已售出
     * @apiVersion 0.1.0
     * @apiParam {int} order_id 订单id,如果不传，则默认显示该用户的所有
     * @apiParam {int} page 第几页，分页用,如果不传，则默认显示该用户的所有
     * @apiParam {int} pageSize 每页显示多少条,如果不传，则默认显示该用户的所有
     * @apiGroup user
     * @apiPermission token
     *
     *
     * @apiSuccessExample 范例
     ** {
        "data": [
            {
                "id": 7,
                "type": 0,
                "goods_id": 15,
                "sn": "201705270958395826",
                ....信息太长就不显示了
            }
            ],
        "api_code": 200
        }
     */

    public function actionSell()
    {
        $userId = $this->getUser()->getId();
        $orderId = $this->getParam('order_id');
        $page = $this->getParam('page');
        $pageSize = $this->getParam('pageSize');
        if(empty($orderId)){
            $query = Order::find()->where(['seller_id'=>$userId]);
            //$count = $query->count();
            //$pager = new Pagination(['totalCount' => $count,'pageSize'=> $pageSize,'page'=>$page]);
            $query = $query->offset($page*$pageSize)->limit($pageSize)->orderBy('updated_at DESC')->all();

            return $query;
        }elseif($orderId){
            return $result = Order::find()->where('seller_id = :sid and id = :oid',[':sid' => $userId,':oid' => $orderId])->all();

        }else{
            return [];
        }

    }

    /**
     * @api {post} /user/buy 已购买
     * @apiVersion 0.1.0
     * @apiParam {int} order_id 订单id,如果不传，则默认显示该用户的所有
     * @apiParam {int} page 第几页，分页用,如果不传，则默认显示该用户的所有
     * @apiParam {int} pageSize 每页显示多少条,如果不传，则默认显示该用户的所有
     * @apiGroup user
     * @apiPermission token
     *
     *
     * @apiSuccessExample 范例 status 0代表订单未支付 1代表已支付，等待确认 2代表卖家已接单订单服务中 3代表服务完成，待买家确认 4代表订单已完成 5代表退货或退款
     *
     * {
            "data": [
            {
                "id": 7,
                "type": 0,
                "goods_id": 15,
                "sn": "201705270958395826",
                "status": 3,
                "before_refund_status": 0,
                "refund_status": 0,
                "refund_amount": "0.00",
                "refund_balance": "0.00",
                "refund_paid": "0.00",
                "refund_reason": null,
                "goods_amount": "33.00",
                "pay_type": 3,
                "pay_platform": null,
                "pay_trade_no": null,
                "goods_name": "发布商品信息测试！",
                "goods_price": "99.00",
                "seller_id": 6,
                "buyer_id": 5,
                "buyer_name": null,
                "buyer_mobile": null,
                "buyer_addr": null,
                "message": null,
                "pay_time": null,
                "post_pay_time": null,
                "created_at": null,
                "updated_at": null
            }
            ],
                "api_code": 200
        }
     */

    public function actionBuy()
    {
        $userId = $this->getUser()->getId();
        $orderId = $this->getParam('order_id');
        $page = $this->getParam('page');
        $pageSize = $this->getParam('pageSize');
        if(empty($orderId)){
            $query = Order::find()->where(['buyer_id'=>$userId])->andWhere(['!=','status',Constants::ORDER_STATUS_DELETE]);
            //$count = $query->count();
            //$pager = new Pagination(['totalCount' => $count,'pageSize'=> $pageSize,'page'=>$page]);
            $query = $query->offset($page*$pageSize)->limit($pageSize)->orderBy('updated_at DESC')->all();
            return $query;
        }elseif($orderId){
            return $result = Order::find()->where('buyer_id = :sid and id = :oid',[':sid' => $userId,':oid' => $orderId])->all();
        }else{
            return [];
        }

    }

    /**
     * @api {post} /user/delete 删除
     * @apiVersion 0.1.0
     * @apiParam {int} goods_id 要删除的供应信息id
     * @apiParam {int} demand_id 要删除的需求信息id
     * @apiGroup user
     * @apiPermission token
     *
     *
     * @apiSuccessExample
     * {
     *    "data": "删除供应信息成功！",
     *    "api_code": 200
     * }
     *
     */

    public function actionDelete()
    {
        $user_id = Yii::$app->getUser()->getId();
        $goods_id = $this->getParam('goods_id');
        $demand_id = $this->getParam('demand_id');
        if($goods_id){
            $goods = Goods::findOne($goods_id);
            if($goods->user_id == $user_id){
                $goods->status = 0;
                $goods->update();
                return '删除供应信息成功！';
            }else{
                throw new BadRequestHttpException('不能删除不是自己发布的供应信息！');
            }
        }elseif($demand_id){
            $demand = Demand::findOne($demand_id);
            if($demand->user_id == $user_id){
                $demand->status = 0;
                $demand->update();
                return '删除需求信息成功！';
            }else{
                throw new BadRequestHttpException('不能删除不是自己发布的需求信息！');
            }
        }else{
            throw new BadRequestHttpException('删除失败，请重试！');
        }

    }





}