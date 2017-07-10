<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '轮播图';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index" style="overflow-x:auto">
    <p>
        <?= Html::a('创建一张轮播图', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute' => 'file_path', 'content' => function($model){
                return \backend\util\Utils::renderPreviewImg($model->file_path ? $model->file_path :'', true);
            }],
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
