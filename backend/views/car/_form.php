<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var backend\models\Car $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <br>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <br>

    <?= $form->field($model, 'plate_no')->textInput(['maxlength' => true]) ?>
    <br>

    <!-- <?= $form->field($model, 'car_type_id')->textInput() ?> -->

    <?= $form->field($model, 'car_type_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Cartype::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--ประเภทรถ--'
                ]
            ]) ?>
            <br>

    <!-- <?= $form->field($model, 'company_id')->textInput() ?> -->
    <?= $form->field($model, 'company_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\company::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--company--'
                ]
            ]) ?>
            <br>

    <!-- <?= $form->field($model, 'status')->textInput() ?> -->
    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>


    

    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?> -->
    <br />

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
