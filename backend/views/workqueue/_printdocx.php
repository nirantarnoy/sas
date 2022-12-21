<?php


$date_day = date('d');
$date_month = \backend\helpers\Thaimonth::getTypeById((int)(date('m')));
$date_year = date('Y') + 543;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="btn btn-default btn-print" onclick="printContent('print-area')">พิมพ์</div>
    </div>
</div>
<div id="print-area">
    <table style="width: 100%">
        <tr>
            <td style="text-align: right"></td>
            <td style="text-align: center"><h4><b>บริษัท ลานเหล็กลำเลียง จำกัด</b></h4></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>เล่มที่</td>
            <td style="text-align: right"><h5><b>ใบสั่งจ่ายน้ำมัน</b></h5></td>
            <td style="text-align: right">เลขที่ <?= $model->work_queue_no ?></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td style="text-align: center"><b>วันที่ <?= $date_day ?> เดือน <?= $date_month ?>
                    พ.ศ. <?= $date_year ?></b></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>ทะเบียนหัว <?= \backend\models\Car::getPlateno($model->car_id) ?></td>
            <!--            <td><input type="text" class="form-control"></td>-->
            <td> ทะเบียนหาง <?= \backend\models\Car::getPlateno($model->tail_id) ?></td>
            <!--            <td><input type="text" class="form-control"></td>-->
            <td> ประเภทรถ <?= \backend\models\Car::getCartype($model->car_id) ?></td>
            <!--            <td><input type="text" class="form-control"></td>-->
            <td> แรงรถ <?= \backend\models\Car::getHp($model->car_id) ?></td>
            <!--            <td><input type="text" class="form-control"></td>-->
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>
                พนักงาน <?= \backend\models\Employee::findFullName($model->emp_assign) ?>
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>
                ต้นทาง-ปลายทาง <?= \backend\models\RoutePlan::findDes($model->route_plan_id) ?>
            </td>
        </tr>
    </table>

    <br>
    <table style="width: 100%">
        <tr>
            <td>น้ำหนักเที่ยวไป</td>
            <td>หัก</td>
            <td>เหตุผล</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>เที่ยวกลับ</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%">
        <tr>
            <td>น้ำหนักเที่ยวกลับ</td>
            <td>เรทน้ำมันกลับ</td>
            <td>หัก</td>
            <td>เหตุผล</td>
            <td>หางกลับ</td>
        </tr>
    </table>

    <br>
    <table style="width: 100%">
        <tr>
            <td>น้ำมัน</td>
        </tr>
    </table>

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
