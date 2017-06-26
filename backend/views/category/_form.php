<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\category */
/* @var $form yii\widgets\ActiveForm */
$parents = \common\models\Category::find()->where(['parent_id'=>null])->select('name')->indexBy('id')->column();
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\util\Constants::$cateStatus) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($parents,['prompt'=>'无']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
