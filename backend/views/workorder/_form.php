<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorder */
/* @var $form yii\widgets\ActiveForm */

$loc_name = '';
if ($model->asset_id != null) {
    $loc_name = \backend\models\Asset::findLocationName($model->asset_id);
}
?>

<div class="workorder-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'workorder_no')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => $model->isNewRecord ? '' : $model->workorder_no]) ?>
        </div>
        <div class="col-lg-4">
            <?php $model->workorder_date = $model->isNewRecord ? date('d/m/Y') : date('d/m/Y', strtotime($model->workorder_date)); ?>
            <?= $form->field($model, 'workorder_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'assign_emp_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->all(), 'id', function ($data) {
                    return $data->fname . ' ' . $data->lname;
                }),
                'options' => [
                    'placeholder' => '--เลือกพนักงาน--'
                ]
            ]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'asset_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Asset::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--เครื่องจักร--',
                    'onchange' => 'getLocation($(this))',
                ]
            ]) ?>

        </div>
        <div class="col-lg-3">
            <label for="">ที่ตั้งเครื่องจักร</label>
            <input type="text" class="form-control location-name" readonly value="<?= $loc_name ?>">
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'work_recieve_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'work_assign_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('Y-m-d'),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy'
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <input type="hidden" name="work_created_by" value="<?= $model->created_by ?>">
            <?= $form->field($model, 'created_by')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => \backend\models\User::findName($model->created_by)]) ?>
        </div>
        <div class="col-lg-3">
            <input type="hidden" name="work_status" value="<?= $model->status ?>">
            <?= $form->field($model, 'status')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Workorderstatus::find()->all(), 'id', 'name'),
                'pluginOptions' => [
                    'disabled' => true,
                ]
            ])->label() ?>
        </div>

        <div class="col-lg-3"></div>
        <div class="col-lg-3"></div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$url_to_get_location = \yii\helpers\Url::to(['asset/getlocation'],true);
$js=<<<JS
function getLocation(e){
    var asset_id = e.val();
    $.ajax({
        'type': 'post',
        'dataType': 'html',
        'url': "$url_to_get_location",
        'data': {'asset_id': asset_id},
        'success': function(data){
            if(data!=''){
                $(".location-name").val(data);
            }
        }       
    });    
}
JS;
$this->registerJs($js,static::POS_END);
?>