<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Demand */

$this->title = '发布采购需求';
$this->params['breadcrumbs'][] = ['label' => 'Demands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demand-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
