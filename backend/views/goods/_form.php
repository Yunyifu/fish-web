<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\util\Utils;
use common\models\Category;
/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
$category=Category::find()->select('name')->indexBy('id')->column();
$dealers = \backend\models\AdminUser::find()->where(['like','nickname','交易员'])->select('nickname')->indexBy('id')->column();
//return var_dump($dealers);exit;
$this->registerJsFile("@web/js/goods.js", ['depends' => ['backend\assets\AppAsset'], 'position' => \yii\web\View::POS_END]);
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::activeHiddenInput($model, 'pic', ['id' => 'goods_img']) ?>
    <div>
        <label>商品图</label>
        <?= Html::error($model, 'pic', ['class' => 'text-danger goods-img-error'])?>
        <div class="goods-img-container">
        </div>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thumb')->hiddenInput(['disabled'=>true])->hint(Utils::renderPreviewImgs($model->thumb)) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($category) ?>

    <?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\util\Constants::$goodsStatus) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pic')->hiddenInput(['disabled' => true])->hint(Utils::renderPreviewImgs($model->pic)) ?>


    <?= $form->field($model, 'created_at')->hiddenInput(['disabled'=>true])->hint(date('y-m-d h:m:s',$model->created_at)) ?>

    <?= $form->field($model, 'updated_at')->hiddenInput(['disabled'=>true])->hint(date('y-m-d h:m:s',$model->updated_at)) ?>


    <?= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'dealers')->dropDownList($dealers) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
