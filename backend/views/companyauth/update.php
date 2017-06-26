<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Companyauth */

$this->title = '工场认证更新: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '工场认证列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="companyauth-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
