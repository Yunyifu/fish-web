<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '需求信息';
$isSecond = \Yii::$app->request->get('category_parent', false);
$this->registerJsFile("@web/js/demand.js", ['depends' => ['frontend\assets\AppAsset']]);
?>
<?= $this->render('/layouts/search-demand')?>
<?= $this->render('/layouts/navi-bar')?>

<h6 class="notice">您当前的位置：<a href="/">首页</a>>需求信息</h6>
<div class="container content list-page">
  <ul class="tab goods">
    <li class="type" >
      <?= Html::img('/images/kind.png') ?>
      <span>产品分类 >></span>
      <?= Html::a('全部', ['list','category_parent'=>null]) ?>
      <?php foreach ($categoryParent as $key => $category): ?>
        <!-- 输出一级分类，并判断是否选中，加特定样式 -->
        <?=
          Html::a(
          $category->name . ($category->id == \Yii::$app->request->get('category_parent') ? Html::img('/images/down.png') : Html::img('/images/downgrey.png')),
          ['list','category_parent'=>$category->id],
          ['class' => $category->id == \Yii::$app->request->get('category_parent') ? 'selected' : ''])
        ?>
      <?php endforeach; ?>
    </li>
    <?php if ($isSecond): ?>
      <li class="fish items">
        <?= Html::a('全部', ['list', 'category_parent'=>\Yii::$app->request->get('category_parent')], ['class'=>'children']) ?>
        <?php foreach ($categoryData as $key => $category): ?>
          <?= Html::a($category->name, ['list', 'category_parent'=>\Yii::$app->request->get('category_parent'), 'DemandSearch[category_id]'=>$category->id], ['class'=>\Yii::$app->request->get('DemandSearch')['category_id'] == $category->id ? 'children selected' : 'children']) ?>
        <?php endforeach; ?>
      </li>
    <?php endif; ?>
  </ul>

  <br class="clear">
  <!--交易流程-->
  <?php echo $this->render('/layouts/steps'); ?>
  <!--交易流程-->
  <br>

  <ul class="information demand">
    <li class="head">
      <span>采购品类</span>
      <span>采购价格</span>
      <span>采购数量</span>
      <span>状态要求</span>
      <span>其他要求</span>
      <span>地理位置</span>
      <span>交易顾问</span>
      <span>发布时间</span>
    </li>
    <li class="left-shade"> </li>
    <?php foreach ($dataProvider->models as $key => $demand): ?>
      <li class="item <?= ($key+1)==count($dataProvider->models)? 'last':''?>">
        <span class="no-warp"><?= $demand->title?></span>
        <span class="no-warp"><?= $demand->price?></span>
        <span class="no-warp"><?= $demand->num?></span>
        <span class="no-warp"><?= $demand->demandstatus?></span>
        <span title="<?= $demand->desc?>" class="no-warp"><?= $demand->otherstatus?></span>
        <span class="no-warp"><?= $demand->position?></span>
        <span class="no-warp"><?= $demand->dealer?></span>
        <span class="date no-warp"><?= date('Y.m.d', $demand->updated_at)?></span>
        <!-- <p class="dealer">供货渔民请联系<?=  $demand->dealer?></p>
        <button class="consult" type="button" name="button">在线咨询</button> -->
      </li>
    <?php endforeach; ?>
    <li class="right-shade"> </li>
  </ul>
  <br>
  <?= $this->render('/layouts/pager', ['pageCount' => $pageCount]);?>
  <br><br>
</div>

<?php
  echo $this->render('/layouts/footer');
?>
