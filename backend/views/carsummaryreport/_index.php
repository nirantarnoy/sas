<?php

$date_day = '';
$date_month = '';
$date_year = '';


use kartik\date\DatePicker;

$model_line = null;

if ($from_date != '' && $to_date != '') {
    $date_day = date('d', strtotime($from_date));
    $date_month = \backend\helpers\Thaimonth::getTypeById((int)(date('m', strtotime($from_date))));
    $date_year = date('Y', strtotime($from_date)) + 543;

    if ($search_car_id != null) {
        $model_line = \common\models\QueryCarWorkSummary::find()->where(['car_id' => $search_car_id])->andFilterWhere(['>=', 'date(work_queue_date)', $from_date])->andFilterWhere(['<=', 'date(work_queue_date)', $to_date])->all();
    }

    $from_date = date('d-m-Y', strtotime($from_date));
    $to_date = date('d-m-Y', strtotime($to_date));
}


?>
<style>
    /*body {*/
    /*    font-family: sarabun;*/
    /*    !*font-family: garuda;*!*/
    /*    font-size: 18px;*/
    /*    width: 350px;*/
    /*}*/

    /*table.table-header {*/
    /*    border: 0px;*/
    /*    border-spacing: 1px;*/
    /*}*/

    /*table.table-qrcode {*/
    /*    border: 0px;*/
    /*    border-spacing: 1px;*/
    /*}*/

    /*table.table-qrcode td, th {*/
    /*    border: 0px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding-top: 2px;*/
    /*    padding-bottom: 2px;*/
    /*}*/

    /*table.table-footer {*/
    /*    border: 0px;*/
    /*    border-spacing: 0px;*/
    /*}*/

    /*table.table-header td, th {*/
    /*    border: 0px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding-top: 2px;*/
    /*    padding-bottom: 2px;*/
    /*}*/

    /*table.table-title {*/
    /*    border: 0px;*/
    /*    border-spacing: 0px;*/
    /*}*/

    /*table.table-title td, th {*/
    /*    border: 0px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding-top: 2px;*/
    /*    padding-bottom: 2px;*/
    /*}*/

    /*table {*/
    /*    border-collapse: collapse;*/
    /*    width: 100%;*/
    /*}*/

    /*td, th {*/
    /*    border: 1px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding: 8px;*/
    /*}*/

    /*tr:nth-child(even) {*/
    /*    !*background-color: #dddddd;*!*/
    /*}*/

    /*table.table-detail {*/
    /*    border-collapse: collapse;*/
    /*    width: 100%;*/
    /*}*/

    /*table.table-detail td, th {*/
    /*    border: 1px solid #dddddd;*/
    /*    text-align: left;*/
    /*    padding: 2px;*/
    /*}*/

    @media print {
        @page {
            size: auto;
        }
    }

    /*@media print {*/
    /*    html, body {*/
    /*        width: 80mm;*/
    /*        height:100%;*/
    /*        position:absolute;*/
    /*    }*/
    /*}*/

