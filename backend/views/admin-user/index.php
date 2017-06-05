<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\AdminUser;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '管理员');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', '创建管理员'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            // 'group',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
