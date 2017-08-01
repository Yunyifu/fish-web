<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdminUser */

$this->title = '创建一个交易员';
$this->params['breadcrumbs'][] = ['label' => '交易顾问', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
