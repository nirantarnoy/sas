<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'gender')->widget(\kartik\select2\Select2::className(),[
                'data'=>\yii\helpers\ArrayHelper::map(\backend\helpers\GenderType::asArrayObject(),'id','name'),
                'options' => [
                    'placeholder'=>'--เลือกเพศ--'
                ],
                'pluginOptions' => [
                    'allowClear'=>true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'department_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Department::find()->all(),'id','name'),
                'options' => [
                    'placeholder'=>'--เลือกแผนก--'
                ],
                'pluginOptions' => [
                    'allowClear'=>true,
                ]
            ]) ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'position_id')->widget(\kartik\select2\Select2::className(),[
                'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Position::find()->all(),'id','name'),
                'options' => [
                    'placeholder'=>'--เลือกตำแหน่งงาน--'
                ],
                'pluginOptions' => [
                    'allowClear'=>true,
                ]
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
