<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<!-- Main content -->
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                sorry，服务器开小差了，如果确认是服务器错误，请联系我们 <a href="mailto:contact@zaoing.com">contact@zaoing.com</a>，谢谢 ：）
                <a href='<?= Yii::$app->homeUrl ?>'>回首页</a>
            </p>

        </div>
    </div>

</section>
