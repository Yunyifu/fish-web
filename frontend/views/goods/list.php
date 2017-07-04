
<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '供应信息';
$isSecond = \Yii::$app->request->get('category_parent', false);
?>
<?= $this->render('/layouts/search')?>
<?= $this->render('/layouts/navi-bar')?>


<h6 class="notice">您当前的位置：<a href="/">首页</a>>供应信息</h6>
<div class="container content">
  <ul class="tab goods">
    <li class="type" >
      <?= Html::img('/images/kind.png', ['class' => 'icon']) ?>
      <span>产品分类 >></span>
      <?= Html::a('全部', ['list','category_parent'=>null]) ?>
      <?php foreach ($categoryParent as $key => $category): ?>
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
          <?= Html::a($category->name, ['list', 'category_parent'=>\Yii::$app->request->get('category_parent'),'GoodsSearch[category_id]'=>$category->id], ['class'=>\Yii::$app->request->get('GoodsSearch')['category_id'] == $category->id ? 'children selected' : 'children']) ?>
        <?php endforeach; ?>
      </li>
    <?php endif; ?>

  </ul>

  <br class="clear">
  <br>

  <ul class="list-page goods">
    <?php //var_dump($dataProvider->models[0]); ?>
    <?php foreach ($dataProvider->models as $key => $goods): ?>
      <li>
        <img class="img" src="http://dev.image.alimmdn.com<?= $goods->pic?>@!goods_thumb" alt="图片">
        <img class="avatar" src="http://dev.image.alimmdn.com<?= $goods->user->avatar?>" alt="用户头像">
        <span class="user-name"><?= $goods->user->nickname ?></span><br>
        <span class="created_at"><?= date('Y-m-d', $goods->created_at) ?></span>
        <span class="location"><?= $goods->area ?></span>
        <span class="comment no-warp"><?= $goods->title ?></span>
        <?= Html::a('查看详情', ['detail','id'=>$goods->id], ['class'=>$goods->status==2? 'anchor selled':'anchor']) ?>
        <?= $goods->status==2 ? Html::img('/images/selled.png', ['class'=>'selled']) : '' ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <br>
  <?= $this->render('/layouts/pager', ['pageCount' => $pageCount]);?>

  <br><br>
</div>

<?= $this->render('/layouts/footer');?>
