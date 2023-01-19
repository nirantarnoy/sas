<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Car $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="car-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

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
            // 'id',
            'name',
            'description',
            'plate_no',
//            'brand_id',
            [
                'attribute' => 'brand_id',
                'value' => function ($model){
                    return \backend\models\CarBrand::findCarbrandName($model->brand_id);
                }
            ],
            // 'car_type_id',
            [
                'attribute' => 'car_type_id',
                'value' => function ($model){
                    return \backend\models\CarType::findName($model->car_type_id);
                }
            ],

            [
                'attribute' => 'type_id',
                'value' => function ($model){
                    return \backend\helpers\CarcatType::getTypeById($model->type_id);
                }
            ],
            [
                'attribute' => 'fuel_type',
                'value' => function ($model){
                    return \backend\models\FuelType::findFuelTypeName($model->fuel_type);
                }
            ],
            'horse_power',
            // 'company_id',
            [
                'attribute' => 'company_id',
                'value' => function ($model){
                    return \backend\models\Company::findCompanyName($model->company_id);
                }
            ],
            // 'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->status == 1) {
                        return '<div class="badge badge-success" >ใช้งาน</div>';
                    } else {
                        return '<div class="badge badge-secondary" >ไม่ใช้งาน</div>';
                    }
                }
            ],
        
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
        ],
    ]) ?>

</div>
