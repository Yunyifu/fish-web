
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '供应信息';
?>

<?= $this->render('/layouts/navi-bar')?>


<h6 class="notice">您当前的位置：<a href="/">首页</a>>供应信息</h6>
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
        <?= Html::a($category->name, ['list','GoodsSearch[category_id]'=>$category->id], ['class'=>'children']) ?>
      <?php endforeach; ?>
    </li>
  </ul>

  <br class="clear">
  <br>

  <ul class="list-page goods">
    <?php //var_dump($dataProvider->models[0]); ?>
    <?php foreach ($dataProvider->models as $key => $goods): ?>
      <li>
        <img class="img" src="http://dev.image.alimmdn.com<?= $goods->pic?>@294w_273h_1l" alt="图片">
        <img class="avatar" src="http://dev.image.alimmdn.com<?= $goods->user->avatar?>" alt="用户头像">
        <span class="user-name"><?= $goods->user->nickname ?></span><br>
        <span class="created_at"><?= date('Y-m-d', $goods->created_at) ?></span>
        <span class="location"><?= $goods->area ?></span>
        <span class="comment"><?= $goods->title ?></span>
        <?= Html::a('查看详情', ['detail','id'=>$goods->id], ['class'=>"anchor"]) ?>
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
