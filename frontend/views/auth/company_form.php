<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$gender = ['0'=>'女', '1'=>'男'];
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($company, 'name')->textInput(['placeholder' => '法人姓名']) ?>

<?= $form->field($company, 'gender')->dropDownlist($gender, ['prompt'=>'请选择性别']) ?>

<?= $form->field($company, 'telphone')->textInput(['placeholder' => '联系电话']) ?>

<?= $form->field($company, 'saler')->textInput(['placeholder' => '推荐人（选填）']) ?>

<label class="for-file" style="display:inline-block" for="companyauth-id_hand_pic"><img id ="preview1" src="../images/plus.png" style="margin-top:40px"></label>
<label class="for-file" style="display:inline-block;margin-left:180px;margin-right:180px;" for="companyauth-company_pic"><img id ="preview2" src="../images/plus.png" style="margin-top:40px"></label>
<label class="for-file" style="display:inline-block" for="companyauth-factory_pic"><img id ="preview3" src="../images/plus.png"  style="margin-top:40px"></label>
<br>
<span>手持身份证</span>
<span style="display:inline-block;margin-left:230px;margin-right:250px;">公司营业执照</span>
<span style="">工厂照片</span>
<?= $form->field($company, 'id_hand_pic')->fileInput(['class'=>'hidden']) ?>

<?= $form->field($company, 'company_pic')->fileInput(['class'=>'hidden']) ?>

<?= $form->field($company, 'factory_pic')->fileInput(['class'=>'hidden']) ?>

<div class="form-group">
    <?= Html::submitButton('提交', ['class' =>  'btn' ]) ?>
</div>

<?php ActiveForm::end(); ?>
