<?php
namespace console\controllers;
use console\jobs\FreshOrder;
use shmilyzxt\queue\DoWork;

class DoWorkController extends \yii\console\Controller{
    /**
     *  check > 30 min order and change order_status=1 and change goods_status=1
     */
    public function actionListen($queueName='order_fresh',$attempt=3,$memeory=32,$delay=0)
    {
        DoWork::listen(\Yii::$app->queue,$queueName,$attempt,$memeory,$delay);
    }

    public function actionAdd()
    {
        \Yii::$app->queue->pushOn(new FreshOrder(),[],'order_fresh');
    }
}