</style>
<div class="row">
    <div class="col-lg-12">
        <div class="btn btn-default btn-print" onclick="printContent('print-area')">พิมพ์</div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form action="<?= \yii\helpers\Url::to(['carsummaryreport/index'], true) ?>" method="post">
            <div class="row">
                <div class="col-lg-3">
                    <label class="form-label">ตั้งแต่วันที่</label>

                    <?php
                    echo DatePicker::widget([
                        'name' => 'search_from_date',
                        'type' => DatePicker::TYPE_INPUT,
                        'value' => $from_date,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy'
                        ]
                    ]);
                    ?>

                </div>
                <div class="col-lg-3">

                    <label class="form-label">ถึงวันที่</label>
                    <?php
                    echo DatePicker::widget([
                        'name' => 'search_to_date',
                        'type' => DatePicker::TYPE_INPUT,
                        'value' => $to_date,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy'
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-lg-3">
                    <label class="form-label">รถ</label>

                    <?php
                    echo \kartik\select2\Select2::widget([
                        'name' => 'search_car_id',
                        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Car::find()->where(['status' => 1])->all(), 'id', 'name'),
                        'value' => $search_car_id,
                        'options' => [
                            'placeholder' => '---เลือกรถ---'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ]
                    ]);
                    ?>


                </div>
                <div class="col-lg-3">
                    <div style="height: 35px;"></div>
                    <button class="btn btn-sm btn-primary">ค้นหา</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div style="height: 20px;"></div>
<div id="print-area">
    <table style="width: 100%">
        <tr>
            <td style="text-align: right;width: 33%"></td>
            <td style="text-align: center;width: 33%"><h4>
                    <b><?= \backend\models\Company::findCompanyName(1) ?></b></h4></td>
            <td style="text-align: right;width: 33%"></td>
        </tr>
        <tr>
            <td style="text-align: right;width: 33%"></td>
            <td style="text-align: center;width: 33%">
                <h6><?= \backend\models\Company::findAddress(1) ?></h6></td>
            <td style="text-align: right;width: 33%"></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="padding: 5px;width: 33%"></td>
            <td style="text-align: center;width: 33%"><h5><b>รายงานค่าเที่ยว</b></h5></td>
            <td style="text-align: right;width: 33%"><b></b></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="width:50%;padding: 5px;">ชื่อพนักงานขับรถ
                <b><?= \backend\models\Car::findDrivername($search_car_id) ?>
                </b>
            </td>
            <!--            <td><input type="text" class="form-control"></td>-->
            <td style="width:50%;padding: 5px;"> ทะเบียน <b><?= \backend\models\Car::getPlateno($search_car_id) ?></b>
            </td>
            <!--            <td><input type="text" class="form-control"></td>-->
        </tr>
    </table>
    <br>

    <table style="width: 100%;border: 1px solid grey;">
        <thead>
        <tr>
            <th style="text-align: center;padding: 10px;border: 1px solid grey;"><b>สถานที่</b></th>
            <th style="text-align: center;padding: 10px;border: 1px solid grey;"><b>วันที่ขึ้นสินค้า</b></th>
            <th style="text-align: center;padding: 10px;border: 1px solid grey;"><b>รายการ</b></th>
            <th style="text-align: right;padding: 10px;border: 1px solid grey;"><b>ค่าเที่ยว</b></th>
            <th style="text-align: right;padding: 10px;border: 1px solid grey;"><b>ค่าทางด่วน</b></th>
            <th style="text-align: right;padding: 10px;border: 1px solid grey;"><b>ค่าคลุมผ้าใบ</b></th>
            <th style="text-align: right;padding: 10px;border: 1px solid grey;"><b>ค่าค้างคืน</b></th>
            <th style="text-align: right;padding: 10px;border: 1px solid grey;"><b>ค่าบวกคลัง</b></th>
            <th style="text-align: right;padding: 10px;border: 1px solid grey;"><b>พิเศษอื่นๆ</b></th>
            <th style="text-align: right;padding: 10px;border: 1px solid grey;"><b>รวม</b></th>
        </tr>
        </thead>
        <tbody>
        <?php if ($model_line != null): ?>
            <?php foreach ($model_line as $value): ?>
                <tr>
                    <td style="border: 1px solid grey;padding: 5px;"><?= $value->dropoff_place_name ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: center;"><?= date('d-m-Y', strtotime($value->work_queue_date)) ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: center;"><?= \backend\models\Customer::findWorkTypeByCustomerid($value->customer_id) ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: right;"><?= number_format($value->work_labour_price, 2) ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: right;"><?= number_format($value->work_express_road_price, 2) ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: right;"><?= number_format($value->work_other_price, 2) ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: right;"><?= number_format($value->work_other_price, 2) ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: right;"><?= number_format($value->work_other_price, 2) ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: right;"><?= number_format($value->work_other_price, 2) ?></td>
                    <td style="border: 1px solid grey;padding: 5px;text-align: right;"><?= number_format($value->work_other_price, 2) ?></td>

                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
    <br>
    <table style="width: 100%;border: 1px solid grey">
        <tr>
            <td></td>
            <td><b>รายได้</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>หัก</b></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>

            <td>ค่าครองชีพ</td>
            <td></td>
            <td>0</td>
            <td>บาท</td>
            <td>ค่าประกันสังคม</td>
            <td>0</td>
            <td>บาท</td>
        </tr>
        <tr>
            <td></td>

            <td>ค่าเที่ยว</td>
            <td></td>
            <td>0</td>
            <td>บาท</td>
            <td>เงินยืมทดลอง</td>
            <td>0</td>
            <td>บาท</td>
        </tr>
        <tr>
            <td></td>

            <td>ค่าทางด่วน</td>
            <td></td>
            <td>0</td>
            <td>บาท</td>
            <td>ค่าประกันสินค้า</td>
            <td>0</td>
            <td>บาท</td>
        </tr>
        <tr>
            <td></td>

            <td>ค่าคลุมผ้าใบ</td>
            <td></td>
            <td>0</td>
            <td>บาท</td>
            <td></td>
            <td>0</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>ค่าค้างคืน</td>
            <td></td>
            <td>0</td>
            <td>บาท</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>ค่าพิเศษอื่นๆ</td>
            <td></td>
            <td>0</td>
            <td>บาท</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><b>รวม</b></td>
            <td></td>
            <td><b><u>0</u></b></td>
            <td>บาท</td>
            <td><b>คงเหลือ</b></td>
            <td><b><u>0</u></b></td>
            <td>บาท</td>
        </tr>
    </table>

    <br>


</div>

<?php
$js = <<<JS
function printContent(el)
      {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
     }
JS;
$this->registerJs($js, static::POS_END);
?>
