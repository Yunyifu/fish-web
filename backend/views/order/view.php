<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">


    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'goods_id',
            'sn',
            [
                'attribute' => 'status',
                'label'=>'订单状态',
                'value'=>function($model){
                if($model->status == \common\util\Constants::ORDER_STATUS_NOT_PAY){
                    return '未支付';
                }else if($model->status == \common\util\Constants::ORDER_STATUS_CANCEL){
                    return '已取消';
                }else if($model->status == \common\util\Constants::ORDER_STATUS_PAID){
                    return '已支付';
                }else if($model->status == \common\util\Constants::ORDER_STATUS_CONFIRMED){
                    return '已结单，待发货';
                }else if($model->status == \common\util\Constants::ORDER_STATUS_DELIVERED){
                    return '已接单，已发货';
                }else if($model->status == \common\util\Constants::ORDER_STATUS_FINISHED){
                    return '已完成';
                }
            }],
            //'before_refund_status',
            //'refund_status',
            //'refund_amount',
            //'refund_balance',
            //'refund_paid',
           // 'refund_reason:ntext',
            'goods_amount',
            //'pay_type',
            //'pay_platform',
            'pay_trade_no',
            'goods_name',
            'goods_price',
            'seller_id',
            'buyer_id',
            'buyer_name',
            'buyer_mobile',
            'buyer_addr',
            'message',
            'pay_time:datetime',
            //'post_pay_time:datetime',
            [
                'attribute'=>'created_at',
                'label'=>'创建于',
                'value'=>function($model){
                    return date('y-m-d h:m:s',$model->created_at);
                }
            ],
            [
                'attribute' => 'buyersell',
                'label'=>'对买家可见',
                'value'=>function($model){
                    if($model->buyersee == 0){
                        return '不可见';
                    }else if($model->buyersee == 1){
                        return '可见';
                    }
                }],
            [
                'attribute' => 'sellersell',
                'label'=>'对卖家可见',
                'value'=>function($model){
                    if($model->sellersee == 0){
                        return '不可见';
                    }else if($model->sellersee == 1){
                        return '可见';
                    }
                }],
        ],
    ]) ?>

</div>
