<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\util\Constants;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '渔民认证';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-index">
    <p>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'user_id',
                'headerOptions' => ['width'=>70],
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['width'=>150],
            ],
            [
              'attribute'=>'gender',
                'label'=>'性别',
                'filter'=>[Constants::FEMALE=>'女性',Constants::MALE=>'男性'],
                'content'=>function($model){
                if($model->gender == Constants::MALE){
                    return '男性';
                }else if($model->gender == Constants::FEMALE){
                    return '女性';
                }
                },
                'headerOptions' => ['width'=>80]
            ],
            [
                'attribute' => 'telphone',
                'headerOptions' => ['width'=>190],
            ],
            // 'id_hand_pic',
            // 'ship_auth_pic',
            // 'ship_pic',
            [
                'attribute' => 'status',
                'label'=>'认证状态',
                'filter' => [Constants::AUTH_NO_CHECK=>'未认证',Constants::AUTH_CHECKING=>'待审核',Constants::AUTH_CHECK_REFUSED=>'认证拒绝',Constants::AUTH_CHECKED =>'已认证'],
                'content'=>function($model){
                if($model->status == Constants::AUTH_NO_CHECK){
                    return '未认证';
                }else if($model->status == Constants::AUTH_CHECKING){
                    return '待审核';
                }else if($model->status == Constants::AUTH_CHECKED){
                    return '已认证';
                }else if($model->status == Constants::AUTH_CHECK_REFUSED){
                    return '认证拒绝';
                }
                },
                'headerOptions' => ['width'=>100]
            ],
            [
                'attribute' => 'saler',
                'headerOptions' => ['width'=>120],
                'value' => function($model){
                    if($model->saler){
                        return $model->saler;
                    }else{
                        return Html::tag('p','暂无',['style' => 'color:green']);
                    }
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'created_at',
                'label' => '申请时间',
                'headerOptions' => ['width'=>140],
                'content' => function($model){
                    return date('Y-m-d H:i:s',$model->created_at);
                }
            ],
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'emptyText'=>'当前没有会员',

    ]); ?>
</div>
