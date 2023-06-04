<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$model_dropoff = \backend\models\DropoffPlace::find()->all();
/** @var yii\web\View $this */
/** @var backend\models\Quotationtitle $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="quotationtitle-form">

    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" class="remove-line-list" value="">
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?php $model->created_at_display = $model->created_at != null ? date('d-m-Y H:i:s', $model->created_at) : '' ?>
            <?= $form->field($model, 'created_at_display')->textInput(['readonly' => 'readonly']) ?>
        </div>
        <div class="col-lg-3">
            <?php $model->created_by_display = $model->created_by != null ? \backend\models\User::findName($model->created_by) : '' ?>
            <?= $form->field($model, 'created_by_display')->textInput(['readonly' => 'readonly']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                <?php if($model_line !=null):?>
                <div class="btn btn-warning"><i class="fa fa-print"></i> พิมพ์</div>
                <?php endif;?>
            </div>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h4>รายละเอียด</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-striped" id="table-list">
                <thead>
                <tr>
                    <th>จากคลังสินค้า</th>
                    <th>Route</th>
                    <th>โซนพื้นที่</th>
                    <th>ระยะทาง</th>
                    <th>ปริมาณเฉลี่ยตัน/ปี</th>
                    <th>ราคาที่เสนอ</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model->isNewRecord): ?>
                    <tr data-var="">
                        <td>
                            <select name="line_warehouse_id[]" class="form-control line-warehouse-id" id="" onchange="updatevalidate($(this))">
                                <option value="-1">--เลือกคลัง--</option>
                                <?php foreach ($model_dropoff as $value): ?>
                                    <?php
                                    $selected = '';
                                    if ($value->id == 1) {
                                        $selected = 'selected';
                                    }
                                    ?>
                                    <option value="<?= $value->id ?>" <?= $selected ?>><?= $value->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control line-route" name="line_route[]">
                        </td>
                        <td>
                            <select name="line_zone_id[]" class="form-control line-zone-id" id="">
                                <option value="-1">--เลือกโซน--</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control line-distance" name="line_distance[]" min="0">
                        </td>
                        <td>
                            <input type="number" class="form-control line-average" name="line_average[]" min="0">
                        </td>
                        <td>
                            <input type="text" class="form-control line-quotation-price" name="line_quotation_price[]">
                        </td>
                        <td>
                            <div class="btn btn-danger btn-sm" onclick="removeline($(this))">ลบ</div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php if ($model_line != null): ?>
                    <?php foreach ($model_line as $value):?>
                            <tr data-var="<?=$value->id?>">
                                <td>
                                    <input type="hidden" class="line-rec-id" value="<?=$value->id?>">
                                    <select name="line_warehouse_id[]" class="form-control line-warehouse-id" id="" onchange="updatevalidate($(this))">
                                        <option value="-1">--เลือกคลัง--</option>
                                        <?php foreach ($model_dropoff as $valuex): ?>
                                            <?php
                                            $selected = '';
                                            if ($valuex->id == $value->id) {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option value="<?= $valuex->id ?>" <?= $selected ?>><?= $valuex->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control line-route" name="line_route[]" value="<?=$value->route_code?>">
                                </td>
                                <td>
                                    <select name="line_zone_id[]" class="form-control line-zone-id" id="">
                                        <option value="-1">--เลือกโซน--</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control line-distance" name="line_distance[]" min="0"  value="<?=$value->distance?>">
                                </td>
                                <td>
                                    <input type="number" class="form-control line-average" name="line_average[]" min="0"  value="<?=$value->load_qty?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-quotation-price" name="line_quotation_price[]"  value="<?=$value->price_current_rate?>">
                                </td>
                                <td>
                                    <div class="btn btn-danger btn-sm" onclick="removeline($(this))">ลบ</div>
                                </td>
                            </tr>
                    <?php endforeach;?>
                    <?php else: ?>
                        <tr data-var="">
                            <td>
                                <select name="line_warehouse_id[]" class="form-control line-warehouse-id" id="" onchange="updatevalidate($(this))">
                                    <option value="-1">--เลือกคลัง--</option>
                                    <?php foreach ($model_dropoff as $valuex): ?>
                                        <?php
                                        $selected = '';
                                        if ($valuex->id == 1) {
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option value="<?= $valuex->id ?>" <?= $selected ?>><?= $valuex->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control line-route" name="line_route[]">
                            </td>
                            <td>
                                <select name="line_zone_id[]" class="form-control line-zone-id" id="">
                                    <option value="-1">--เลือกโซน--</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control line-distance" name="line_distance[]" min="0">
                            </td>
                            <td>
                                <input type="number" class="form-control line-average" name="line_average[]" min="0">
                            </td>
                            <td>
                                <input type="text" class="form-control line-quotation-price"
                                       name="line_quotation_price[]">
                            </td>
                            <td>
                                <div class="btn btn-danger btn-sm" onclick="removeline($(this))">ลบ</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                </tbody>
                <tfoot>
                <tr>
                    <td>
                        <div class="btn btn-primary btn-sm" onclick="addline($(this))"><i class="fa fa-plus"></i>
                            เพิ่มรายการ
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
var removelist = [];
function addline(e){
    var tr = $("#table-list tbody tr:last");

                if (tr.closest("tr").find(".line-warehouse-id").val() == "-1") {
                   tr.closest("tr").find(".line-warehouse-id").css("border-color","red");
                    
                } else {
                    var clone = tr.clone();
                     tr.closest("tr").find(".line-warehouse-id").val("-1").change();
                    clone.attr("data-var", "");
                    clone.find('.line-rec-id').val("");
                    
                    clone.find(":text").val("");
                    clone.find(':input[type="number"]').val("");

                    clone.find(".line-quotation-price").on("keypress", function (event) {
                        $(this).val($(this).val().replace(/[^0-9\.]/g, ""));
                        if ((event.which != 46 || $(this).val().indexOf(".") != -1) && (event.which < 48 || event.which > 57)) {
                            event.preventDefault();
                        }
                    });

                    tr.after(clone);

                    //cal_num();
                }
}
function removeline(e) {
        // alert();
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removelist.push(e.parent().parent().attr("data-var"));
                $(".remove-line-list").val(removelist);
            }

            // alert(removelist);

            if ($("#table-list tbody tr").length == 1) {
                $("#table-list tbody tr").each(function () {
                    $(this).find(":text").val("");
                    $(this).find(':input[type="number"]').val("");
                    // $(this).find(".line-prod-photo").attr('src', '');
                    // $(this).find(".line-qty").val(1);
                    // cal_num();
                });
            } else {
                e.parent().parent().remove();
            }
        }
    }
 function updatevalidate(e){
    if(e.val() != "-1"){
        e.css("border-color","");
    }
 }   
JS;
$this->registerJs($js, static::POS_END);
?>
