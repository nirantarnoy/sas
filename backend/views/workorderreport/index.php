<?php

use kartik\datetime\DateTimePicker;
use miloschuman\highcharts\Highcharts;
use yii\db\Query;

$this->title = 'รายงานซ่อมเครื่อง';
$this->params['breadcrumbs'][] = $this->title;


//echo $from_date.'<br/>';
//echo $to_date;

$work_closed_qty = 0;
$work_receive_qty = 0;


if($from_date !=null && $to_date != null){
    $model_outstanding = \backend\models\Workorder::find()->where(['status' => [1, 2]])->andFilterWhere(['between', 'workorder_date', date('Y-m-d H:i',strtotime($from_date)), date('Y-m-d H:i',strtotime($to_date))])->all();
    $model_recevie_data = \backend\models\Workorder::find()->where(['status' => [1, 2]])->andFilterWhere(['between', 'workorder_date', date('Y-m-d H:i',strtotime($from_date)), date('Y-m-d H:i',strtotime($to_date))])->all();
    $model_closed_data = \backend\models\Workorder::find()->where(['status' => 4])->andFilterWhere(['between', 'workorder_date', date('Y-m-d H:i',strtotime($from_date)), date('Y-m-d H:i',strtotime($to_date))])->all();
}else{
    $model_outstanding = \backend\models\Workorder::find()->where(['status' => [1, 2]])->all();
    $model_recevie_data = \backend\models\Workorder::find()->where(['status' => [1, 2]])->all();
    $model_closed_data = \backend\models\Workorder::find()->where(['status' => 4])->all();
}




if ($model_recevie_data) {
    $work_receive_qty = count($model_recevie_data);
}
if ($model_closed_data) {
    $work_closed_qty = count($model_closed_data);
}

//// rank group by risk value
$one_step = 0;
$two_step = 0;
$three_step = 0;
$model_group_by_risk_value = null;
if($from_date !=null && $to_date != null){
    $model_group_by_risk_value = \common\models\ViewWorkorderByRiskValue::find()->where(['between', 'workorder_date', date('Y-m-d H:i',strtotime($from_date)), date('Y-m-d H:i',strtotime($to_date))])->all();
}else{
    $model_group_by_risk_value = \common\models\ViewWorkorderByRiskValue::find()->all();
}
$model_group_by_risk_value = \common\models\ViewWorkorderByRiskValue::find()->all();
if ($model_group_by_risk_value) {
    foreach ($model_group_by_risk_value as $model_group_by_risk_value) {
        if ($model_group_by_risk_value->risk_value >= 1 && $model_group_by_risk_value->risk_value <= 10) {
            $one_step = $one_step + $model_group_by_risk_value->risk_value;
        } else if ($model_group_by_risk_value->risk_value >= 11 && $model_group_by_risk_value->risk_value <= 20) {
            $two_step = $two_step + $model_group_by_risk_value->risk_value;
        } else if ($model_group_by_risk_value->risk_value >= 21 && $model_group_by_risk_value->risk_value <= 30) {
            $three_step = $three_step + $model_group_by_risk_value->risk_value;
        }
    }

}

$data_series_for_risk_value = [
    ['name' => 'คะแนนความเสี่ยง', 'data' => [['name' => '1-10', 'y' => $one_step], ['name' => '11-20', 'y' => $two_step], ['name' => '21-30', 'y' => $three_step]]]
];

///// group by cause
$data_series_for_cause = [];
//$model_group_by_cause = \common\models\ViewWorkorderByRiskValue::find()->select(['work_cause_name','COUNT(*) AS cnt'])->groupBy(['work_cause_name'])->all();
$model_group_by_cause = null;
if($from_date !=null && $to_date != null){
    $model_group_by_cause = (new Query())
        ->select([
            'work_cause_name',
            'COUNT(id) AS count',
        ])
        ->from('view_workorder_by_risk_value')
        ->where(['between', 'workorder_date', date('Y-m-d H:i',strtotime($from_date)), date('Y-m-d H:i',strtotime($to_date))])
        ->groupBy('work_cause_name')
        ->all();
}else{
    $model_group_by_cause = (new Query())
        ->select([
            'work_cause_name',
            'COUNT(id) AS count',
        ])
        ->from('view_workorder_by_risk_value')
        ->groupBy('work_cause_name')
        ->all();
}

if ($model_group_by_cause) {
    foreach ($model_group_by_cause as $model_group_by_cause) {
        array_push($data_series_for_cause, ['name' => $model_group_by_cause['work_cause_name'], 'y' => (int)$model_group_by_cause['count']]);
    }
}

$data_series_cause = [
    ['name' => 'สาเหุตการเสีย', 'data' => $data_series_for_cause],
];

$data_series = [
    ['name' => 'สถานะงานซ่อม', 'data' => [['name' => 'ซ่อมเสร็จแล้ว', 'y' => $work_closed_qty, 'color' => '#544fc5'], ['name' => 'ซ่อมอยู่', 'y' => $work_receive_qty, 'color' => '#91e8e1']]],
];

?>
<form action="<?= \yii\helpers\Url::to(['workorderreport/index'], true) ?>" method="post">
    <div class="row">
        <div class="col-lg-3">
            <label for="">ตั้งแต่วันที่</label>
            <?php
            echo DateTimePicker::widget([
                'name' => 'from_date',
                'value' => date('Y-m-d H:i',strtotime($from_date)),
                'options' => ['placeholder' => 'เลือกวันที่'],
                 'readonly' => false,
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy hh:ii',
                    'autoclose' => true,
                   // 'startDate' => date('Y-m-d H:i'),
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-3">
            <label for="">ถึงวันที่</label>
            <?php
            echo DateTimePicker::widget([
                'name' => 'to_date',
                'value' => date('Y-m-d H:i',strtotime($to_date)),
                'options' => ['placeholder' => 'เลือกวันที่'],
                'readonly' => false,
                'pluginOptions' => [
                    'format' => 'dd-mm-yyyy hh:ii',
                    'autoclose' => true,
                   //  'startDate' => date('Y-m-d H:i'),
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-3">
            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">ค้นหา</button>
        </div>
        <div class="col-lg-3"></div>
    </div>
</form>
<br/>
<div class="row">
    <div class="col-lg-4" style="text-align: center;">
        <?php

        echo Highcharts::widget([
            'options' => [
                'credits' => [
                        'enabled' => false,
                ],
                'chart' => [
                    'type' => 'pie',
                ],
                'title' => ['text' => 'งานซ่อม'],
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
    <div class="col-lg-4" style="text-align: center;">
        <?php

        echo Highcharts::widget([
            'options' => [
                'credits' => [
                    'enabled' => false,
                ],
                'chart' => [
                    'type' => 'pie',
                ],
                'title' => ['text' => 'ประเภทปัญหา'],
//                        'xAxis' => [
//                            'categories' => $date_data
//                        ],
                'yAxis' => [
                    'title' => ['text' => 'งาน']
                ],
                'series' => $data_series_cause
            ]
        ]);
        ?>
    </div>
    <div class="col-lg-4" style="text-align: center;">
        <?php

        echo Highcharts::widget([
            'options' => [
                'credits' => [
                    'enabled' => false,
                ],
                'chart' => [
                    'type' => 'pie',
                ],
                'title' => ['text' => 'คะแนนความเสี่ยง'],
//                        'xAxis' => [
//                            'categories' => $date_data
//                        ],
                'yAxis' => [
                    'title' => ['text' => 'งาน']
                ],
                'series' => $data_series_for_risk_value
            ]
        ]);
        ?>
    </div>
</div>