<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Demand */

$this->title = '更新采购信息： ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Demands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="demand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
