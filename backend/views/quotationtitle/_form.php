<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Quotationtitle $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="quotationtitle-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?php $model->created_at_display = $model->created_at !=null? date('d-m-Y H:i:s', $model->created_at):''?>
            <?= $form->field($model, 'created_at_display')->textInput(['readonly' => 'readonly']) ?>
        </div>
        <div class="col-lg-3">
            <?php $model->created_by_display = $model->created_by !=null? \backend\models\User::findName($model->created_by):''?>
            <?= $form->field($model, 'created_by_display')->textInput(['readonly' => 'readonly']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h4>รายละเอียด</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>จากคลังสินค้า</th>
        <th>Route</th>
        <th>โซนพื้นที่</th>
        <th>ระยะทาง</th>
        <th>ปริมาณเฉลี่ยตัน/ปี</th>
        <th>ราคาที่เสนอ</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
