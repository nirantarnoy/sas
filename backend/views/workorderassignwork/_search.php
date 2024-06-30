<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\WorkorderassignworkSearch $model */
/** @var yii\widgets\ActiveForm $form */

$workstatus = \backend\models\Workorderstatus::find()->all();

?>

<div class="workorderassignwork-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <br/>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'workorder_no') ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'workorder_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'asset_id') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?php echo $form->field($model, 'status')->widget(kartik\select2\Select2::className(),
                ['data' => \yii\helpers\ArrayHelper::map($workstatus, 'id', 'name')]) ?>
        </div>
        <div class="col-lg-4">
            <div class="form-group" style="margin-top: 30px;">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


    <?php // echo $form->field($model, 'work_recieve_date') ?>

    <?php // echo $form->field($model, 'work_assign_date') ?>



    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'problem_text') ?>

    <?php // echo $form->field($model, 'stop6') ?>

    <?php // echo $form->field($model, 'abnormal') ?>

    <?php // echo $form->field($model, 'view_point') ?>

    <?php // echo $form->field($model, 'work_cause_id') ?>

    <?php // echo $form->field($model, 'weak_point_analysis') ?>

    <?php // echo $form->field($model, 'cause_risk_id') ?>

    <?php // echo $form->field($model, 'factor_risk_1') ?>

    <?php // echo $form->field($model, 'factor_risk_2') ?>

    <?php // echo $form->field($model, 'factor_risk_3') ?>

    <?php // echo $form->field($model, 'factor_total') ?>

    <?php // echo $form->field($model, 'factor_risk_final') ?>



    <?php ActiveForm::end(); ?>

</div>
