<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile("@web/js/banner.js", ['depends' => ['backend\assets\AppAsset'], 'position' => \yii\web\View::POS_END]);
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= Html::activeHiddenInput($model, 'thumb', ['id' => 'banner_img']) ?>
    <div>
        <label>缩略图</label>
        <?= Html::error($model, 'thumb', ['class' => 'text-danger banner-img-error'])?>
        <div class="banner-img-container">
        </div>
    </div>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(),[
        'clientOptions' => [
            //'imageManagerJson' => ['/redactor/upload/image-json'],
            //'imageUpload' => ['/redactor/upload/image'],
            //'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            //'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ])?>

    <?= $form->field($model, 'listorder')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
