<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '需求信息';
?>

<?= $this->render('/layouts/navi-bar')?>

<h6 class="notice">您当前的位置：<a href="/">首页</a>>需求信息</h6>
<div class="container content">
  <ul class="tab goods">
    <li class="type" >
      <img src="" alt="icon">
      <span>产品分类 >></span>
      <?= Html::a('全部', ['list','category_parent'=>null]) ?>
      <?php foreach ($categoryParent as $key => $category): ?>
        <?= Html::a($category->name, ['list','category_parent'=>$category->id]) ?>
      <?php endforeach; ?>
    </li>
    <li class="fish items">
      <?= Html::a('全部', ['list', 'category_parent'=>\Yii::$app->request->get('category_parent')], ['class'=>'children']) ?>
      <?php foreach ($categoryData as $key => $category): ?>
        <?= Html::a($category->name, ['list','DemandSearch[category_id]'=>$category->id], ['class'=>'children']) ?>
      <?php endforeach; ?>
    </li>
  </ul>

  <br class="clear">
  <br>

  <ul class="information demand">
    <li class="head">
      <span>采购品类</span>
      <span>采购价格</span>
      <span>采购数量</span>
      <span>状态要求</span>
      <span>其他要求</span>
      <span>地理位置</span>
      <span>发布时间</span>
    </li>
    <li class="left-shade"> </li>
    <?php foreach ($dataProvider->models as $key => $demand): ?>
      <li class="item <?= ($key+1)==count($dataProvider->models)? 'last':''?>">
        <span><?= $demand->title?></span>
        <span><?= $demand->price?></span>
        <span><?= $demand->num?></span>
        <span>新鲜</span>
        <span title="<?= $demand->desc?>" class="no-warp"><?= $demand->desc?></span>
        <span><?= $demand->position?></span>
        <span><?= date('Y.m.d', $demand->updated_at)?></span>
      </li>
    <?php endforeach; ?>
  </ul>
  <br>
  <div class="pager">
    <a href="#">《</a>
    <a href="#"><</a>
    <a href="#">1</a>
    <a href="#">2</a>
    <span>...</span>
    <a href="#">10</a>
    <a href="#">11</a>
    <a href="#">></a>
    <a href="#">》</a>
  </div>
  <br><br>
</div>

<?php
  echo $this->render('/layouts/footer');
?>
