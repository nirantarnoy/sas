<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Fuel $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fuels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fuel-view">

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
            'id',
            'name',
            'description',
            // 'fuel_type_id',
            [
                'attribute' => 'fuel_type_id',
                'value' => function ($model){
                    return \backend\models\FuelType::findFuelTypeName($model->fuel_type_id);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label'=>'สถานะ',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        return '<div>ใช้งาน</div>';
                    } else {
                        return '<div>ไม่ใช้งาน</div>';
                    }
                }
            ],
            
            [
                'attribute' => 'company_id',
                'value' => function ($model){
                    return \backend\models\Company::findCompanyName($model->company_id);
                }
            ],
            // 'status',
            // 'company_id',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
        ],
    ]) ?>

</div>