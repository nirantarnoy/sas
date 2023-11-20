<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Workqueue $model */
/** @var yii\widgets\ActiveForm $form */
$plate_no = "";
$hp = "";
$car_type = "";
$driver_id = "";
$driver_name = "";

$t_back_plate = '';
$t_plate = '';

if (!$model->isNewRecord) {
    $plate_no = \backend\models\Car::getPlateno($model->car_id);
    $hp = \backend\models\Car::getHp($model->car_id);
    $car_type = \backend\models\Car::getCartype($model->car_id);
    $driver_id = \backend\models\Car::getDriver($model->car_id);
    $driver_name = \backend\models\Employee::findFullName($driver_id);

    $t_plate = \backend\models\Car::getPlateno($model->tail_id);
    $t_back_plate = \backend\models\Car::getPlateno($model->tail_back_id);
}

?>

<div class="workqueue-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <input type="hidden" class="remove-list" name="remove_list" value="">
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'work_queue_no')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => $model->isNewRecord ? 'Draft' : $model->work_queue_no]) ?>
        </div>
        <div class="col-lg-4">
            <?php $model->work_queue_date = $model->isNewRecord ? date('Y-m-d') : date('Y-m-d', strtotime($model->work_queue_date)) ?>
            <?= $form->field($model, 'work_queue_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d/m/Y'),
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'route_plan_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\DropoffPlace::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'placeholder' => '--จุดขึ้นสินค้า--',
                    'onchange' => '$("#route-plan-id").val($(this).val())'
                    //  'onchange' => 'getRouteplan($(this))'
                ]
            ])->label('จุดขึ้นสินค้า') ?>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'customer_id')->Widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Customer::find()->all(), 'id', function ($data) {
                    return $data->name;
                }),
                'options' => [
                    'id' => 'customer-selected-id',
                    'placeholder' => '--ลูกค้า--'
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'dp_no')->textInput(['maxlength' => true]) ?>
        </div>
        <!--        <div class="col-lg-3">-->
        <!--            --><?php //echo $form->field($model, 'work_option_type_id')->Widget(\kartik\select2\Select2::className(), [
        //                'data' => \yii\helpers\ArrayHelper::map(\common\models\WorkOptionType::find()->all(), 'id', 'name'),
        //                'options' => [
        //                    'id'=>'work-option-selected-id',
        //                    'placeholder' => '--เลือก--'
        //                ]
        //            ]) ?>
        <!--        </div>-->
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

    </div>

    <div class="row">

        <div class="col-lg-3">
            <label for="">ทะเบียน</label>
            <input type="text" class="form-control car-plate-no" value="<?= $plate_no ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">ประเภทรถ</label>
            <input type="text" class="form-control car-type" value="<?= $car_type ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">แรงม้า</label>
            <input type="text" class="form-control hp" value="<?= $hp ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">พนักงานขับรถ</label>
            <input type="text" class="form-control emp-assign-driver-id" value="<?= $driver_name ?>" readonly>
            <?= $form->field($model, 'emp_assign')->hiddenInput(['id' => 'emp-assign', 'value' => $driver_id])->label(false) ?>

            <?php //echo $form->field($model, 'emp_assign')->Widget(\kartik\select2\Select2::className(), [
            //                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->all(), 'id', function ($data) {
            //                    return $data->fname . ' ' . $data->lname;
            //                }),
            //                'options' => [
            //                    'id' => 'driver-id',
            //                    'readonly'=> true,
            //                    'placeholder' => '--พนักงาน--'
            //                ]
            //            ]) ?>
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
            <input type="text" class="form-control tail-plate-no" value="<?= $t_plate ?>" readonly>
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
            <input type="text" class="form-control tail-back-plate-no" value="<?= $t_back_plate ?>" readonly>
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
        <div class="col-lg-3">
            <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->field($model, 'is_labur')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control', 'onchange' => 'enableLabour($(this))']])->label() ?>
        </div>
        <div class="col-lg-3"> <?php echo $form->field($model, 'is_express_road')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control', 'onchange' => 'enableExpressroad($(this))']])->label() ?></div>
        <div class="col-lg-3"> <?php echo $form->field($model, 'is_other')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control', 'onchange' => 'enableOther($(this))']])->label() ?></div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'labour_price')->textinput(['maxlength' => true, 'id' => 'labour-price',]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'express_road_price')->textInput(['maxlength' => true, 'id' => 'express-road-price',]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'other_price')->textInput(['maxlength' => true, 'id' => 'other-price',]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4"><?= $form->field($model, 'test_price')->textinput(['maxlength' => true, 'id' => 'test-price',]) ?></div>
        <div class="col-lg-4"><?= $form->field($model, 'damaged_price')->textinput(['maxlength' => true, 'id' => 'damaged-price',]) ?></div>
        <div class="col-lg-4"></div>
    </div>

    <br/>

    <h6>แนบเอกสาร</h6>

    <?php if ($model_line_doc == null): ?>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered" id="table-list">
                    <tbody>
                    <tr>
                        <td>
                            <input type="hidden" class="rec-id" name="rec_id[]" value="0">
                            <input type="text" class="form-control line-doc-name" name="line_doc_name[]" value="">
                        </td>
                        <td>
                            <input type="file" class="line-file-name" name="line_file_name[]">
                        </td>
                        <td>
                            <div class="btn btn-danger" onclick="removeline($(this))">ลบ</div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>
                            <div class="btn btn-primary" onclick="addline($(this))">เพิ่ม</div>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered" id="table-list">
                    <tbody>
                    <?php foreach ($model_line_doc as $val): ?>
                        <tr data-var="<?= $val->id ?>">
                            <td>
                                <input type="hidden" class="rec-id" name="rec_id[]" value="<?= $val->id ?>">
                                <input type="text" class="form-control line-doc-name" name="line_doc_name[]"
                                       value="<?= $val->description ?>">
                            </td>
                            <td>
                                <a href="<?= \Yii::$app->getUrlManager()->getBaseUrl() . '/uploads/workqueue_doc/' . $val->doc ?>"
                                   target="_blank">ดูเอกสาร</a></td>
                            </td>
                            <td>
                                <div class="btn btn-danger" onclick="removeline($(this))">ลบ</div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>
                            <input type="hidden" class="rec-id" name="rec_id[]" value="0">
                            <input type="text" class="form-control line-doc-name" name="line_doc_name[]" value="">
                        </td>
                        <td>
                            <input type="file" class="line-file-name" name="line_file_name[]">
                        </td>
                        <td>
                            <div class="btn btn-danger" onclick="removeline($(this))">ลบ</div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>
                            <div class="btn btn-primary" onclick="addline($(this))">เพิ่ม</div>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>

    <?php endif; ?>


    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                <?php if (!$model->isNewRecord && $model->approve_status != 1): ?>
                    <a class="btn btn-primary"
                       href="<?= \yii\helpers\Url::to(['workqueue/approvejob', 'id' => $model->id, 'approve_id' => 1], true) ?>">อนุมัติจำนวน</a>
                <?php endif; ?>
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
<form id="form-delete-doc" action="<?= \yii\helpers\Url::to(['workqueue/removedoc'], true) ?>" method="post">
    <input type="hidden" name="work_queue_id" value="<?= $model->id ?>">
    <input type="hidden" class="work-queue-doc-delete" name="doc_name" value="">
