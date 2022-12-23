<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Fuel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fuel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fuel_type_id')->Widget(\kartik\select2\Select2::className(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\FuelType::find()->all(), 'id', function ($data) {
            return $data->name;
        }),
        'options' => [
            'placeholder' => '--ประเภทน้ำมัน--'
        ]
    ]) ?>

    <!-- <?= $form->field($model, 'status')->textInput() ?> -->

    <?= $form->field($model, 'company_id')->Widget(\kartik\select2\Select2::className(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Company::find()->all(), 'id', function ($data) {
            return $data->name;
        }),
        'options' => [
            'placeholder' => '--บริษัท--'
        ]
    ]) ?>
    <?= $form->field($model, 'active_price')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'active_price_date')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
