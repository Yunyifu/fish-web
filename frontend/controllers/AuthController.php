<?php

namespace frontend\controllers;

use common\util\Constants;
use Yii;
use common\models\Auth;
use common\models\Companyauth;
use common\models\FileUploadForm;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 *
 */
class AuthController extends BaseController
{
    /**
     * @inheritdoc
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
                'only' => ['fisher','cpmpany','updata','delete'],
                'rules' => [
                    [
                        'actions' => ['fisher','cpmpany','updata','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * 渔民认证
     */

    public function actionFisher()
    {
        $model = Auth::findOne(['user_id'=>Yii::$app->getUser()->getId()])?
            Auth::findOne(['user_id'=>Yii::$app->getUser()->getId()]):
            new Auth();
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->id_hand_pic = $this->actionUpload('Auth[id_hand_pic]');
            $model->ship_auth_pic = $this->actionUpload('Auth[ship_auth_pic]');
            $model->ship_pic = $this->actionUpload('Auth[ship_pic]');
            $model->user_id = Yii::$app->getUser()->getId();
            $model->status = Constants::AUTH_CHECKING;
            //var_dump($data)
            if($model->save()){
                $model->status = Constants::AUTH_CHECKING;
                return $this->render('fisher',[
                    'fisher' => $model
                ]);
            }else{
                return '添加失败';
            }
        }
        else
        {
            return $this->render('fisher', [
            'fisher' => $model
            ]);
        }
    }

    /**
     * 公司认证
     */
    public function actionCompany()
    {
        $model = Companyauth::findOne(['user_id'=>Yii::$app->getUser()->getId()])?
            Companyauth::findOne(['user_id'=>Yii::$app->getUser()->getId()]):
            new Companyauth();
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->id_hand_pic = $this->actionUpload('Companyauth[id_hand_pic]');
            $model->company_pic = $this->actionUpload('Companyauth[company_pic]');
            $model->factory_pic = $this->actionUpload('Companyauth[factory_pic]');
            $model->user_id = Yii::$app->getUser()->getId();
            $model->status = Constants::AUTH_CHECKING;
            if($model->save()){
                $model->status = Constants::AUTH_CHECKING;
                return $this->render('company',[
                    'company' => $model
                ]);
            }else{
                return '添加失败';
            }
        }else {
            return $this->render('company', [
                'company' => $model
            ]);
        }
    }








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


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Auth::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpload($name){
        $type = 4;
        $img = UploadedFile::getInstancesByName($name);
        //return $img[0];
        $fileForm = new FileUploadForm();
        $fileForm->file = $img[0];
        $fileForm->type = $type;
        $savePath = $fileForm->save();
        if($savePath) {
            return $savePath;
        }
        else {
                //删除已存储图片
                //FileUploadForm::deleteUploadedFile($savePath);
                return '保存失败';
            }
        }
}
