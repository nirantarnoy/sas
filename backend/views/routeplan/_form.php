<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Routeplan $model */
/** @var yii\widgets\ActiveForm $form */

$dropoff_place_data = \common\models\DropoffPlace::find()->all();

//print_r($dropoff_place_data);return;

?>

    <div class="routeplan-form">

        <?php $form = ActiveForm::begin(); ?>
        <input type="hidden" class="remove-list" name="remove_list" value="">
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'des_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'des_province_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Province::find()->all(), 'PROVINCE_ID', function ($data) {
                        return $data->PROVINCE_NAME;
                    }),
                    'options' => [
                        'placeholder' => '--ปลายทาง--'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'total_distanct')->textInput() ?>
            </div>
        </div>

        <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped" id="table-list">
                    <thead>
                    <th>จุดขึ้นสินค้า</th>
                    <th>แรงรถ</th>
                    <th>จำนวนเรทน้ำมัน(ลิตร)</th>
                    <th style="width: 30%">จำนวนบวกเพิ่ม (ลิตร)</th>
                    <th style="width: 5%"></th>
                    </thead>
                    <tbody>
                    <?php if ($model->isNewRecord): ?>
                        <tr>
                            <td>
                                <select name="drop_off_place[]" class="form-control drop-off-place" id=""
                                        onchange="getDropoffinfo($(this))">
                                    <option value="0">--ประเภท--</option>
                                    <?php for ($i = 0; $i <= count($dropoff_place_data) - 1; $i++) : ?>
                                        <option value="<?= $dropoff_place_data[$i]['id'] ?>"><?= $dropoff_place_data[$i]['name'] ?></option>
                                    <?php endfor; ?>
                                </select>
                                <!--                                <input type="text" class="form-control drop-off-place" name="drop_off_place[]">-->
                            </td>
                            <td>
                                <input type="text" class="form-control hp" name="hp[]" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control oil-rate" name="oil_rate[]" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control drop-off-qty" name="drop_off_qty[]">
                            </td>
                            <td>
                                <div class="btn btn-danger btn-sm" onclick="removeline($(this))"><i
                                            class="fa fa-trash"></i></div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php if (count($model_line)): ?>
                            <?php foreach ($model_line as $value) : ?>
                                <?php $data = \backend\models\dropoffplace::getinfo($value->dropoff_place_id) ?>
                                <tr data-var="<?= $value->id ?>">
                                    <td>
                                        <input type="hidden" class="rec-id" name="rec_id[]" value="<?= $value->id ?>">
                                        <select name="drop_off_place[]" class="form-control drop-off-place"
                                                onchange="getDropoffinfo($(this))">
                                            <option value="0">--ประเภท--</option>
                                            <?php for ($i = 0; $i <= count($dropoff_place_data) - 1; $i++) : ?>
                                                <?php
                                                $selected = '';
                                                if ($dropoff_place_data[$i]['id'] == $value->dropoff_place_id) {
                                                    $selected = 'selected';
                                                }
                                                ?>
                                                <option value="<?= $dropoff_place_data[$i]['id'] ?>" <?= $selected ?>><?= $dropoff_place_data[$i]['name'] ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control hp" name="hp[]"
                                               value="<?= $data != null ? $data[0]['hp'] : 0 ?>" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control oil-rate" name="oil_rate[]"
                                               value="<?= $data != null ? $data[0]['oil_rate_qty'] : 0 ?>" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control drop-off-qty" name="drop_off_qty[]"
                                               value="<?= $value->dropoff_qty ?>">
                                    </td>
                                    <td>
                                        <div class="btn btn-danger btn-sm" onclick="removeline($(this))"><i
                                                    class="fa fa-trash"></i></div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td>
                                    <select name="drop_off_place[]" class="form-control drop-off-place" id=""
                                            onchange="getDropoffinfo($(this))">
                                        <option value="0">--ประเภท--</option>
                                        <?php for ($i = 0; $i <= count($dropoff_place_data) - 1; $i++) : ?>
                                            <option value="<?= $dropoff_place_data[$i]['id'] ?>"><?= $dropoff_place_data[$i]['name'] ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control hp" name="hp[]" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control oil-rate" name="oil_rate[]" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control drop-off-qty" name="drop_off_qty[]">
                                </td>
                                <td>
                                    <div class="btn btn-danger btn-sm" onclick="removeline($(this))"><i
                                                class="fa fa-trash"></i></div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="btn btn-primary"
                                 onclick="addline($(this))">
                                <i class="fa fa-plus-circle"></i>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$url_to_Dropoffdata = \yii\helpers\Url::to(['dropoffplace/getdropoffdata'], true);

$js = <<<JS
var removelist = [];

$(function(){
    // $('.start-date').datepicker({dateformat: 'dd-mm-yy'});
    // $('.expire-date').datepicker({dateFormat: 'dd-mm-yy'});
});

function addline(e){
    var tr = $("#table-list tbody tr:last");
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                    clone.find(".drop-off-place").val("");
                    clone.find(".hp").val("");
                    clone.find(".oil-rate").val("");
                    clone.find(".drop-off-qty").val("");
                    
                  
                    clone.attr("data-var", "");
                    clone.find('.rec-id').val("");
                    
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
                    $(this).find(".line-price").val(0);
                    // cal_num();
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
    }
    
    function getDropoffinfo(e){
    // alert(e.val());
    if(e.val() != ''){
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_Dropoffdata',
            'data': {'drop_off_id': e.val()},
            // alert(data)
            'success': function(data){
                if(data != null){
                    // alert(data[0]['oil_rate']);
                    var oil_rate = data[0]['oil_rate'];
                    var hp = data[0]['hp'];
                    e.closest('tr').find('.oil-rate').val(oil_rate);
                    e.closest('tr').find('.hp').val(hp);
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