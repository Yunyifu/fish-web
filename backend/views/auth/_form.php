<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\util\Utils;
/* @var $this yii\web\View */
/* @var $model common\models\Auth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 1 => '1', 2 => '2', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'telphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_hand_pic')->hiddenInput(['disabled' => true])->hint(Utils::renderPreviewImg($model->id_hand_pic)) ?>

    <?= $form->field($model, 'ship_auth_pic')->hiddenInput(['disabled' => true])->hint(Utils::renderPreviewImg($model->ship_auth_pic)) ?>

    <?= $form->field($model, 'ship_pic')->hiddenInput(['disabled' => true])->hint(Utils::renderPreviewImg($model->ship_pic)) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\util\Constants::$checkStatus) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
