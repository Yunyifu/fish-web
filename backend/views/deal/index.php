<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DealSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Deal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'type',
            'user_id',
            'cateid',
            'num',
            'price',
            //'area',
            'position',
            'status',
            'descr:ntext',
            'pics:ntext',
            'issale',
            'create_at',
            'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
