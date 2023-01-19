<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Workqueue $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="workqueue-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'work_queue_no')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => $model->isNewRecord ? 'Draft' : $model->work_queue_no]) ?>
        </div>
        <div class="col-lg-4">
            <?php $model->work_queue_date = $model->isNewRecord?date('Y-m-d'): date('Y-m-d',strtotime($model->work_queue_date))?>
            <?= $form->field($model, 'work_queue_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d/m/Y')
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'route_plan_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\RoutePlan::find()->all(), 'id', function ($data) {
                    return $data->des_name;
                }),
                'options' => [
                    'placeholder' => '--จุดขึ้นสินค้า--',
                    'onchange'=>'getRouteplan($(this))'
                ]
            ])->label('จุดขึ้นสินค้า') ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'customer_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Customer::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--ลูกค้า--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'emp_assign')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->all(), 'id', function ($data) {
                    return $data->fname . ' ' . $data->lname;
                }),
                'options' => [
                    'placeholder' => '--พนักงาน--'
                ]
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'car_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Car::find()->where(['type_id' => '1'])->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--รถ--',
                    'onchange' => 'getCarinfo($(this))',
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <label for="">ทะเบียน</label>
            <input type="text" class="form-control car-plate-no" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">ประเภทรถ</label>
            <input type="text" class="form-control car-type" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">แรงม้า</label>
            <input type="text" class="form-control hp" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'tail_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Car::find()->where(['type_id' => '2'])->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--พ่วง--',
                    'onchange' => 'getTailinfo($(this))',
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <label for="">ทะเบียน</label>
            <input type="text" class="form-control tail-plate-no" readonly>
        </div>
        <div class="col-lg-4"></div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'weight_on_go')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'weight_go_deduct')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'go_deduct_reason')->textarea(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'weight_on_back')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'back_deduct')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'back_reason')->textarea(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'tail_back_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Car::find()->where(['type_id' => '2'])->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--พ่วง--',
                    'onchange' => 'getTailinfo1($(this))',
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <label for="">ทะเบียน</label>
            <input type="text" class="form-control tail-back-plate-no" readonly>
        </div>
        <div class="col-lg-4">
            <label for="">ราคาน้ำมัน</label>
            <input type="text" class="form-control oil-daily-price" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <label for="">ระยะทางไป-กลับ</label>
            <input type="text" class="form-control total-distance" readonly>
        </div>
        <div class="col-lg-4">
            <label for="">รวมจำนวน(ลิตร)</label>
            <input type="text" class="form-control total-qty" readonly>
        </div>
        <div class="col-lg-4">
            <label for="">รวมจำนวน(บาท)</label>
            <input type="text" class="form-control total-amount" readonly>
        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="row">
        <div class="col-lg-4">
            <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                <?php if (!$model->isNewRecord && $model->approve_status != 1): ?>
                    <a class="btn btn-primary" href="<?= \yii\helpers\Url::to(['workqueue/approvejob', 'id' => $model->id,'approve_id'=>1], true) ?>">อนุมัติจำนวน</a>
                <?php endif;?>
            </div>
        </div>
        <div class="col-lg-6" style="text-align: right">
            <?php if (!$model->isNewRecord): ?>
                <a href="<?= \yii\helpers\Url::to(['workqueue/printdocx', 'id' => $model->id], true) ?>"
                   class="btn btn-warning">พิมพ์</a>
            <?php endif; ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php
$url_to_getCardata = \yii\helpers\Url::to(['car/getcarinfo'], true);
$url_to_routeplan = \yii\helpers\Url::to(['car/getrouteplan'], true);

$js = <<<JS
var removelist = [];

$(function(){
    
});
function getRouteplan(e){
    if(e.val() > 0){
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_routeplan',
            'data': {'route_plan_id': e.val()},
            'success': function(data){
                // alert(data);
                if(data != null){
                    // alert(data[0]['plate_no']);
                    var distance = data[0]['total_distance'];
                    var rate_qty = data[0]['total_rate_qty'];
                    var dropoff_qty = data[0]['total_dropoff_rate_qty'];
                    $('.total-distance').val(distance);
                    $('.total-qty').val(parseFloat(rate_qty) + parseFloat(dropoff_qty));
                }
            },
            'error': function(data){
                 alert(data);//return;
            }
        });
    }
}
function getCarinfo(e){
    // alert(e.val());
    if(e.val() != ''){
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_getCardata',
            'data': {'car_id': e.val()},
            'success': function(data){
                // alert(data);
                if(data != null){
                    // alert(data[0]['plate_no']);
                    var plat_no = data[0]['plate_no'];
                    var hp = data[0]['hp'];
                    var car_type = data[0]['car_type'];
                    $('.car-plate-no').val(plat_no);
                    $('.car-type').val(car_type);
                    $('.hp').val(hp);
                }
            },
            'error': function(data){
                 alert(data);//return;
            }
        });
    }
}
function getTailinfo(e){
    // alert(e.val());
    if(e.val() != ''){
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_getCardata',
            'data': {'car_id': e.val()},
            'success': function(data){
                // alert(data);
                if(data != null){
                    // alert(data[0]['plate_no']);
                    var plat_no = data[0]['plate_no'];
                    $('.tail-plate-no').val(plat_no);
                }
            },
            'error': function(data){
                 alert(data);//return;
            }
        });
    }
}
function getTailinfo1(e){
    // alert(e.val());
    if(e.val() != ''){
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_getCardata',
            'data': {'car_id': e.val()},
            'success': function(data){
                // alert(data);
                if(data != null){
                    // alert(data[0]['plate_no']);
                    var plat_no = data[0]['plate_no'];
                    $('.tail-back-plate-no').val(plat_no);
                }
            },
            'error': function(data){
                 alert(data);//return;
            }
        });
    }
}


JS;
$this->registerJs($js, static::POS_END);
?>
