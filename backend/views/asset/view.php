<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Asset */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'เครื่องจักร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-view">

    <br>

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
            'asset_no',
            'name',
            'description',
//            'asset_cat_id',
            [
                'attribute' => 'asset_cat_id',
                'value' => function ($model){
                    return \backend\models\Assetcategory::findName($model->asset_cat_id);
                }
            ],
            'asset_brand_name',
            'model_no',
            'serail_no',
//            'department_id',
            [
                'attribute' => 'department_id',
                'value' => function ($model){
                    return \backend\models\Department::findName($model->department_id);
                }
            ],
//            'location_id',
            [
                'attribute' => 'location_id',
                'value' => function ($model){
                    return \backend\models\Location::findName($model->location_id);
                }
            ],
            'supplier_name',
            'supplier_contact',
            'cost',
            'recieve_date',
            'waranty_exp_date',
            'watt',
            'electric_type',
            'breaker_no',
            'photo',
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
