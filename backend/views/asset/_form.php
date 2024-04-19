<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Asset */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'asset_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'asset_cat_id')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'asset_brand_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'model_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'serail_no')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">

            <?= $form->field($model, 'department_id')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'location_id')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'supplier_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'supplier_contact')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'cost')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'recieve_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'waranty_exp_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
    </div>
<div class="row">
    <div class="col-lg-4">
        <?= $form->field($model, 'watt')->textInput() ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'electric_type')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'breaker_no')->textInput(['maxlength' => true]) ?>
    </div>
</div>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
