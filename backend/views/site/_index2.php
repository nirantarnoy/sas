<?php
use miloschuman\highcharts\Highcharts;
$this->title = 'Dashboard';
//$date_data = ['1/8', '2/8', '3/8', '4/8', '5/8'];
//$date_data = [];
$date_data_filter = [];
$data_series = [
    ['name' => 'สถานะงานซ่อม', 'data' => [['name'=>'ซ่อมเสร็จแล้ว','y'=>23,'color'=>'#544fc5'],['name'=>'ซ่อมอยู่','y'=>3,'color'=>'#91e8e1']]],
];
$data_series2 = [
    ['name' => 'จำนวน ToDoList', 'data' => [['name'=>'30 ที่ผ่านมา','y'=>20,'color'=>'#00e272'],['name'=>'30 วันข้างหน้า','y'=>10,'color'=>'#fa4b42']]],
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
                        <th colspan="7" style="text-align: center;background-color: #3F7F7F;color: white;">งานซ่อมที่ค้าง</th>
                    </tr>
                    <tr>
                        <th>เลขใบแจ้งซ่อม</th>
                        <th>ผู้แจ้ง</th>
                        <th>แชทล่าสุด</th>
                        <th>ใช้เวลาแล้ว</th>
                        <th>ประเภทเครื่องจักร</th>
                        <th>ชื่อเครื่อง</th>
                        <th>Serial Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7" style="text-align: center;color: red;">ไม่พบข้อมูล</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="6" style="text-align: center;background-color: #3F7F7F;color: white;">ToDoList</th>
                    </tr>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่องาน</th>
                        <th>ผู้รับผิดชอบ</th>
                        <th>วันที่ต้องทำ</th>
                        <th>ชื่อผู้สร้าง</th>
                        <th>วันที่สร้าง</th>
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
        <br />
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
