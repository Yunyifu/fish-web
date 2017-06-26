<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Goods;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应管理';
$this->params['breadcrumbs'][] = $this->title;
$parents = \common\models\Category::find()->where(['is not','parent_id',null])->select('name')->indexBy('id')->column();
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建商品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['width'=>100],
            ],
            [
                'attribute' => 'title',
                'headerOptions' => ['width'=>180],
            ],
            //'thumb',
            [
                'attribute' => 'user_id',
                'headerOptions' => ['width'=>70],
            ],
            [
                'attribute'=>'status',
                'headerOptions' => ['width'=>70],
                'label' =>'状态',
                'filter'=>\common\util\Constants::$goodsStatus,
                'content' => function($model){
                    return \common\util\Constants::$goodsStatus[$model->status];
                }
            ],
            [
              'attribute'=>'category_id',
                'label'=>'分类id',
                'headerOptions' => ['width'=>70],
                'filter'=>$parents,
                'content'=>function($model){
                $parent = \common\models\Category::findOne($model->category_id);
                if(!empty($parent)){
                    return $parent->name;
                }else{
                    return '未设置';
                }
                }
            ],
            // 'num',
            [
                'attribute' => 'price',
                'headerOptions' => ['width'=>80],
            ],
            // 'area',
            // 'position',
            // 'status',
             'desc:ntext',
            // 'pic',
            [
                'attribute' => 'created_at',
                'headerOptions' => ['width'=>80],
                'content' => function($model){
                    return date('Y-m-d h:i:s',$model->created_at);
                }
            ],
            // 'updated_at',
            [
                    'attribute'=>'rank',
                    'label' =>'精选排序',
                    'headerOptions' => ['width'=>70],
                    'filter'=>['9999'=>'非精选信息','1'=>'精选信息'],
                    'value'=>'rank',
            ],
            ['class' => 'yii\grid\ActionColumn', 'header'=>'操作'
            ],
        ],
    ]); ?>
</div>
