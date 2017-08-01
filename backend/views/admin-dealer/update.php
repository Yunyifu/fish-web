<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminUser */

$this->title = '更新交易顾问: ' . $model->nickname;
$this->params['breadcrumbs'][] = ['label' => '交易顾问', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
