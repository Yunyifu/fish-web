<?php
namespace api\common\controllers;

use backend\models\AdminUser;
use common\models\Goods;
use common\models\User;
use common\models\UserDevice;
use common\util\Constants;
use yii\web\BadRequestHttpException;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use Yii;

class GoodsController extends BaseController
{
    public $needLoginActions = [
        'add'
    ];

    public function actionIndex()
    {

        $pageSize = \Yii::$app->request->get('pageSize');
        $page = \Yii::$app->request->get('page');
        $model = Goods::find()->joinWith('user')->joinWith('category');
        $count = $model->count();
        $pager = new Pagination(['totalCount' => $count,'pageSize'=> $pageSize,'page'=>$page]);
        $goods = $model->offset($pager->offset)->limit($pager->limit)->orderBy('created_at DESC')->all();

        return $goods;

    }



    /**
     * @api {post} /goods/search 搜索供应信息
     * @apiVersion 0.1.0
     * @apiParam {string} keyword 关键字，如果不传此参数则直接按发布时间、page、pageSize排序显示
     * @apiParam {int} start 起始id
     * @apiParam {int} page 页码 默认从第0页开始
     * @apiParam {int} pageSize 一页数量,默认为20
     * @apiParam {int} categoryId 分类ID
     * @apiParam {int} orderTime 根据时间排序，1 代表升序，2 代表降序
     * @apiGroup Goods
     *
     *
     * @apiSuccessExample
     * {
       "data": [
                 {
                    "id": 4,
                    "title": "杭州湾程序猿3吨，欢迎采购！",
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
                    "created_at": 3,
                    "updated_at": null,
                    "username": "15889897125",
                    "nickname": "用户1494929694644",
                    "avatat": "123456789",
                    "gender": 0,
                    "categoryId": 1,
                    "categoryName": "鱼类",
                    "categoryParent_id": null
                 }
              ],
        "api_code": 200
     *}
     */
     public function actionSearch()
     {
         $keyword = $this->getParam('keyword');
         $page = $this->getParam('page',0);
         $pageSize = $this->getParam('pageSize',20);
         $categoryId = $this->getParam('categoryId');
         $start = $this->getParam('start',0);
         $orderTime = $this->getParam('orderTime',1);
         if($keyword)
         {
             $query = Goods::find()->where(['like','title',$keyword])->andWhere(['goods.status' =>1])->orWhere(['like','desc',$keyword])->orWhere(['like','area',$keyword])->orWhere(['like','position',$keyword]);
             $query = $query->offset($page*$pageSize)->limit($pageSize)->orderBy('created_at DESC');

         }else{
             $query = Goods::find()->where(['goods.status' => 1]);
             $query = $query->offset($page*$pageSize)->limit($pageSize)->orderBy('created_at DESC');
         }
         if(!empty($categoryId))
         {

             $query->andWhere(['category_id'=> $categoryId])->joinWith('category');

         }
         if(!empty($start)){
            $query->andWhere(['<','goods.id',$start]);
         }
         if($orderTime == 2)
         {
             $query->orderBy('created_at ASC');
         }
         if(empty($query->all()))
         {
             return [];
         }
         return $query->all();
     }

    /**
     * @api {get} /goods/detail 获取供应信息详情
     * @apiVersion 0.1.0
     * @apiParam {int} goodsId 商品ID
     * @apiGroup Goods
     *
     *
     * @apiSuccessExample
     * {
            "good": {
                    "id": 31,
                    "title": "罗非鱼2吨",
                    "thumb": null,
                    "user_id": 10,
                    "category_id": 4,
                    "num": "",
                    "price": "0.00",
                    "area": "杭州滨江区",
                    "position": "",
                    "status": 0,
                    "desc": "321",
                    "pic": [
                    "/2/14981871893824.jpg"
                    ],
                    "created_at": 1498187190,
                    "updated_at": 1498711904,
                    "rank": 5,
                    "username": "15889892345",
                    "nickname": "用户1497943476853",
                    "avatat": "http://dev.image.alimmdn.com/1/default.jpg@294w_196h_1l",
                    "gender": 0,
                    "categoryId": 4,
                    "categoryName": "罗非鱼",
                    "categoryParent_id": 1,
                    "dealer": "交易员1号"
            },
            "phone": "138123456",
            "api_code": 200
        }
     */
    public function actionDetail($goodsId)
    {
        $good = Goods::findone($goodsId);
        $user = User::findOne($good->user_id);
        $phone = AdminUser::findOne($user->dealer_id)->phone;
        if( empty( $good ) ) {
            throw new NotFoundHttpException("信息不存在");
        }
        return [
            'good' => $good,
            'phone' => $phone
        ];
    }

    /**
     * @api {post} /goods/add 发布供应信息详情
     * @apiVersion 0.1.0
     * @apiParam {varchar} title 标题
     * @apiParam {int} category_id categoryID
     * @apiParam {text} desc 描述详情
     * @apiParam {area} area 货物所在地区
     * @apiParam {array} pic 图片
     * @apiGroup Goods
     * @apiSuccessExample
     * {
        "data": "恭喜，发布成功，等待管理员审核！",
        "api_code": 200
     * }
     */
    public function actionAdd()
    {

        $post = Yii::$app->request->post();
        $post['user_id'] = \Yii::$app->getUser()->getId();
        $model = new Goods();
        $model->load($post,'');
        $model->pic = implode(Constants::IMG_DELIMITER,$post['pic']);
        if($model->save($post))
        {
            return '恭喜，发布成功，等待管理员审核！';
        }else{
            //return $model->getErrors();
            throw new BadRequestHttpException('发布失败，请重试！');
        }

    }
    /**
     * @api {post} /goods/update 更新供应信息详情
     * @apiVersion 0.1.0
     * @apiParam {int} goods_id 标题
     * @apiParam {varchar} title 标题
     * @apiParam {int} category_id categoryID
     * @apiParam {text} desc 描述详情
     * @apiParam {area} area 货物所在地区
     * @apiParam {varchar} pic 图片
     * @apiGroup Goods
     * @apiSuccessExample
     * {
    "data": "恭喜，更新成功，等待管理员审核！",
    "api_code": 200
     * }
     */
    public function actionUpdate()
    {

        $post = Yii::$app->request->post();
        $post['user_id'] = \Yii::$app->getUser()->getId();
        $model = Goods::findOne(['id' => $post['goods_id']]);
        if($model->user_id !== $post['user_id']){
            throw new BadRequestHttpException('不能更新不属于自己的商品！');
        }
        $model->load($post,'');
        $model->pic = implode(Constants::IMG_DELIMITER,$post['pic']);
        if($model->update($post))
        {
            return '恭喜，更新成功，等待管理员审核！';
        }else{
            //return $model->getErrors();
            throw new BadRequestHttpException('更新失败，请重试！');
        }

    }



    //更新订单状态
    public function actionSetstatus($good_id){
        $goods = new Goods();
        if($goods->setStatus($good_id)){
            return '商品状态更新成功';
        }else{
            return '状态更新失败';
        }
    }

    /**
     * 设置为询价状态
     */

    public function actionInquiry($goods_id){
        $goods = Goods::findOne(['id' => $goods_id]);
        $goods->status = Constants::GOODS_INQUIRY;
        if($goods->update()){
            return '状态已变更为询价中';
        }else{
            return '状态更新失败';
        }
    }
}