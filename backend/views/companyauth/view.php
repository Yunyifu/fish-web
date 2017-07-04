<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\util\Constants;
/* @var $this yii\web\View */
/* @var $model common\models\Companyauth */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '工场认证列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companyauth-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除该记录?',
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
            'id_hand_pic',
            'company_pic',
            'factory_pic',
            [
                'attribute' => 'status',
                'label'=>'认证状态',
                'value'=>function($model){
                    if($model->status == Constants::AUTH_NO_CHECK){
                        return '未认证';
                    }else if($model->status == Constants::AUTH_CHECKING){
                        return '待审核';
                    }else if($model->status == Constants::AUTH_CHECKED){
                        return '已认证';
                    }else if($model->status == Constants::AUTH_CHECK_REFUSED){
                        return '认证拒绝';
                    }

                }
            ],
            [
                'attribute' =>'saler',
            ],
            [
                    'attribute' =>'created_at',
                    'label' => '生成于',
                    'value'=>function($model){
                    return date("Y-m-d H:i:s", $model->created_at);
                    },
            ],
            [
                'attribute' =>'updated_at',
                'label' => '更新于',
                'value'=>function($model){
                    return date("Y-m-d H:i:s", $model->updated_at);
                },
            ],
        ],
    ]) ?>

</div>
