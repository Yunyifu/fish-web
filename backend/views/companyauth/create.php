<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Companyauth */

$this->title = 'Create Companyauth';
$this->params['breadcrumbs'][] = ['label' => 'Companyauths', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companyauth-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