</form>
<input type="hidden" id="is-page-new" value="<?= $model->isNewRecord ? 1 : 0 ?>">
<input type="hidden" id="route-plan-id" value="">
<input type="hidden" id="car-type-selected" value="">
<input type="hidden" id="labour-price-checked" value="0">
<input type="hidden" id="labour-price-plan" value="<?= $model->labour_price ?>">
<input type="hidden" id="express-road-price-checked" value="0">
<input type="hidden" id="express-road-price-plan" value="<?= $model->express_road_price ?>">
<input type="hidden" id="other-price-checked" value="0">
<input type="hidden" id="other-price-plan" value="<?= $model->other_price ?>">
<?php
$url_to_getCardata = \yii\helpers\Url::to(['car/getcarinfo'], true);
$url_to_routeplan = \yii\helpers\Url::to(['car/getrouteplan'], true);

$js = <<<JS
var removelist = [];
var loop = 0;
var loop2 = 0;
var loop3 = 0;
$(function(){
    // alert();
   
    if($("#is-page-new").val() == 0){
        $("#labour-price-checked").val($("#workqueue-is_labur").val());
        $("#express-road-price-checked").val($("#workqueue-is_express_road").val());
        $("#other-price-checked").val($("#workqueue-is_other").val());
    }
    
});


function enableLabour(e){
    if(loop >= 1){
        loop = 0;
        return false;
    }
   // alert('loop is' + loop);
  // alert($("#labour-price-checked").val());
   if($("#labour-price-checked").val() == 1){
     //  alert("has 1");
       $("#labour-price-checked").val(0);
       if($("#labour-price-checked").val() == 0){
           $("#labour-price-checked").val(0)
       }
         loop +=1;
         if($("#labour-price-checked").val() == 1){
           var labour = $('#labour-price-plan').val();
           $("#labour-price").val(labour);
           }else{
                $("#labour-price").val(0);
           }
         
       return false;
   }
 
   if($("#labour-price-checked").val() == 0){
      // alert("has 0");
       $("#labour-price-checked").val(1);
       if($("#labour-price-checked").val() == 0){
           $("#labour-price-checked").val(1)
       }
        loop +=1;
       if($("#labour-price-checked").val() == 1){
           getRouteplan();
           var labour = $('#labour-price-plan').val();
           $("#labour-price").val(labour);
           }else{
                $("#labour-price").val(0);
           }
      
       // loop = 0;
       return  false;
   }
  
 
}
function enableExpressroad(e){
    if(loop2 >= 1){
        loop2 = 0;
        return false;
    }
   if($("#express-road-price-checked").val() == 1){
     //  alert("has 1");
       $("#express-road-price-checked").val(0);
       if($("#express-road-price-checked").val() == 0){
           $("#express-road-price-checked").val(0)
       }
         loop2 +=1;
         if($("#express-road-price-checked").val() == 1){
          
           var labour = $('#express-road-price-plan').val();
           $("#express-road-price").val(labour);
           }else{
                $("#express-road-price").val(0);
           }
       return false;
   }
 
   if($("#express-road-price-checked").val() == 0){
      // alert("has 0");
       $("#express-road-price-checked").val(1);
       if($("#express-road-price-checked").val() == 0){
           $("#express-road-price-checked").val(1)
       }
        loop2 +=1;
       if($("#express-road-price-checked").val() == 1){
           getRouteplan();
           var labour = $('#express-road-price-plan').val();
           $("#express-road-price").val(labour);
           }else{
                $("#express-road-price").val(0);
           }
      
       // loop = 0;
       return  false;
   }
  
 
}


