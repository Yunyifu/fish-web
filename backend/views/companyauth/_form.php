<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\util\Utils;
/* @var $this yii\web\View */
/* @var $model common\models\Companyauth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companyauth-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 1 => '男', 2 => '女', ]) ?>

    <?= $form->field($model, 'telphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_hand_pic')->hiddenInput(['disabled' => true])->hint(Utils::renderPreviewImg($model->id_hand_pic)) ?>

    <?= $form->field($model, 'company_pic')->hiddenInput(['disabled' => true])->hint(Utils::renderPreviewImg($model->company_pic)) ?>

    <?= $form->field($model, 'factory_pic')->hiddenInput(['disabled' => true])->hint(Utils::renderPreviewImg($model->factory_pic)) ?>
    <?= $form->field($model, 'status')->dropDownList(\common\util\Constants::$checkStatus) ?>

    <?= $form->field($model, 'created_at')->hiddenInput(['disabled'=>true])->hint(date("Y-m-d H:i:s", $model->created_at)) ?>

    <?= $form->field($model, 'updated_at')->hiddenInput(['disabled'=>true])->hint(date("Y-m-d H:i:s", $model->updated_at)) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
