<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
$category=Category::find()->select('name')->indexBy('id')->column();
$dealers = \backend\models\AdminUser::find()->where(['like','nickname','交易'])->select('nickname')->indexBy('id')->column();
/* @var $this yii\web\View */
/* @var $model common\models\Demand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="demand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList($category) ?>

    <?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'demandstatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otherstatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\util\Constants::$goodsStatus) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dealer_id')->dropDownList($dealers) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
