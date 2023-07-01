<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Car $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'รถ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$doc_type_data = \backend\helpers\CardocType::asArrayObject();
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

    <div class="row">
        <div class="col-lg-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    'name',
                    'description',
                    'plate_no',
//            'brand_id',
                    [
                        'attribute' => 'driver_id',
                        'value' => function ($data) {
                            return \backend\models\Employee::findFullName($data->driver_id);
                        }
                    ],
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

                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
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
    </div>



    <br />
    <div class="row">
        <div class="col-lg-12">
            <h5>เอกสารแนบ</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 20%">ประเภท</th>
                    <th style="width: 55%">แนบเอกสาร</th>
                    <th>-</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i=0;$i<=count($doc_type_data)-1;$i++): ?>
                    <tr>
                        <td><?=$doc_type_data[$i]['name']?></td>
                        <td>
                            <input type="file" class="form-control" name="file_doc_<?=$i?>">
                        </td>
                        <td></td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
