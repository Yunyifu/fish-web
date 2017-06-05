<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建一张Banner图', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'file_path',
            'link_path',
            [
                'attribute' => 'created_at',
                'content' => function($model){
                    return date("Y-m-d h:i:s",$model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'content' => function($model){
                    return date('Y-m-d h:i:s',$model->updated_at);
                }
            ],
//            'created_at',
//            'updated_at',
             'rank',
             'title',
            ['attribute' => 'type', 'filter' => \common\util\Constants::$banner, 'label' => 'banner种类', 'content' => function($model){
                /* @var $model \common\models\Banner */
                return \common\util\Constants::$banner[$model->type];
            }],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
