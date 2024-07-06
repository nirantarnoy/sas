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

    <?php //echo $form->field($model, 'asset_id')->textInput(['maxlength' => true,]) ?>
    <?= $form->field($model, 'asset_id')->Widget(\kartik\select2\Select2::className(), [
    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Asset::find()->all(), 'id', function ($data) {
    return $data->name;
    }),
    'options' => [
    'placeholder' => '--เครื่องจักร--',
    'onchange' => 'getLocation($(this))',
    ]
    ]) ?>

    <?= $form->field($model, 'assign_emp_id')->textInput(['maxlength' => true,
        'value' => $model->isNewRecord ? '' : \backend\models\Employee::findName($model->workorder_no)]) ?>

    <?= $form->field($model, 'work_recieve_date')->textInput(['maxlength' => true,
        'value' => date('d-m-Y H:i:s',strtotime($model->work_recieve_date) )  ]) ?>

    <?= $form->field($model, 'work_assign_date')->textInput(['maxlength' => true,
        'value' => date('d-m-Y H:i:s',strtotime($model->work_assign_date) )  ]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true,
        'value' => $model->isNewRecord ? '' : \backend\models\Workorderstatus::findName($model->status)]) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true,
        'value' => date('d-m-Y H:i:s',$model->created_at)  ]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true,
        'value' => $model->isNewRecord ? '' : \backend\models\Employee::findName($model->created_by)]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true,
        'value' => date('d-m-Y H:i:s',$model->updated_at)  ]) ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true,
        'value' => $model->isNewRecord ? '' : \backend\models\Employee::findName($model->updated_by)]) ?>

    <?= $form->field($model, 'problem_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stop6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abnormal')->textInput() ?>

    <?= $form->field($model, 'view_point')->textInput() ?>

    <?= $form->field($model, 'work_cause_id')->textInput(['maxlength' => true,
        'value' => $model->isNewRecord ? '' : \backend\models\Workordercause::findCauseName($model->work_cause_id)]) ?>

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
