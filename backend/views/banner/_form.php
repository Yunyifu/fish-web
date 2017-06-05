<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile("@web/js/banner.js", ['depends' => ['backend\assets\AppAsset'], 'position' => View::POS_END]);
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'file_path', ['id' => 'banner_img']) ?>
    <div>
        <label>Banner图</label>
        <?= Html::error($model, 'file_path', ['class' => 'text-danger banner-img-error'])?>
        <div class="banner-img-container">
        </div>
    </div>
    <?= $form->field($model, 'link_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(\common\util\Constants::$banner) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
