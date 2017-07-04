
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '我发布的供应';
$this->registerJsFile("@web/js/delete.js", ['depends' => ['frontend\assets\AppAsset']]);
?>

<li class="anchors published">
  <?= Html::a('供应信息', ['/user-center/goods'], ['class'=>'anchor']) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?= Html::a('需求信息', ['/user-center/demand'], ['class'=>'anchor']) ?>
</li>
<?php foreach ($dataProvider->models as $key => $goods): ?>
  <li class="goods">
    <span class="pull-left"><?= $goods->title?></span>
    <?= Html::button('删除', ['onclick'=>'Delete('.$goods->id.')', 'class'=>'anchor pull-right delete']) ?>
    <?= Html::a('编辑', ['/site/publish-supply','id'=>$goods->id, 'cataid'=>$goods->category->id, 'cataname'=>$goods->category->name], ['class'=>'anchor pull-right']) ?>
    <span class="pull-right">发布时间：<?= date('Y-m-d', $goods->created_at)?></span>
  </li>
<?php endforeach; ?>
<li><?= $this->render('/layouts/pager', ['pageCount' => $pageCount]);?></li>
<script type="text/javascript">
  var url = '/goods/ajax-delete/'
</script>
