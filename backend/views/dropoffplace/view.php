<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\DropoffPlace $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'จุดขึ้นสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dropoff-place-view">


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
            'name',
            'description',
//            'status',
            [
                'attribute' => 'car_type_id',
                'value' => function ($data) {
                    return \backend\models\CarType::findName($data->car_type_id);
                }
            ],
            'hp',
            'oil_rate_qty',
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
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
        ],
    ]) ?>

</div>
