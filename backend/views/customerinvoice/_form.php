<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Customerinvoice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customerinvoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'invoice_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'invoice_date')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'invoice_target_date')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'sale_id')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'total_amount')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'vat_amount')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'total_all_amount')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'customer_id')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>รายละเอียด</b></th>
                    <th><b>จำนวน</b></th>
                    <th><b>ราคาต่อหน่วย</b></th>
                    <th><b>ยอดรวม</b></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>



    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_extend_remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_extend_remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
