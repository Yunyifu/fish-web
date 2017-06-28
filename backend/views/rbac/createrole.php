<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\util\Utils;
/* @var $this yii\web\View */
/* @var $model common\models\Auth */
/* @var $form yii\widgets\ActiveForm */
$this->title = '添加角色';
$this->registerCssFile('@web/css/rbac.css');
?>

<div class="auth-form">

    <?php

    $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '<div class="span12 field-box">{label}{input}</div>{error}',
        ],
        'options' => [
            'class' => 'new_user_form inline-input',
        ],
    ]);
    /*echo $form->field($model, 'username')->textInput(['class' => 'span9']);
    echo $form->field($model, 'useremail')->textInput(['class' => 'span9']);
    echo $form->field($model, 'userpass')->passwordInput(['class' => 'span9']);
    echo $form->field($model, 'repass')->passwordInput(['class' => 'span9']);
     */
    ?>
    <div class="span12 field-box">
        <?php echo Html::label('名称', null). Html::textInput('description', '', ['class' => 'span9']); ?>
    </div>
    <div class="span12 field-box">
        <?php echo Html::label('标识', null). Html::textInput('name', '', ['class' => 'span9']); ?>
    </div>
    <div class="span12 field-box">
        <?php echo Html::label('规则名称', null). Html::textInput('rule_name', '', ['class' => 'span9']); ?>
    </div>
    <div class="span12 field-box">
        <?php echo Html::label('数据', null). Html::textarea('data', '', ['class' => 'span9']); ?>
    </div>

    <div class="span11 field-box actions">
        <?php echo Html::submitButton('添加', ['class' => 'btn-glow primary']); ?>
        <span>OR</span>
        <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
    </div>
    <?php ActiveForm::end(); ?>

    <div class="form-group">

    </div>



</div>
