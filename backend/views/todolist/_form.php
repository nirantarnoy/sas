<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Todolist $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="todolist-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'todolist_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'trans_date')->textInput() ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'machine_name')->textInput(['maxlength' => true]) ?>
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
                <?= $form->field($model, 'target_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'act_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'end_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
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
                        <th style="width: 5%;text-align: center;">#</th>
                        <th style="width: 20%">ผู้รับผิดชอบ</th>
                        <th style="width: 5%;text-align: center;">-</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr data-var="">
                            <td>
                            </td>
                            <td>
                                <input type="hidden" class="form-control line-emp-id" name="line_emp_id[]" value="">
                                <input type="text" class="form-control line-emp-name" readonly name="line_emp_name[]" value="">
                            </td>
                            <td style="text-align: center;"><div class="btn btn-sm btn-danger" onclick="removeline($(this))">ลบ</div></td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td style="text-align: center;">
                            <div class="btn btn-sm btn-primary" onclick="showEmp()">เพิ่ม</div>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>

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
                    <div class="row">
                        <div class="col-lg-12" style="text-align: right">
                            <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx" disabled><i
                                        class="fa fa-check"></i> ตกลง
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                            </button>
                        </div>
                    </div>
                    <div style="height: 10px;"></div>
                    <input type="hidden" name="line_qc_product" class="line_qc_product" value="">
                    <table class="table table-bordered table-striped table-find-list" width="100%">
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
$(function(){
    
});
function showEmp(){
    
}
JS;
$this->registerJs($js, static::POS_END);
?>