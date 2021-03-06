<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Demand */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '采购信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demand-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除吗',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            //'thumb',
            'user_id',
            'category_id',
            'num',
            'price',
            'demandstatus',
            'otherstatus',
            'area',
            'position',
            'status',
            'desc:ntext',
            //'pic',
            'created_at',
            'updated_at',
            [
                'attribute'=>'dealers',
                'value' => function($model){
                    return isset($model->dealer)?$model->dealername.'：'.$model->dealer:'';
                },

            ],
        ],
    ]) ?>

</div>
