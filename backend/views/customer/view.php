<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Customer $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">


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
            'code',
            'name',
            'business_type',
//            'status',
//            'district';
        ],
    ]) ?>
    <div class="row">
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'street',
                        'label' => 'ถนน',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findStreet($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'district',
                        'label' => 'ตำบล/แขวง',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findDistrict($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'amphur',
                        'label' => 'อำเภอ/เขต',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findAmphur($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'province',
                        'label' => 'จังหวัด',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findProvince($model->id);
                        }
                    ],
                ]]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    [
                        'attribute' => 'zipcode',
                        'label' => 'รหัสไปรษณีย์',
                        'value' => function ($model) {
                            return \backend\models\AddressInfo::findZipcode($model->id);
                        }
                    ],


//            'crated_at',
//            'created_by',
//            'updated_at',
//            'udpated_by',
                ],
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'label' => 'สถานะ',
                        'value' => function ($model) {
                            if ($model->status == 1) {
                                return '<div>ใช้งาน</div>';
                            } else {
                                return '<div>ไม่ใช้งาน</div>';
                            }
                        }
                    ],
                ]]) ?>
        </div>
    </div>

</div>