function enableOther(e){
   
    if(loop3 >= 1){
        loop3 = 0;
        return false;
    }
  
   if($("#other-price-checked").val() == 1){
     //  alert("has 1");
       $("#other-price-checked").val(0);
       if($("#other-price-checked").val() == 0){
           $("#other-price-checked").val(0)
       }
         loop3 +=1;
         if($("#other-price-checked").val() == 1){
           var labour = $('#other-price-plan').val();
           $("#other-price").val(labour);
           }else{
                $("#other-price").val(0);
           }
       return false;
   }
 
   if($("#other-price-checked").val() == 0){
      // alert("has 0");
       $("#other-price-checked").val(1);
       if($("#other-price-checked").val() == 0){
           $("#other-price-checked").val(1)
       }
        loop3 +=1;
       if($("#other-price-checked").val() == 1){
           getRouteplan();
           var labour = $('#other-price-plan').val();
           $("#other-price").val(labour);
           }else{
                $("#other-price").val(0);
           }
     
       // loop = 0;
       return  false;
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
                    // alert(data[0]['fuel_price']);
                    var plat_no = data[0]['plate_no'];
                    var hp = data[0]['hp'];
                    var car_type = data[0]['car_type'];
                    var car_type_id = data[0]['car_type_id'];
                    var driver_id = data[0]['driver_id'];
                    var driver_name  = data[0]['driver_name'];
                    var price  = data[0]['fuel_price'];
                    
                  //  alert(car_type_id);
                    $('.car-plate-no').val(plat_no);
                    $('.car-type').val(car_type);
                    $('.hp').val(hp);
                    $("#emp-assign").val(driver_id);
                    $(".emp-assign-driver-id").val(driver_name);
                    $("#car-type-selected").val(car_type_id);
                    $(".oil-daily-price").val(price);
                    
                    
                    getRouteplan();
                }
            },
            'error': function(data){
                 alert(data);//return;
            }
            
        });
    }
}

function getRouteplan(){
    //var route_plan_id = $("#route-plan-id").val();
    var customer_id = $("#customer-selected-id").val();
    //alert(route_plan_id);
    if(customer_id > 0){
        var car_type_id = $("#car-type-selected").val();
       // alert(car_type_id);
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_routeplan',
            'data': {'route_plan_id': 0,'car_type_id': car_type_id,'customer_id': customer_id},
            'success': function(data){
                // alert(data);
                if(data != null){
                    // alert(data[0]['plate_no']);
                    var distance = data[0]['total_distance'];
                    var rate_qty = data[0]['total_rate_qty'];
                    var dropoff_qty = data[0]['total_dropoff_rate_qty'];
                    var labour_price = data[0]['labour_price'];
                    var express_road_price = data[0]['express_road_price'];
                    var other_price = data[0]['other_price'];
                   // alert(other_price);
                    $('.total-distance').val(distance);
                    $('.total-qty').val(parseFloat(rate_qty) + parseFloat(dropoff_qty));
                    $('#labour-price-plan').val(labour_price);
                    $('#express-road-price-plan').val(express_road_price);
                    $('#other-price-plan').val(other_price);
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
function addline(e){
    var tr = $("#table-list tbody tr:last");
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                    clone.find(".line-doc-name").val("");
                    clone.find(".line-file-name").val("");
                   
                    clone.attr("data-var", "");
                    clone.find('.rec-id').val("0");
                   
                    tr.after(clone);
    
}
function removeline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removelist.push(e.parent().parent().attr("data-var"));
                $(".remove-list").val(removelist);
            }
            // alert(removelist);
            // alert(e.parent().parent().attr("data-var"));

            if ($("#table-list tbody tr").length == 1) {
                $("#table-list tbody tr").each(function () {
                    $(this).find(":text").val("");
                   // $(this).find(".line-prod-photo").attr('src', '');
                    $(this).find(".line-file-name").val('');
                    // cal_num();
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
    }
function removedoc(e){
    var doc_name = e.attr("data-var");
    $("work-queue-doc-delete").val(doc_name);
    if(doc_name != ''){
        $("form#form-delete-doc").submit();
    }
}

JS;
$this->registerJs($js, static::POS_END);
?>
