<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Auth */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '认证列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否要删除?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'name',
            'gender',
            'telphone',
            //'id_hand_pic',
            ['attribute'=>'id_hand_pic', 'format' => ['image',['width' => 300,]],'value'=>function($data){
                return 'http://dev.image.alimmdn.com'.$data->id_hand_pic;
            }],
            //'ship_auth_pic',
            ['attribute'=>'ship_auth_pic', 'format' => ['image',['width' => 300,]],'value'=>function($data){
                return 'http://dev.image.alimmdn.com'.$data->ship_auth_pic;
            }],
            //'ship_pic',
            ['attribute'=>'ship_pic', 'format' => ['image',['width' => 300,]],'value'=>function($data){
                return 'http://dev.image.alimmdn.com'.$data->ship_pic;
            }],
            [
                'attribute' => 'status',
                'label'=>'认证状态',
                'value'=>function($model){
                    if($model->status == \common\util\Constants::AUTH_NO_CHECK){
                        return '未认证';
                    }else if($model->status == \common\util\Constants::AUTH_CHECKING){
                        return '待审核';
                    }else if($model->status == \common\util\Constants::AUTH_CHECKED){
                        return '已认证';
                    }else if($model->status == \common\util\Constants::AUTH_CHECK_REFUSED){
                        return '认证拒绝';
                    }

                }
            ],
            [
                'attribute' =>'saler',
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
