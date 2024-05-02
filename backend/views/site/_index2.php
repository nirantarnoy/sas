<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'Dashboard';
//$date_data = ['1/8', '2/8', '3/8', '4/8', '5/8'];
//$date_data = [];

$work_closed_qty = 0;
$work_receive_qty = 0;

$model_outstanding = \backend\models\Workorder::find()->where(['status' => [1,2]])->all();
$model_recevie_data = \backend\models\Workorder::find()->where(['status' => [1,2]])->all();
$model_closed_data = \backend\models\Workorder::find()->where(['status' => 4])->all();

if ($model_recevie_data) {
    $work_receive_qty = count($model_recevie_data);
}
if ($model_closed_data) {
    $work_closed_qty = count($model_closed_data);
}


$date_data_filter = [];
$data_series = [
    ['name' => 'สถานะงานซ่อม', 'data' => [['name' => 'ซ่อมเสร็จแล้ว', 'y' => $work_closed_qty, 'color' => '#544fc5'], ['name' => 'ซ่อมอยู่', 'y' => $work_receive_qty, 'color' => '#91e8e1']]],
];
$data_series2 = [
    ['name' => 'จำนวน ToDoList', 'data' => [['name' => '30 ที่ผ่านมา', 'y' => 20, 'color' => '#00e272'], ['name' => '30 วันข้างหน้า', 'y' => 10, 'color' => '#fa4b42']]],
];


?>
<!--<h5><b>Dashboard</b></h5>-->
<br/>
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td colspan="7" style="text-align: center;background-color: #3F7F7F;color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;border-left: 1px solid transparent;border-top: 1px solid transparent;border-right: 1px solid transparent; ">
                            <span style="font-size: 25px;">งานซ่อมที่ค้าง</span>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">เลขใบแจ้งซ่อม</th>
                        <th style="text-align:center;">ผู้แจ้ง</th>
                        <th style="text-align:center;">แชทล่าสุด</th>
                        <th style="text-align:center;">ใช้เวลาแล้ว</th>
                        <th style="text-align:center;">ประเภทเครื่องจักร</th>
                        <th style="text-align:center;">ชื่อเครื่อง</th>
                        <th style="text-align:center;">Serial Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model_outstanding == null): ?>
                        <tr>
                            <td colspan="7" style="text-align: center;color: red;">ไม่พบข้อมูล</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($model_outstanding as $value): ?>
                            <?php
                            // $date1 = date_create(date('Y-m-d H:i:s',strtotime($value->workorder_date)));
                            $date1 = date_create(date('Y-m-d H:i:s', strtotime($value->workorder_date)));
                            $date2 = date_create(date('Y-m-d H:i:s'));
                            $line_time_use = date_diff($date1, $date2);
                            ?>
                            <tr>
                                <td style="text-align:center;"><a
                                            href="index.php?r=workorder/update&id=<?= $value->id ?>"><?= $value->workorder_no ?></a>
                                </td>
                                <td style="text-align:center;"><?= \backend\models\User::findName($value->created_by) ?></td>
                                <td style="text-align:center;"></td>
                                <td style="text-align:center;"><span
                                            style="color: green;"><?= $line_time_use->format('%d days %h hours %i minute') ?></span>
                                </td>
                                <td style="text-align:center;"><?= \backend\models\Asset::findAssetCatName($value->asset_id) ?></td>
                                <td style="text-align:center;"><?= \backend\models\Asset::findName($value->asset_id) ?></td>
                                <td style="text-align:center;"><?= \backend\models\Asset::findAssetSerialNo($value->asset_id) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td colspan="6" style="text-align: center;background-color: #3F7F7F;color: white;border-top-left-radius: 15px;border-top-right-radius: 15px;border-left: 1px solid transparent;border-top: 1px solid transparent;border-right: 1px solid transparent; "> <span style="font-size: 25px;">ToDoList</span></td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">ลำดับ</th>
                        <th style="text-align:center;">ชื่องาน</th>
                        <th style="text-align:center;">ผู้รับผิดชอบ</th>
                        <th style="text-align:center;">วันที่ต้องทำ</th>
                        <th style="text-align:center;">ชื่อผู้สร้าง</th>
                        <th style="text-align:center;">วันที่สร้าง</th>
                    </tr>
                    </thead>
                    <tr>
                        <td colspan="7" style="text-align: center;color: red;">ไม่พบข้อมูล</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-12" style="text-align: center">

                <?php

                echo Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'type' => 'pie',
                        ],
                        'title' => ['text' => 'งานซ่อม 30 วันที่ผ่านมา'],
//                        'xAxis' => [
//                            'categories' => $date_data
//                        ],
                        'yAxis' => [
                            'title' => ['text' => 'งาน']
                        ],
                        'series' => $data_series
                    ]
                ]);
                ?>


            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12" style="text-align: center">

                <?php

                echo Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'type' => 'pie',
                        ],

//                        'plotOptions' =>[
//                            'color'=>  ["#544fc5", "#00e272", "#fe6a35", "#6b8abc", "#d568fb", "#2ee0ca", "#fa4b42", "#feb56a", "#91e8e1" ],
//                        ],
                        'title' => ['text' => 'ToDoList 30 วันที่ผ่านมา และ 30 วันข้างหน้า'],
//                        'xAxis' => [
//                            'categories' => $date_data
//                        ],
                        'yAxis' => [
                            'title' => ['text' => 'งาน']
                        ],
                        'series' => $data_series2
                    ]
                ]);
                ?>


            </div>
        </div>
    </div>
</div>
