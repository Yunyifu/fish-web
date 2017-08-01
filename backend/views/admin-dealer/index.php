<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminDealerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '交易顾问';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建一个', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['width'=>70],
            ],
            'username',
            //'password_hash',
            'nickname',
            //'password_reset_token',
            // 'auth_key',
            // 'status',
            [
                'attribute'=>'group',
                'label'=>'类型',
                'filter'=>\common\util\Constants::$admin,
                'content'=>function($model){
                    return \common\util\Constants::$admin[$model->group];
                }
            ],
             'phone',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
