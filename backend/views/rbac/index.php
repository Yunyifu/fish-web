<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\util\Constants;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            'description:text:名称',
            'name:text:标识',
            'rule_name:text:规则名称',
            'created_at:datetime:创建时间',
            'updated_at:datetime:更新时间',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{assign} {update} {delete}',
                'buttons' => [
                    'assign' => function ($url, $model, $key) {
                        return Html::a('分配权限', ['assignitem', 'name' => $model['name']]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('更新', ['updateitem', 'name' => $model['name']]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', ['deleteitem', 'name' => $model['name']]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
