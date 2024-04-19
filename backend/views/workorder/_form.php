<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workorder-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'workorder_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'workorder_date')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'assign_emp_id')->textInput() ?>
        </div>
    </div>


<div class="row">
    <div class="col-lg-4">
        <?= $form->field($model, 'asset_id')->textInput() ?>

        <?= $form->field($model, 'asset_id')->Widget(\kartik\select2\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map(\backend\models\asset::find()->all(), 'id', function ($data) {
                return $data->name;
            }),
            'options' => [
                'placeholder' => '--เครื่องจักร--',
//                        'onchange' => 'showid($(this))',
            ]
        ]) ?>

    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'work_recieve_date')->textInput() ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'work_assign_date')->textInput() ?>
    </div>
</div>








    <?= $form->field($model, 'status')->textInput() ?>
    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
