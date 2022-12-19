<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Workqueue $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="workqueue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'work_queue_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_queue_date')->widget(\kartik\date\DatePicker::className(), [
        'value' => date('d/m/Y')
    ]) ?>


    <?= $form->field($model, 'customer_id')->Widget(\kartik\select2\Select2::className(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Customer::find()->all(), 'id', function ($data) {
            return $data->name;
        }),
        'options' => [
            'placeholder' => '--ลูกค้า--'
        ]
    ]) ?>

    <?= $form->field($model, 'emp_assign')->Widget(\kartik\select2\Select2::className(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->all(), 'id', function ($data) {
            return $data->fname.' '.$data->lname;
        }),
        'options' => [
            'placeholder' => '--พนักงาน--'
        ]
    ]) ?>

    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
