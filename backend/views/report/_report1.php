<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'รายงานจำนวนเที่ยววิ่ง';
?>
<div class="row">
    <div class="col-lg-3">
        <div class="label">ตั้งแต่วันที่</div>
        <?php
        echo \kartik\date\DatePicker::widget([
            'value' => date('d-m-Y'),
            'name' => 'form_date',
            'pluginOptions' => [

            ]
        ]);
        ?>
    </div>
    <div class="col-lg-3">
        <div class="label">ถึงวันที่</div>
        <?php
        echo \kartik\date\DatePicker::widget([
            'value' => date('d-m-Y'),
            'name' => 'to_date',
            'pluginOptions' => [

            ]
        ]);
        ?>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
        <div class="btn-group">
            <div class="btn btn-success">3 Days</div>
            <div class="btn btn-default">5 Days</div>
            <div class="btn btn-default">7 Days</div>
            <div class="btn btn-default">15 Days</div>
            <div class="btn btn-default">30 Days</div>
            <div class="btn btn-default">1 Year</div>


        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
        <!--        <h6>กราฟแสดงจำนวนเที่ยว</h6>-->
    </div>
</div>
<?php
//$date_data = ['1/8', '2/8', '3/8', '4/8', '5/8'];
$date_data = [];
$date_data_filter = [];
//$data_series = [
//      ['name' => '7XXX', 'data' => [10, 5, 4,5,9]],
//      ['name' => '8XXX', 'data' => [5, 7, 3,6,5]],
//      ['name' => '9XXX', 'data' => [4, 12, 8,7,10]],
//      ['name' => '6XXX', 'data' => [8, 2, 8,9,11]],
//      ['name' => '5XXX', 'data' => [9, 8, 15,2,5]]
//  ];
//$xyz = [10, 5, 4,5,9];
$data_series = [];

  $model = \backend\models\Workqueue::find()->groupBy(['date(work_queue_date)'])->all();
 // $model_car = \backend\models\Car::find()->all();
  if($model){
      foreach ($model as $value){
          array_push($date_data,date('d/m',strtotime($value->work_queue_date)));
          array_push($date_data_filter,date('Y-m-d',strtotime($value->work_queue_date)));
      }

     // if($model_car){
          $series_for_data = [];
       //   foreach ($model_car as $valuex){
              $xdata = [];
              for($i=0;$i<=count($date_data_filter)-1;$i++){
                //  $modelxx = \backend\models\Workqueue::find()->where(['car_id'=>$valuex->id,'date(work_queue_date)'=>$date_data_filter[$i]])->count();
                  $modelxx = \backend\models\Workqueue::find()->where(['date(work_queue_date)'=>$date_data_filter[$i]])->count();
                  array_push($xdata,(int)$modelxx);
              }
            //  print_r($xdata);
              array_push($data_series, ['name'=>'','data' => $xdata]);
        //  }
         // array_push($data_series,$series_for_data);
     // }

  }
//print_r($date_data)."<br />";
//print_r($xyz);
?>
<div class="row">
    <div class="col-lg-12">
        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'กราฟแสดงจำนวนเที่ยว'],
                'xAxis' => [
                    'categories' => $date_data
                ],
                'yAxis' => [
                    'title' => ['text' => 'เที่ยว']
                ],
                'series' => $data_series
            ]
        ]);
        ?>
    </div>
</div>