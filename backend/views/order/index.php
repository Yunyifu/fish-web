<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => ['width'=>50],
            ],
            //'type',
            //'goods_id',
            [
                'attribute' => 'goods_name',
                'headerOptions' => ['width'=>150],
            ],
            [
                'attribute' => 'sn',
                'headerOptions' => ['width'=>180],
            ],
            [
                'attribute' => 'goods_amount',
                'headerOptions' => ['width'=>100],
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['width'=>100],
                'filter' => \common\util\Constants::$ORDER_STATUSES,
                'content' => function($model){
                    return \common\util\Constants::$ORDER_STATUSES[$model->status];
                }
            ],
            [
                'attribute' => 'buyer_name',
                'headerOptions' => ['width'=>150],
                'value' => function($model){
                    if($model->buyer_name){
                        return $model->buyer_name;
                    }else{
                        return Html::tag('p','未填写',['style' => 'color:green']);
                    }
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'buyer_mobile',
                'headerOptions' => ['width'=>150],
            ],
            // 'before_refund_status',
            // 'refund_status',
            // 'refund_amount',
            // 'refund_balance',
            // 'refund_paid',
            // 'refund_reason:ntext',
            //'goods_amount',
            // 'pay_type',
            // 'pay_platform',
            // 'pay_trade_no',
            // 'goods_price',
            // 'seller_id',
            // 'buyer_id',
            //'buyer_name',
            // 'buyer_mobile',
            // 'buyer_addr',
            // 'message',
            // 'pay_time:datetime',
            // 'post_pay_time:datetime',
            // 'created_at',
            // 'updated_at',
            // 'buyersee',
            // 'sellersee',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
