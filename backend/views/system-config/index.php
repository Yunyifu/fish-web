<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\util\Constants;

$this->title = '系统参数';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
$('.post-form .nav li').on('click', function(){
    var ctns = [$('.sys-basic')];
    var oindex = $('.post-form .nav li.active').index();

    var index = $(this).index();
    $('.post-form .nav li').removeClass('active');
    ctns[oindex].addClass('hide');

    $(this).addClass('active');
    ctns[index].removeClass('hide');
});
JS;

$this->registerJs($js);

?>

<div class="post-form">

    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0)">基础配置</a></li>
    </ul>

    <?php $form = ActiveForm::begin(); ?>

    <div class="sys-basic">
        <h3>基础配置</h3>
        <?= $form->field($model, 'param1')->textInput() ?>
        <?= $form->field($model, 'param2')->textInput() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>