<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '分类列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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
            'name',
            [
                'attribute'=>'status',
                'label'=>'状态',
                'filter'=>\common\util\Constants::$cateStatus,
                'value'=>function($model){
                    return \common\util\Constants::$cateStatus[$model->status];
                }
            ],
            [
                'attribute' => 'parent_id',
                'value'=>function($model){
                    $parentCate = \common\models\Category::findOne($model->parent_id);
                    if(!empty($parentCate)){
                        return $parentCate->name;
                    }
                }

            ],
            [
                'attribute'=>'created_at',
                'label'=>'创建于',
                'value'=>function($model){
                    return date('Y-m-d h:m:s',$model->created_at);
                }
            ],
            [
                'attribute'=>'updated_at',
                'label'=>'更新于',
                'value'=>function($model){
                    return date('Y-m-d h:m:s',$model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>
