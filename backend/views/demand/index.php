<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DemandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '需求管理';
$this->params['breadcrumbs'][] = $this->title;
$parents = \common\models\Category::find()->where(['is not','parent_id',null])->select('name')->indexBy('id')->column();
?>
<div class="demand-index">
    <p>
        <?= Html::a('后台发布一个需求', ['create'], ['class' => 'btn btn-success']) ?>
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
            ['attribute' => 'title',
                'label'=>'标题',
            ],

            ['attribute' => 'user_id',
                'label'=>'用户ID',
                'headerOptions' => ['width'=>100],
            ],
            [
                'attribute'=>'category_id',
                'label'=>'分类id',
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
            ['attribute'=>'status',
                'label' =>'状态',
                'filter'=>\common\util\Constants::$goodsStatus,
                'content' => function($model){
                    return \common\util\Constants::$goodsStatus[$model->status];
                }
            ],
            // 'num',
            // 'price',
            // 'demandstatus',
            // 'otherstatus',
             'area',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
