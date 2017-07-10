<?php

namespace console\jobs;
use common\models\Goods;
use common\models\Order;
use common\util\Constants;
use shmilyzxt\queue\base\JobHandler;

class FreshOrder extends JobHandler
{
    public function handle($job, $data)
    {

        $overTime = time()-1800;
        $orders = Order::find()->where(['status' => Constants::ORDER_STATUS_NOT_PAY])->andwhere(['<','created_at',$overTime])->all();
        foreach($orders as $order){
            $order->status = Constants::ORDER_STATUS_CANCEL;
            $goods = $order->goods;
            $goods->setStatus($goods->id);
            $order->load($order,'');
            $order->update();
            }
        }

    public function failed($job,$data){
        var_dump('chulishibai');
    }


}