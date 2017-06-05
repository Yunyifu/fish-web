<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use backend\util\Utils;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

// $js = <<<JS
// var Avatar = {
//     init : function() {
//         ImgUploader.init( {
//             maxImgs : 10,
//             type : 2,
//             \$container : $( '.avatar-img-container' ),
//             \$input : $( '#avatar_img' ),
//             \$error : $( '.avatar-img-error' )
//         } );
//     }
// };
// Avatar.init();
// JS;
// $this->registerJs($js);

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'nickname')->hiddenInput(['disabled' => true])->hint($model->nickname) ?>
	
    <?= $form->field($model, 'status')->hiddenInput(['disabled' => true])->hint(($model->status == User::STATUS_ACTIVE || $model->block_until < time()) ? '激活' : ('封禁至'. date("Y-m-d H:i:s", $model->block_until))) ?>

    <?= $form->field($model, 'avatar')->hiddenInput(['disabled' => true])->hint($model->avatar ? Utils::renderPreviewImgs($model->avatar) : "无") ?>
    
    <!--<?= Html::activeHiddenInput($model, 'avatar', ['id' => 'avatar_img']) ?>
    <div>
        <label>详情图片:</label>
        <?= Html::error($model, 'images', ['class' => 'text-danger avatar-img-error'])?>
        <div class="avatar-img-container">
        </div>
    </div>-->

    <?= $form->field($model, 'gender')->hiddenInput(['disabled' => true])->hint($model->gender ? '男' : '女') ?>

    <?= $form->field($model, 'birthday')->hiddenInput(['disabled' => true])->hint($model->birthday) ?>

	<?= $form->field($model, 'created_at')->hiddenInput(['disabled' => true])->hint(date('Y-m-d H:i:s' , $model->created_at)) ?>

    <?= $form->field($model, 'updated_at')->hiddenInput(['disabled' => true])->hint(date('Y-m-d H:i:s' , $model->updated_at)) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php
    	if($model->id) {
    	   if($model->status == User::STATUS_ACTIVE || $model->block_until < time()) {
    	       echo Html::a('封禁1天', ['block', 'id' => $model->id, 'days' => 1], ['data-method' => 'post', 'data-confirm' => '确定封禁此账号？', 'class' => 'btn btn-danger']) . ' ';
    	       echo Html::a('封禁7天', ['block', 'id' => $model->id, 'days' => 7], ['data-method' => 'post', 'data-confirm' => '确定封禁此账号？', 'class' => 'btn btn-danger']) . ' ';
    	       echo Html::a('封禁1月', ['block', 'id' => $model->id, 'days' => 30], ['data-method' => 'post', 'data-confirm' => '确定封禁此账号？', 'class' => 'btn btn-danger']) . ' ';
    	       echo Html::a('永久封禁', ['block', 'id' => $model->id, 'days' => 3650], ['data-method' => 'post', 'data-confirm' => '确定封禁此账号？', 'class' => 'btn btn-danger']) . ' ';
    	   } else {
    	       echo Html::a('解除封禁', ['unblock', 'id' => $model->id], ['data-method' => 'post', 'data-confirm' => '确定解封此账号？', 'class' => 'btn btn-danger']);
    	   }
        }?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
