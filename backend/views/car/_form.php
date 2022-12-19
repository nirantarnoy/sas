<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var backend\models\Car $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'plate_no')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <!-- <?= $form->field($model, 'car_type_id')->textInput() ?> -->
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'car_type_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Cartype::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--ประเภทรถ--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'tail_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Car::find()->where(['car_type_id'=>5])->all(), 'id', 'name'),
                'options' => [
                    'placeholder' => '--ต่อพ่วง--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'horse_power')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'fuel_type')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\FuelType::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--ประเภทน้ำมัน--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'company_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\company::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--company--'
                ]
            ]) ?>
        </div>
    </div>

    <!-- <?= $form->field($model, 'company_id')->textInput() ?> -->


    <!-- <?= $form->field($model, 'status')->textInput() ?> -->
    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>


    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?> -->


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
