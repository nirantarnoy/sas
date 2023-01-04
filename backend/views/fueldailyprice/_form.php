<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Fueldailyprice $model */
/** @var yii\widgets\ActiveForm $form */

$province_data = \backend\models\Province::find()->all();
$province_chk = \backend\models\AddressInfo::findProvinceId($model->id);
$city_data = \backend\models\Amphur::find()->all();
$city_chk = \backend\models\AddressInfo::findAmphurId($model->id);
?>

<div class="fueldailyprice-form">
    <div class="row">
        <div class="col-lg-3">
            <div class="btn btn-info btn-pull-price">ดึงราคาน้ำมัน (วันนี้)</div>
        </div>
    </div>
    <br/>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-3">
            <label for="">จังหวัด</label>
            <select name="province_id" class="form-control province-id" id=""
                    onchange="getCity($(this))">
                <option value="0">--จังหวัด--</option>
                <?php foreach ($province_data as $val3): ?>
                    <?php
                    $selected = '';
                    if ($val3->PROVINCE_ID == $province_chk)
                        $selected = 'selected';
//                    ?>
                    <option value="<?= $val3->PROVINCE_ID ?>" <?= $selected ?>><?= $val3->PROVINCE_NAME ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">อำเภอ/เขต</label>
            <select name="city_id" class="form-control city-id" id="city"
                    onchange="getDistrict($(this))">
                <option value="0">--อำเภอ/เขต--</option>
                <?php foreach ($city_data as $val2): ?>
                    <?php
                    $selected = '';
                    if ($val2->AMPHUR_ID == $city_chk)
                        $selected = 'selected';
//                    ?>
                    <option value="<?= $val2->AMPHUR_ID ?>" <?= $selected ?>><?= $val2->AMPHUR_NAME ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'price_date')->widget(\kartik\date\DatePicker::className(), [
                'value' => date('d/m/Y')
            ]) ?>
        </div>
        <div class="col-lg-3"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered" id="table-list">
                <thead>
                <tr>
                    <th>น้ำมัน</th>
                    <th style="text-align: right">ราคาวันนี้</th>
                    <th style="text-align: right">บวกเพิ่ม</th>
                    <th style="text-align: right">ราคาสุทธิ</th>
                    <th style="text-align: center"></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$url_to_get_price = \yii\helpers\Url::to(['fueldailyprice/getapiprice'],true);
$url_to_getcity = \yii\helpers\Url::to(['customer/showcity'], true);
$js = <<<JS
$(function(){
   $(".btn-pull-price").on("click",function(){
       getapiprice();
   }) ;
});
function getapiprice(){
    $.ajax({
            'type': 'post',
            'dataType': 'html',
            'url': '$url_to_get_price',
            'data': {'date_price': ''},
            // alert(data)
            'success': function(data){
                if(data != ''){
                   $("#table-list tbody").html(data);
                }
            },
            'error': function(data){
                 alert(data);//return;
            }
        });
}
function getCity(e){
    $.post("$url_to_getcity"+"&id="+e.val(),function(data){
        $("select#city").html(data);
        $("select#city").prop("disabled","");
    });
}
JS;
$this->registerJs($js, static::POS_END);
?>
