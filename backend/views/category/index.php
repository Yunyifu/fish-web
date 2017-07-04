<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类列表';
$this->params['breadcrumbs'][] = $this->title;
$parents = \common\models\Category::find()->where(['parent_id'=>null])->select('name')->indexBy('id')->column();
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建一个分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                    'attribute'=>'status',
                    'label'=>'状态',
                    'filter'=>\common\util\Constants::$cateStatus,
                    'content'=>function($model){
                        return \common\util\Constants::$cateStatus[$model->status];
                    }
            ],
            [
                    'attribute' => 'parent_id',
                    'filter' => $parents,
                    'content'=>function($model){
         $parentCate = \common\models\Category::findOne($model->parent_id);
         if(!empty($parentCate)){
             return $parentCate->name;
         }
                    }

            ],
            [
              'attribute'=>'created_at',
                'label'=>'创建于',
                'content'=>function($model){
        return date('Y-m-d h:m:s',$model->created_at);
                }
            ],
            [
                'attribute'=>'updated_at',
                'label'=>'创建于',
                'content'=>function($model){
                    return date('Y-m-d h:m:s',$model->updated_at);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
