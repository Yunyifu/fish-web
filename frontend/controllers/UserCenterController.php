<?php

namespace frontend\controllers;

use backend\models\GoodsSearch;
use backend\models\OrderSearch;
use common\models\Demand;
use common\models\DemandSearch;
use common\models\Goods;
use common\models\Order;
use Yii;
use common\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 *
 */
class UserCenterController extends BaseController
{
    /**
     * @inheritdoc
     *
     *
     */
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'actions' => ['index','updata','buy','sell','demand','goods'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                            ],
            ],
        ];
    }

    /**
     *  用户中心首页
     */


    public function actionIndex()
    {
        $this->layout = 'usercenter';
        $user = Yii::$app->getUser();
        return $this->render('index', [
            'user' =>$user
        ]);
    }

    /**
     *  更新用户数据
     */


    public function actionUpdate()
    {
        $user_id = Yii::$app->getUser()->getId();
        $userId = 8;
        $model = User::findOne(['id' => $user_id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('index', ['user' => $model]);
        } else {
            return $this->render('index', [
                'user' => $model,
            ]);
        }
    }

    /**
     * 已购买
     */
    public function actionBuy(){
        $this->layout = 'usercenter';
        $userId = Yii::$app->getUser()->getId();
        //$userId = 8;
        $searchModel = new OrderSearch();
        $searchModel->search(['OrderSearch' =>['buyer_id'=>$userId,'buyersee'=>1]]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->defaultPageSize = 7;
        $pageSize = 7;
        $pageCount = (Order::find()->where(['buyer_id'=>$userId,'buyersee'=>1])->count())/$pageSize;
        //return '123';

        return $this->render('buy',[
            'dataProvider' => $dataProvider,
            'pageSize' => $pageSize,
            'pageCount' => $pageCount,
            'payResult' => $payResult = Yii::$app->request->post()
        ]);

    }

    /**
     * 已出售
     */
    public function actionSell(){
        $this->layout = 'usercenter';
        $userId = Yii::$app->getUser()->getId();
        $searchModel = new OrderSearch();
        $searchModel->search(['OrderSearch' =>['seller_id'=>$userId,'sellersee'=>1]]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->defaultPageSize = 7;
        $pageSize = 7;
        $pageCount = (Order::find()->where(['seller_id'=>$userId,'sellersee'=>1])->count())/$pageSize;
        return $this->render('sell',[
            'dataProvider' => $dataProvider,
            'pageSize' => $pageSize,
            'pageCount' => $pageCount,
        ]);
    }

    /**
     *  我的发布-需求信息
     */
    public function actionDemand()
    {
        $this->layout = 'usercenter';
        $userId = Yii::$app->getUser()->getId();
        $searchModel = new DemandSearch();
        $searchModel->search(['DemandSearch' =>['user_id'=>$userId]]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->defaultPageSize = 7;
        $pageSize = 7;
        $pageCount = (Demand::find()->where(['user_id'=>$userId])->count())/$pageSize;
        return $this->render('demand',[
            'dataProvider' => $dataProvider,
            'pageSize' => $pageSize,
            'pageCount' => $pageCount,
        ]);
    }

    /**
     *  我的发布-供应信息
     */

    public function actionGoods()
    {
        $this->layout = 'usercenter';
        $userId = Yii::$app->getUser()->getId();
        $searchModel = new GoodsSearch();
        $searchModel->search(['GoodsSearch' =>['user_id'=>$userId]]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->defaultPageSize = 7;
        $pageSize = 7;
        $pageCount = (Goods::find()->where(['user_id'=>$userId])->count())/$pageSize;
        return $this->render('goods',[
            'dataProvider' => $dataProvider,
            'pageSize' => $pageSize,
            'pageCount' => $pageCount,
        ]);
    }
}
