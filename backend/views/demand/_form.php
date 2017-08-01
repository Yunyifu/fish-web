<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
$category=Category::find()->select('name')->indexBy('id')->column();
$dealers = \backend\models\AdminUser::find()->where(['group' => 4])->select('nickname')->indexBy('id')->column();
$phone = \backend\models\AdminUser::find()->where(['group' => 4])->select('phone')->indexBy('id')->column();
$dealers2 = array();
foreach($dealers as $k=>$value){
    $dealers2[$k] = $value.'：'.$phone[$k];
}
//return var_dump($dealers2);
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

    <?= $form->field($model, 'dealer_id')->dropDownList($dealers2) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
