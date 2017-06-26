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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'name',
            [
              'attribute'=>'gender',
                'label'=>'性别',
                'filter'=>[Constants::GENDER_FEMALE=>'女性',Constants::GENDER_MALE=>'男性'],
                'content'=>function($model){
                if($model->gender == Constants::GENDER_MALE){
                    return '男性';
                }else if($model->gender == Constants::GENDER_FEMALE){
                    return '女性';
                }
                }
            ],
            'telphone',
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

                }
            ],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
