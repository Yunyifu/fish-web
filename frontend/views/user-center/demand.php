
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '我发布的需求';
$this->registerJsFile("@web/js/delete.js", ['depends' => ['frontend\assets\AppAsset']]);
?>
<li class="anchors published">
  <?= Html::a('供应信息', ['/user-center/goods'], ['class'=>'anchor']) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?= Html::a('需求信息', ['/user-center/demand'], ['class'=>'anchor']) ?>
</li>
<li class="headers">
  <span>采购种类</span>
  <span>采购价格</span>
  <span>采购数量</span>
  <span>状态要求</span>
  <span>其他要求</span>
  <span>地理位置</span>
  <span>发布时间</span>
</li>
<?php foreach ($dataProvider->models as $key => $demand): ?>
  <li class="demand">
    <?= Html::button('删除', ['onclick'=>'Delete('.$demand->id.')', 'class'=>'anchor pull-right delete']) ?>
    <?= Html::a('编辑', ['/site/publish-need/', 'id'=>$demand->id, 'cataid'=>$demand->category->id, 'cataname'=>$demand->category->name], ['class'=>'anchor pull-right']) ?>
    <span class="no-warp"><?= $demand->title ?></span>
    <span class="no-warp"><?= $demand->price ?></span>
    <span class="no-warp"><?= $demand->num ?></span>
    <span class="no-warp"><?= $demand->status ?></span>
    <span class="no-warp"><?= $demand->area ?></span>
    <span class="no-warp"><?= $demand->area ?></span>
    <span class="created pull-right no-warp">发布时间：<?= date('Y-m-d', $demand->created_at)?></span>
  </li>
<?php endforeach; ?>
<script type="text/javascript">
  var url = '/demand/ajax-delete/'
</script>
