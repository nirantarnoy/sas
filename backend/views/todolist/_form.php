<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Todolist $model */
/** @var yii\widgets\ActiveForm $form */


?>

    <div class="todolist-form">

        <?php $form = ActiveForm::begin(); ?>

        <input type="hidden" name="removelist" class="remove-list">
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'todolist_no')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            </div>
            <div class="col-lg-3">
                <?php $model->trans_date = $model->isNewRecord? date('d-m-Y') : date('d-m-Y',strtotime($model->trans_date)) ?>
                <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'machine_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'todolist_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'machine_type_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'brand_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?php $model->target_date = $model->isNewRecord? date('d-m-Y') : date('d-m-Y',strtotime($model->target_date)) ?>
                <?= $form->field($model, 'target_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php $model->act_date = $model->isNewRecord? date('d-m-Y') : date('d-m-Y',strtotime($model->act_date)) ?>
                <?= $form->field($model, 'act_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?php $model->end_date = $model->isNewRecord? date('d-m-Y') : date('d-m-Y',strtotime($model->end_date)) ?>
                <?= $form->field($model, 'end_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'status')->textInput(['readonly' => 'readonly']) ?>
            </div>

        </div>
        <br/>

        <div class="row">
            <div class="col-lg-6">
                <table class="table table-bordered" id="table-list">
                    <thead>
                    <tr>
                        <th style="
                        width: 5%;text-align: center;">#</th>
                        <th style="width: 20%">ผู้รับผิดชอบ</th>
                        <th style="width: 5%;text-align: center;">-</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model->isNewRecord): ?>
                        <tr data-var="">
                            <td style="text-align: center;vertical-align: middle;" >
                            </td>
                            <td>
                                <input type="hidden" class="form-control line-emp-id" name="line_emp_id[]" value="">
                                <input type="text" class="form-control line-emp-name" readonly name="line_emp_name[]"
                                       value="">
                            </td>
                            <td style="text-align: center;">
                                <div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div>
                            </td>
                        </tr>
                    <?php else: ?>

                        <?php if ($model_line != null): ?>
                        <?php $loop_no =0;?>
                            <?php foreach ($model_line as $value): ?>
                            <?php $loop_no++;?>
                                <tr data-var="<?=$value->id?>">
                                    <td style="text-align: center;vertical-align: middle;">
                                        <?=$loop_no?>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control line-emp-id" name="line_emp_id[]" value="<?=$value->emp_id?>">
                                        <input type="text" class="form-control line-emp-name" readonly name="line_emp_name[]"
                                               value="<?=\backend\models\Employee::findName($value->emp_id)?>">
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr data-var="">
                                <td style="text-align: center;vertical-align: middle;">
                                </td>
                                <td>
                                    <input type="hidden" class="form-control line-emp-id" name="line_emp_id[]" value="">
                                    <input type="text" class="form-control line-emp-name" readonly
                                           name="line_emp_name[]"
                                           value="">
                                </td>
                                <td style="text-align: center;">
                                    <div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td style="text-align: center;">
                            <div class="btn btn-sm btn-primary" onclick="showEmp();">เพิ่ม</div>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>

        <br/>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div id="findModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <b>ค้นหารายชื่อผู้รับผิดชอบ</b>
                        </div>
                    </div>
                </div>
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->

                <div class="modal-body">
<!--                    <div class="row">-->
<!--                        <div class="col-lg-12" style="text-align: right">-->
<!--                            <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx" disabled><i-->
<!--                                        class="fa fa-check"></i> ตกลง-->
<!--                            </button>-->
<!--                            <button type="button" class="btn btn-default" data-dismiss="modal"><i-->
<!--                                        class="fa fa-close text-danger"></i> ปิดหน้าต่าง-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div style="height: 10px;"></div>
                    <input type="hidden" name="line_qc_product" class="line_qc_product" value="">
                    <table class="table table-bordered table-striped table-find-list" width="100%" id="table-find-list">
                        <thead>
                        <tr>
                            <th style="text-align: center">เลือก</th>
                            <th>พนักงาน</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx" disabled><i
                                class="fa fa-check"></i> ตกลง
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                    </button>
                </div>
            </div>

        </div>
    </div>


<?php
$url_to_get_emp = \yii\helpers\Url::to(['todolist/getempdata']);
$js = <<<JS
var selecteditem = [];
var removelist = [];
$(function(){
    $(".btn-emp-selected").click(function () {
        var linenum = 0;
        var line_count = 0;
        var emp_qty = $(".selected-emp-qty").val();
        //alert(emp_qty);
        
        $("#table-list tbody tr").each(function () {
            // if($(this).closest('tr').find('.line-car-emp-code').val()  != ''){
            if($(this).closest('tr').find('td:eq(0)').val() != '0'){
                // alert($(this).closest('tr').find('.td:eq(0)').val());
             line_count += 1;   
            }
        });
      // alert(selecteditem.length + line_count);
      // alert(emp_qty);
       // if((line_count + selecteditem.length ) > emp_qty){
       // if((line_count + selecteditem.length ) > 2){
       //      alert('จำนวนพนักงานเกินกว่าที่กำหนด');
       //      return false;
       //  }
       //  alert(selecteditem[0]['emp_id']);
        
        if (selecteditem.length > 0) {
            for (var i = 0; i <= selecteditem.length - 1; i++) {
                var id = selecteditem[i]['id']
                var emp_id = selecteditem[i]['emp_id'];
                var emp_name = selecteditem[i]['emp_name'];
                
                if(check_dup(emp_id) == 1){
                        alert("รายการสินค้า " +emp_name+ " มีในรายการแล้ว");
                        return false;
                    }
               
                var tr = $("#table-list tbody tr:last");
                
                if (tr.closest("tr").find(".line-emp-id").val() == "") {
                  //  alert(line_prod_code);
                    tr.closest("tr").find("td:eq(0)").html(line_count);
                    tr.closest("tr").find(".line-emp-id").val(emp_id);
                    tr.closest("tr").find(".line-emp-name").val(emp_name);
                } else {
                    var clone = tr.clone();
                    clone.closest("tr").find("td:eq(0)").html(line_count);
                    clone.closest("tr").find(".line-emp-id").val(emp_id);
                    clone.closest("tr").find(".line-emp-name").val(emp_name);
                    
                    clone.attr("data-var", "");
                    
                    tr.after(clone);
                    //cal_num();
                }
            }
        }
        $("#table-list tbody tr").each(function () {
            linenum += 1;
            $(this).closest("tr").find("td:eq(0)").text(linenum);
            // $(this).closest("tr").find(".line-prod-code").val(line_prod_code);
        });
    
        selecteditem = [];

        $("#table-find-list tbody tr").each(function () {
            $(this).closest("tr").find(".btn-line-select").removeClass('btn-success');
            $(this).closest("tr").find(".btn-line-select").addClass('btn-outline-success');
        });
        
        $(".btn-emp-selected").removeClass('btn-success');
        $(".btn-emp-selected").addClass('btn-outline-success');
        $("#findModal").modal('hide');
    });
});
function showEmp(){
       // alert(ids);
        $.ajax({
              'type':'post',
              'dataType': 'html',
              'async': false,
              'url': "$url_to_get_emp",
              'data': {},
              'success': function(data) {
                   $(".table-find-list tbody").html(data);
                   $("#findModal").modal('show');
                 },
                 'error': function(err){
                  //alert('has error');
                 }
        });
    
}
function disableselectitem() {
    // alert(selecteditem);
        if (selecteditem.length > 0) {
            // alert(selecteditem);
            $(".btn-emp-selected").prop("disabled", "");
            $(".btn-emp-selected").removeClass('btn-outline-success');
            $(".btn-emp-selected").addClass('btn-success');
        } else {
            $(".btn-emp-selected").prop("disabled", "disabled");
            $(".btn-emp-selected").removeClass('btn-success');
            $(".btn-emp-selected").addClass('btn-outline-success');
        }
}
function addselecteditem(e) {
        var id = e.attr('data-var');
        var emp_id = e.closest('tr').find('.line-find-emp-id').val();
        var emp_name = e.closest('tr').find('.line-find-emp-name').val();
        
        // alert(id);
        
        if (id) {
            // if(checkhasempdaily(id)){
            //     alert("คุณได้ทำการจัดรถให้พนักงานคนนี้ไปแล้ว");
            //     return false;
            // }
            if (e.hasClass('btn-outline-success')) {
               // alert(id);
                var obj = {};
                obj['id'] = id;
                obj['emp_id'] = emp_id;
                obj['emp_name'] = emp_name;
               
                selecteditem.push(obj);
                
                
                e.removeClass('btn-outline-success');
                e.addClass('btn-success');
            
                disableselectitem();
                console.log(selecteditem);
            } else {
                // selecteditem.pop(id);
                $.each(selecteditem, function (i, el) {
                    if (this.id == id) {
                        selecteditem.splice(i, 1);
                    }
                });
                e.removeClass('btn-success');
                e.addClass('btn-outline-success');
                
                disableselectitem();
                console.log(selecteditem);
            }
        }
        
}
function check_dup(id){
      var _has = 0;
      $("#table-list tbody tr").each(function(){
          var p_id = $(this).closest('tr').find('.line-emp-id').val();
         // alert(p_id + " = " + prod_id);
          if(p_id == id){
              _has = 1;
          }
      });
      return _has;
    }
    
    
    function removeline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removelist.push(e.parent().parent().attr("data-var"));
                $(".remove-list").val(removelist);
            }
            // alert(removelist);

            if ($("#table-list tbody tr").length == 1) {
                // alert('hello');
                $("#table-list tbody tr").each(function () {
                    // alert('hello');
                    $(this).find(":text").val("");
                    $(this).find("td:eq(0)").val('');
                    $(this).find(".data-var").val(0);
                    $(this).find(".line-emp-id").val(0);
                    $(this).find(".line-emp-name").val('');
                    
                   // $(this).find(".line-prod-photo").attr('src', '');
                   // $(this).find(".line-prod-photo").attr('src', '');
                   //  $(this).find(".line-price").val(0);
                    // cal_num();
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_total_all();
            // cal_linenum();
        }
    }
    
JS;
$this->registerJs($js, static::POS_END);
?>