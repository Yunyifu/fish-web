<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '资讯中心';
?>
<?php
  echo $this->render('/layouts/navi-bar');
?>
<div class="list-page container content">
  <br>
  <ul class="news">

    <?php foreach ($dataProvider->models as $key => $news): ?>
      <li>
        <h6><?= $news->title ?></h6>
        <img src="<?= $news->thumb ?>" alt="新闻图片">
        <span class="created_at"><?= date('Y-m-d', $news->created_at) ?></span>
        <p><?= $news->abs ?></p>
        <br class="clear">
        <?= Html::a('查看全文', ['detail', 'id'=>$news->id], ['class'=>'pull-right']) ?>
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
