<?php
namespace api\common\controllers;

use common\models\Demand;
use yii\data\Pagination;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use Yii;

class DemandController extends BaseController
{
    public $needLoginActions = [
        'add'

    ];


    public function actionIndex()
    {

        $pageSize = \Yii::$app->request->get('pageSize');
        $page = \Yii::$app->request->get('page');
        $model = Demand::find()->joinWith('user')->joinWith('category');
        $count = $model->count();

        $pager = new Pagination(['totalCount' => $count,'pageSize'=> $pageSize,'page'=>$page]);
        $index = $model->offset($pager->offset)->limit($pager->limit)->orderBy('created_at DESC')->all();

        return $index;

    }
    /**
     * @api {get} /demand/detail 获取采购信息详情
     * @apiVersion 0.1.0
     * @apiParam {int} demandId 商品ID
     * @apiGroup demand
     *
     *
     * @apiSuccessExample
     *
     * {
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
        "demandstatus": "要新鲜",
        "otherstatus": "我其它需求是尽快发货",
        "username": "15889897125",
        "nickname": "用户1494929694644",
        "avatat": "123456789",
        "gender": 0,
        "categoryId": 1,
        "categoryName": "鱼类",
        "categoryParent_id": null,
        "api_code": 200
     *}
     *
     */
    public function actionDetail($demandId)
    {
        $demand = Demand::findone($demandId);
        if( empty( $demand ) ) {
            throw new NotFoundHttpException("信息不存在");
        }
        return $demand;
    }


    /**
     * @api {post} /demand/search 搜索需求信息
     * @apiVersion 0.1.0
     * @apiParam {string} keyword 关键字，如果不传此参数则直接按发布时间、page、pageSize排序显示,类与于首页
     * @apiParam {int} start 起始id
     * @apiParam {int} page 页码 默认从第0页开始
     * @apiParam {int} pageSize 一页数量,默认为20
     * @apiParam {int} categoryId 分类ID
     * @apiParam {int} orderTime 根据时间排序，1 代表升序，2 代表降序
     * @apiGroup demand
     *
     *
     * @apiSuccessExample
     * {
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
        $start = $this->getParam('start');
        $orderTime = $this->getParam('orderTime',1);

        if($keyword)
        {
            $query = Demand::find()->where(['demand.status' => 1])->andWhere(['like','title',$keyword])->orWhere(['like','desc',$keyword])->orWhere(['like','area',$keyword])->orWhere(['like','position',$keyword]);
            $query = $query->offset($page*$pageSize)->limit($pageSize)->orderBy('created_at DESC');

        }else{
            $query = Demand::find()->where(['demand.status' => 1])/*->joinWith('user')*/;
            $query = $query->offset($page*$pageSize)->limit($pageSize)->orderBy('created_at DESC');
        }
        if(!empty($categoryId))
        {
            $query->andWhere(['category_id'=> $categoryId])->joinWith('category');

        }
        if(!empty($start)){
            $query->andWhere(['<','demand.id',$start]);
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
     * @api {post} /demand/add 发布供应信息详情
     * @apiVersion 0.1.0
     * @apiParam {varchar} title 标题
     * @apiParam {int} category_id categoryID
     * @apiParam {decimal} price 采购价格
     * @apiParam {varchar} num 采购数量
     * @apiParam {varchar} demandstatus 状态需求
     * @apiParam {varchar} otherstatus 状态需求
     * @apiParam {varchar} area 地理位置
     * @apiGroup demand
     * @apiSuccessExample
     *
     * {
        "data": "恭喜，发布成功，等待管理员审核！",
        "api_code": 200
        }
     *
     */
    public function actionAdd()
    {
        $post = Yii::$app->request->post();
        $post['user_id'] = \Yii::$app->getUser()->getId();
        //$post['created_at'] =time();
        $model = new Demand();
        if($model->load($post,'')&&$model->save($post))
        {
            return '恭喜，发布成功，等待管理员审核！';
        }else{
            throw new BadRequestHttpException('发布失败，请重试！');
        }

    }

    /**
     * @api {post} /demand/update 更新供应信息详情
     * @apiVersion 0.1.0
     * @apiParam {int} demand_id demand_id
     * @apiParam {varchar} title 标题
     * @apiParam {int} category_id categoryID
     * @apiParam {decimal} price 采购价格
     * @apiParam {varchar} num 采购数量
     * @apiParam {varchar} demandstatus 状态需求
     * @apiParam {varchar} otherstatus 状态需求
     * @apiParam {varchar} area 地理位置
     * @apiGroup demand
     * @apiSuccessExample
     *
     * {
    "data": "恭喜，更新成功，等待管理员审核！",
    "api_code": 200
    }
     *
     */
    public function actionUpdate()
    {
        $post = Yii::$app->request->post();
        $post['user_id'] = \Yii::$app->getUser()->getId();
        $model = Demand::findOne(['id' => $post['demand_id']]);
        if($model->user_id !== $post['user_id']){
            throw new BadRequestHttpException('不能更新不属于自己的信息！');
        }
        $model->load($post,'');
        if($model->update($post))
        {
            return '恭喜，更新成功，等待管理员审核！';
        }else{
            throw new BadRequestHttpException('更新失败，请重试！');
        }

    }

}