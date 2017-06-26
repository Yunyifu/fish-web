<?php
namespace frontend\controllers;

use common\util\CacheUtil;
use Yii;
use frontend\models\Test;
use yii\rest\Controller;
use frontend\controllers\BaseController;
use common\util\Constants;
use yii\web\Cookie;


class TestController extends BaseController{

    public function actionIndex(){
        var_dump(Yii::$app->getUser()->identity);exit;
        var_dump($this->callApi('pay/pay',['orderId'=>14,'payType'=>'ll','platform'=>'web']));
    }

    public function actionTest($mobile){
        $ocode = CacheUtil::getCache( Constants::CACHE_USER_MOBILE_CODE, [
            'mobile' => $mobile
        ] );
        var_dump($ocode);exit;
    }

    public function actionLogin(){
        var_dump($this->callApi('users/login',['username' => 15889892345,'password' => 'www000'],'post'));
    }


}