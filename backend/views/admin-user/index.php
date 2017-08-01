<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\AdminUser;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '后台用户');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-index">

    <p>
        <?= Html::a(Yii::t('app', '创建后台用户'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
//             'password_hash',
            'nickname',
//             'password_reset_token',
            // 'auth_key',
            // 'status',
            [
                'attribute' => 'status',
                'filter' => [AdminUser::STATUS_ACTIVE=>'激活',AdminUser::STATUS_DELETED=>'禁用'],
                'content' => function($model) {
                    return $model->status ? "激活" : "禁用";
                }
            ],
            [
                'attribute'=>'group',
                'label'=>'类型',
                'filter'=>\common\util\Constants::$admin,
                'content'=>function($model){
                    return \common\util\Constants::$admin[$model->group];
                }
            ],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
