<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'thumb',
            'user_id',
            [
                    'attribute'=>'category_id',
                    'label'=>'分类id',
                    'value'=>function($model){
                    return \common\models\Category::findOne($model->category_id)->name;
                    }
            ],
            'num',
            'price',
            'area',
            'position',
            [
                'attribute'=>'status',
                'label'=>'状态',
                'value'=>function($model){
                    return \common\util\Constants::$goodsStatus[$model->status];
                }
            ],
            'desc:ntext',
            [
                    'attribute'=>'pic',
                    'label' =>'图片',
                    'value'=> \backend\util\Utils::renderPreviewImgs($model->pic),
                    'format' => 'raw'

            ],
            [
                    'attribute'=>'created_at',
                    'label'=>'创建于',
                    'value'=>function($model){
        return date('y-m-d h:m:s',$model->created_at);
                    }
            ],
            [
                    'attribute'=>'updated_at',
                    'label'=>'更新于',
                    'value'=>function($model){
        return date('y-m-d h:m:s',$model->updated_at);
                    }
            ],
            'rank',
            [
                    'attribute'=>'dealers',
                    'value' => $model->dealer,

            ],
        ],
    ]) ?>

</div>
