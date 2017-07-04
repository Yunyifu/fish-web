<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$gender = ['0'=>'女', '1'=>'男'];
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($fisher, 'name')->textInput(['placeholder' => '船主名字']) ?>

<?= $form->field($fisher, 'gender')->dropDownlist($gender, ['prompt'=>'请选择性别']) ?>

<?= $form->field($fisher, 'telphone')->textInput(['placeholder' => '联系电话']) ?>

<label class="for-file" style="display:inline-block" for="auth-id_hand_pic"><img id ="preview1" src="../images/plus.png" style="margin-top:40px"></label>
<label class="for-file" style="display:inline-block;margin-left:180px;margin-right:180px;" for="auth-ship_auth_pic"><img id ="preview2" src="../images/plus.png" style="margin-top:40px"></label>
<label class="for-file" style="display:inline-block" for="auth-ship_pic"><img id ="preview3" src="../images/plus.png"  style="margin-top:40px"></label>
<br>
<span>手持身份证</span>
<span style="display:inline-block;margin-left:250px;margin-right:250px;">船舶证书</span>
<span>船舶照片</span>
<?= $form->field($fisher, 'id_hand_pic')->fileInput(['class'=>'hidden']) ?>

<?= $form->field($fisher, 'ship_auth_pic')->fileInput(['class'=>'hidden']) ?>

<?= $form->field($fisher, 'ship_pic')->fileInput(['class'=>'hidden']) ?>

<div class="form-group">
    <?= Html::submitButton('提交', ['class' =>  'btn' ]) ?>
</div>

<?php ActiveForm::end(); ?>
