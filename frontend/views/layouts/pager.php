<?php
use yii\helpers\Html;
$current = \Yii::$app->request->get('page', 1);
$params = \Yii::$app->request->queryParams;
?>
<div class="pager overhidden" >
  <?php
  if ($pageCount > 0) {
    echo Html::a( '《', array_merge($params, [ '', 'page'=> 1 ]) );
    echo Html::a( '<', array_merge($params, [ '', 'page'=> $current -1]) );
    for ($i=1; $i < $pageCount+1; $i++) {
      echo Html::a( $i, array_merge($params, [ '', 'page'=>$i]), ['class' => $i==$current ? "blue" : ""] );
    }
    echo Html::a( '>', array_merge($params, [ '', 'page'=> $current +1] ) );
    echo Html::a( '》', array_merge($params, [ '', 'page'=> $pageCount] ) );
  }
  ?>
</div>
