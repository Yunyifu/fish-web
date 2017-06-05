<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\util\Utils;
use common\util\Constants;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = "用户：" . $model->id;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nickname',
            [
                'attribute' => 'status',
                'value' => ($model->status == User::STATUS_ACTIVE || $model->block_until < time()) ? '激活' : ('封禁至'. date("Y-m-d H:i:s", $model->block_until)),
            ],
            [
                'attribute' => 'avatar',
                'value' => Utils::renderPreviewImg($model->avatar ? $model->avatar : Constants::DEFAULT_AVATAR),
                'format' => 'raw'
             ],
            [
                'attribute' => 'gender',
                'value' => $model->gender == Constants::GENDER_MALE ? '男' : '女'
            ],
            'birthday',
//             [
//                 'attribute' => 'referee_id',
//                 'value' => $model->referee_id ? Html::a($model->referee->nickname, ['user/view', 'id' => $model->referee_id]) : '无',
//                 'format' => 'raw'
//             ],
            [
                'attribute' => 'created_at',
                'value' => date( 'Y-m-d H:i:s', $model->created_at )
            ],
            [
                'attribute' => 'updated_at',
                'value' => date( 'Y-m-d H:i:s', $model->updated_at )
            ],
        ],
    ]) ?>

</div>
