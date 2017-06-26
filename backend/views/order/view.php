<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'status',
            'before_refund_status',
            'refund_status',
            'refund_amount',
            'refund_balance',
            'refund_paid',
            'refund_reason:ntext',
            'goods_amount',
            'pay_type',
            'pay_platform',
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
            'post_pay_time:datetime',
            'created_at',
            'updated_at',
            'buyersee',
            'sellersee',
        ],
    ]) ?>

</div>
