<?php
namespace console\controllers;
use shmilyzxt\queue\DoWork;

class DoWorkController extends \yii\console\Controller{
    /**
     *  check > 30 min order and change order_status=1 and change goods_status=1
     */
    public function actionListen($queueName='default',$attempt=10,$memeory=128,$delay=0)
    {
        DoWork::listen(\Yii::$app->queue,$queueName,$attempt,$memeory,$delay);
    }
}