<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Workorderassignwork $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="workorderassignwork-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'workorder_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'workorder_date')->textInput() ?>

    <?= $form->field($model, 'asset_id')->textInput() ?>

    <?= $form->field($model, 'assign_emp_id')->textInput() ?>

    <?= $form->field($model, 'work_recieve_date')->textInput() ?>

    <?= $form->field($model, 'work_assign_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'problem_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stop6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abnormal')->textInput() ?>

    <?= $form->field($model, 'view_point')->textInput() ?>

    <?= $form->field($model, 'work_cause_id')->textInput() ?>

    <?= $form->field($model, 'weak_point_analysis')->textInput() ?>

    <?= $form->field($model, 'cause_risk_id')->textInput() ?>

    <?= $form->field($model, 'factor_risk_1')->textInput() ?>

    <?= $form->field($model, 'factor_risk_2')->textInput() ?>

    <?= $form->field($model, 'factor_risk_3')->textInput() ?>

    <?= $form->field($model, 'factor_total')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
