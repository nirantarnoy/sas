<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Workordercause $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'สาเหตุปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="workordercause-view">

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'code',
            'name',
            'description',
//            'status',
            ['attribute' => 'status',
                'format' => 'html',
                'value' => function ($data) {
                    if($data->status == 0){
                        return '<div class="badge badge-secondary">'.\backend\helpers\CommonStatus::getTypeById($data->status).'</div>';
                    }else{
                        return '<div class="badge badge-success">'.\backend\helpers\CommonStatus::getTypeById($data->status).'</div>';
                    }
                },],
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
        ],
    ]) ?>

</div>
