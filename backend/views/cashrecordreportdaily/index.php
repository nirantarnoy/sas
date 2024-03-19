<?php

use kartik\date\DatePicker;

$model = null;
$model_total = 0;
$model_receive_total = 0;

$model = \backend\models\Cashrecord::find()->where(['id' => 1])->one();
if ($model) {
    $model_total = \common\models\CashRecordLine::find()->where(['car_record_id' => 1])->sum('amount');
    $model_receive = \common\models\QueryCashRecordRecieve::find()->where(['ref_no' => trim($model->journal_no)])->all();
    $model_receive_total = \common\models\QueryCashRecordRecieve::find()->where(['ref_no' => $model->journal_no])->sum('amount');
}

?>
    <div class="row">
        <div class="col-lg-12">
            <form action="<?= \yii\helpers\Url::to(['cashrecordreportdaily/index'], true) ?>" method="post">
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
                        <div style="height: 35px;"></div>
                        <button class="btn btn-sm btn-primary">ค้นหา</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="height: 20px;"></div>
    <div id="print-area">
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%;">
                    <tr>
                        <td></td>
                        <td style="text-align: center;"><h5><b>รายละเอียดเงินสดย่อย</b></h5></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%;border: 1px solid grey;">
                    <tr>
                        <td style="border: 1px solid grey;width: 5%;text-align: center;padding: 10px;">เดือน</td>
                        <td style="border: 1px solid grey;width: 5%;text-align: center;">วันที่</td>
                        <td style="border: 1px solid grey;width: 15%;text-align: center;">รายการ</td>
                        <td style="border: 1px solid grey;width: 10%;text-align: center;">ทะเบียน</td>
                        <td style="border: 1px solid grey;width: 10%;text-align: center;">รับ</td>
                        <td style="border: 1px solid grey;width: 10%;text-align: center;">จ่าย</td>
                        <td style="border: 1px solid grey;width: 10%;text-align: center;">ยอดรวม/วัน</td>
                        <td style="border: 1px solid grey;width: 10%;text-align: center;">คงเหลือ</td>
                        <td style="border: 1px solid grey;width: 15%;text-align: center;">ลูกค้า</td>
                        <td style="border: 1px solid grey;width: 10%;text-align: center;">หัก ณ ที่จ่าย1%</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="btn btn-default btn-print" onclick="printContent('print-area')">พิมพ์</div>
        </div>
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