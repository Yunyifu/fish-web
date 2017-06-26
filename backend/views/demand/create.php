<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Demand */

$this->title = 'Create Demand';
$this->params['breadcrumbs'][] = ['label' => 'Demands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
