<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminUser */
/* @var $form yii\widgets\ActiveForm */
$js = <<<JS
$('#reset_pwd').on('click', function() {
    $('#pwd').prop('disabled', 0);
    return false;
});
JS;
$this->registerJs($js, View::POS_END);
?>

<div class="admin-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord) {
        echo  $form->field($model, 'password')->passwordInput(['maxlength' => true]);
    } else {
        $model->password = "123456";
        echo $form->field($model, 'password', ['template' => "{label} <a id='reset_pwd'>修改密码</a>\n{input}\n{hint}\n{error}"])->passwordInput(['id' => 'pwd', 'maxlength' => true, 'disabled' => true]);
    }?>
    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
