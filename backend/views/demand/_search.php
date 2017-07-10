<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DemandSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="demand-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>


    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'num') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'demandstatus') ?>

    <?php // echo $form->field($model, 'otherstatus') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
