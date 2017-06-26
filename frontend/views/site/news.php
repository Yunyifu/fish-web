<?php

/* @var $this yii\web\View */

$this->title = '采购信息';
?>
<?php
  echo $this->render('/layouts/navi-bar');
?>
<div class="container content">


  <br>

  <ul class="news">
    <li>
      <h6>【快讯】</h6>
      <img src="" alt="新闻图片">
      <span class="created_at">2017-2-14</span>
      <p>渔民出海打鱼</p>
      <br class="clear">
      <a class="pull-right" href="#">查看全文</a>
    </li>
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
