<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'รายงาน ToDoList';

$search_from_date = date('d-m-Y');
$search_to_date = date('d-m-Y');

if ($from_date != null) {
    $search_from_date = date('d-m-Y', strtotime($from_date)); //$from_date;
}
if ($to_date != null) {
    $search_to_date = date('d-m-Y', strtotime($to_date)); //$to_date;
}

//$month_data = [['id'=>1,'name'=>'มค.'],['id'=>2,'name'=>'กพ.'],['id'=>3,'name'=>'มีค.'],['id'=>4,'name'=>'เมย.'],['id'=>5,'name'=>'พค.'],['id'=>6,'name'=>'มิย.'],['id'=>7,'name'=>'กค.'],['id'=>8,'name'=>'สค.'],['id'=>9,'name'=>'กย.'],['id'=>10,'name'=>'ตค.'],['id'=>11,'name'=>'พย.'],['id'=>12,'name'=>'ธค.']];

$todolist_all = 0;
$todolist_in_time = 0;
$todolist_late_time = 0;

$sql = "SELECT month(trans_date) as month,count(*) as cnt  from todolist 
              WHERE (date(trans_date)>= " . "'" . date('Y-m-d', strtotime($from_date)) . "'" . " 
              AND date(trans_date)<= " . "'" . date('Y-m-d', strtotime($to_date)) . "'" . " )";

$sql .= " GROUP BY month(trans_date)";
$query = \Yii::$app->db->createCommand($sql);
$model = $query->queryAll();
if ($model) {
    for($x=0;$x<=12-1;$x++){
        for ($i = 0; $i <= count($model) - 1; $i++) {

        }
    }

}

//$data_series_for_graph_value = [
//    $todolist_all,
//    $todolist_in_time,
//    $todolist_late_time
//];
?>
<br/>
<form action="index.php?r=todolistreport/index" method="post">
    <div class="row">

        <div class="col-lg-3">
            <?php
            echo \kartik\date\DatePicker::widget([
                'name' => 'from_date',
                'value' => $search_from_date,
                'options' => [
                    'placeholder' => 'วันที่',
                ],
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'todayBtn' => true,
                ]
            ])
            ?>
        </div>
        <div class="col-lg-3">
            <?php
            echo \kartik\date\DatePicker::widget([
                'name' => 'to_date',
                'value' => $search_to_date,
                'options' => [
                    'placeholder' => 'วันที่',
                ],
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'todayBtn' => true,
                ]
            ])
            ?>
        </div>
        <div class="col-lg-3">
            <button class="btn btn-primary" type="submit">ค้นหา</button>
        </div>

    </div>
</form>
<br/>
<div class="row">
    <div class="col-lg-12">
        <?php

        echo Highcharts::widget([
            'options' => [
                'credits' => [
                    'enabled' => false,
                ],
                'chart' => [
                    'type' => 'column',
                ],
                'title' => ['text' => 'ToDoList'],
                'xAxis' => [
                    'categories' => ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
                ],
                'yAxis' => [
                    'title' => ['text' => 'งาน']
                ],
                'series' => [
                    ['name' => 'งานทั้งหมด', 'data' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
                    ['name' => 'ตรงเวลา', 'data' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
                    ['name' => 'ช้ากว่ากำหนด', 'data' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
                ]
            ]
        ]);
        ?>
    </div>
</div>