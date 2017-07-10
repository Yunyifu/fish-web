<?php

namespace frontend\controllers;

use backend\models\AdminUser;
use common\models\User;
use Yii;
use common\models\Category;
use common\models\Goods;
use common\models\GoodsSearch;
use frontend\controllers\BaseController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionList($category_parent = 1, $category_id = null )
    {
        $categoryModel = new Category();
        $categoryParent = $categoryModel->find()->where(['parent_id' => null])->all();
        $categoryData = $categoryModel->find()->where(['parent_id' => $category_parent])->all();
        //$categoryModel->getChildren( $parent = $category_parent);
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pageSize = 18;
        $parent_id = Yii::$app->request->get('category_parent');
        $goodssearch = Yii::$app->request->get('GoodsSearch');
        $title = isset($goodssearch['title'])?$goodssearch['title']:null;
        $category_id = isset($goodssearch['category_id'])?$goodssearch['category_id']:null;
        if($parent_id && !$category_id){
            $categorys = Category::find()->where(['parent_id' => $parent_id])->select('id')->column();
            $pageCount = ceil(Goods::find()->where(['category_id' => $categorys])->count()/$pageSize);
        }elseif($category_id){
            $pageCount = ceil(Goods::find()->where(['category_id' => $category_id])->count()/$pageSize);
        }elseif(isset($title)){
            $pageCount = ceil(Goods::find()->where(['title' => $title])->count()/$pageSize);
        }
        else{
            $pageCount = ceil(Goods::find()->count()/$pageSize);
        }

        //return var_dump($goodssearch);
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryParent' => $categoryParent,
            'categoryData' => $categoryData,
            //'pageSize' => $pageSize,
            'pageCount' => $pageCount,
        ]);
    }
    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect('goods/list');
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     */
    public function actionDetail($id)
    {
        $goods = $this->findModel($id);
        //$user = User::findOne($goods->user_id);
        $phone = isset(AdminUser::findOne($goods->dealer_id)->phone)?AdminUser::findOne($goods->dealer_id)->phone:'';
        //return var_dump($phone);
        return $this->render('detail', [
            'goods' => $goods,
            'phone' => $phone
        ]);
    }
    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxDelete(){
        Yii::$app->response->format = 'json';
        $id = Yii::$app->request->post('id');
        $user_id = Yii::$app->getUser()->getId();
        if($goods = Goods::findOne(['id'=>$id,'user_id'=>$user_id])){
            $goods->status = 0;
            if($goods->save()){
                return 1;
            }
        }
        return 0;

    }
}
