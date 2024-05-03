<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Location */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลที่ตั้ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="location-view">

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
        //    'id',
            'code',
            'name',
            'description',
//            'department_id',
            [
                'attribute' => 'department_id',
                'value' => function ($model){
                    return \backend\models\Department::findName($model->department_id);
                }
            ],
            'pos_x',
            'pos_y',
            'loc_photo',
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
