<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\WorkorderassignworkSearch $model */
/** @var yii\widgets\ActiveForm $form */

$workstatus = \backend\models\Workorderstatus::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();

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
                [
                    'data' => \yii\helpers\ArrayHelper::map($workstatus, 'id', 'name'),
                    'options' => [
                        'value' => $model->status = null ? 6 : $model->status,
                    ]
                ]
            ) ?>
        </div>
        <div class="col-lg-4">
            <div class="form-group" style="margin-top: 30px;">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
