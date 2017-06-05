<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Test;
use yii\rest\Controller;
use frontend\controllers\BaseController;
use common\util\Constants;
use yii\web\Cookie;


class TestController extends BaseController{

    public function actionIndex(){
        $this->layout = false;
        //$model = new Test;
        $data = Test::find()->one();
        return $this->render("index",[
            "data" => $data,
        ]);

    }


}