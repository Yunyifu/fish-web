<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\util\Constants;
use backend\util\Utils;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?php //echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
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
            ['attribute' => 'avatar', 'content' => function($model){
                return Utils::renderPreviewImg($model->avatar ? $model->avatar : Constants::DEFAULT_AVATAR, true);            
            }],
            ['attribute' => 'gender', 'content' => function($model){
                return $model->gender == Constants::GENDER_FEMALE ? '女' : '男';
            }],
            // 'birthday',
            // 'created_at',
            // 'updated_at',
            ['attribute' => 'created_at', 'content' => function($model){
                return date("Y-m-d H:i", $model->created_at);
            }],
            [
                'attribute' => 'status',
                'filter' => [ User::STATUS_ACTIVE=>'激活', User::STATUS_DELETED=>'禁用' ],
                'content' => function($model) {
                    return $model->status ? "激活" : "禁用";
                }
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => "{view}{update}"],
        ],
    ]); ?>
</div>
