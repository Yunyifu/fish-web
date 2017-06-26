<?php

namespace frontend\controllers;

use Yii;
use common\models\Category;
use common\models\Demand;
use common\models\DemandSearch;
use frontend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DemandController implements the CRUD actions for demand model.
 */
class DemandController extends BaseController
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

    public function actionIndex(){

      return $this->redirect('demand/list');
    }
    /**
     * Lists all demand models.
     * @return mixed
     */
    public function actionList($category_parent = 1, $category_id = null )
    {
        $categoryModel = new Category();
        $categoryParent = $categoryModel->find()->where(['parent_id' => null])->all();
        $categoryData = $categoryModel->find()->where(['parent_id' => $category_parent])->all();
        $searchModel = new DemandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pageSize = 18;
        $pageCount = (Demand::find()->count())/$pageSize;

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryParent' => $categoryParent,
            'categoryData' => $categoryData,
            'pageSize' => $pageSize,
            'pageCount' => $pageCount,
        ]);
    }

    /**
     * Displays a single demand model.
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
     * Creates a new demand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new demand();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing demand model.
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
     * Deletes an existing demand model.
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
     * Finds the demand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return demand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = demand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxDelete(){
        Yii::$app->response->format = 'json';
        $id = Yii::$app->request->post('id');
        $user_id = Yii::$app->getUser()->getId();
        if($goods = Demand::findOne(['id'=>$id,'user_id'=>$user_id])){
            $goods->status = 0;
            if($goods->save()){
                return 1;
            }
        }
        return 0;

    }
}
