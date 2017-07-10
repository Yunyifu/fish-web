<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = '资讯中心';
?>
<?= $this->render('/layouts/search')?>
<?php
  echo $this->render('/layouts/navi-bar');
?>
<div class="news-list list-page container content" >
  <br>
  <ul class="news">
    <?php foreach ($dataProvider->models as $key => $news): ?>
      <li>
        <?= Html::a('<h6>'.$news->title.'</h6>', ['detail', 'id'=>$news->id]) ?>
        <img src="http://dev.image.alimmdn.com<?= $news->thumb ?>@!news_thumb" alt="新闻图片">
        <span class="created_at"><?= date('Y-m-d', $news->created_at) ?></span>
        <p><?= $news->abs ?></p>
        <br class="clear">
        <?= Html::a('查看全文>>', ['detail', 'id'=>$news->id], ['class'=>'pull-right']) ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <br>
  <?= $this->render('/layouts/pager', ['pageCount' => $pageCount]);?>
  <br><br>
</div>

<?php
  echo $this->render('/layouts/footer');
?>
