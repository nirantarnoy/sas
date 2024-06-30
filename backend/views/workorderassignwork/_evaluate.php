<?php
$this->title = 'ประเมินงานซ่อม';

$pass_data = [['id' => 1, 'name' => 'ผ่าน'], ['id' => 2, 'name' => 'ไม่ผ่าน']];

$workorder_no = '';
$workorder_date = '';
$asset_no = '';
$asset_name = '';
$location = '';
$serial_no = '';


$result = '';
$risk_code = '';
$evaluate_result = 0;
$evaluate_photo = '';

if ($id) {
    $model_risk_title = \common\models\WorkorderRiskTitle::find()->where(['status' => 1])->all();
    $model_work = \common\models\Workorder::find()->where(['id' => $id])->one();
    if($model_work){
        $workorder_no = $model_work->workorder_no;
        $workorder_date = date('d-m-Y H:i:s',strtotime($model_work->workorder_date));
        $asset_no = \backend\models\Asset::findAssetNo($model_work->asset_id);
        $asset_name = \backend\models\Asset::findName($model_work->asset_id);
        $location = \backend\models\Asset::findLocationName($model_work->asset_id);
        $serial_no = \backend\models\Asset::findAssetSerialNo($model_work->asset_id);
    }

    $model_work_evaluate = \common\models\WorkorderEvaluate::find()->where(['workorder_id' => $id])->one();
    if($model_work_evaluate){
        $result = $model_work_evaluate->result;
        $risk_code = $model_work_evaluate->risk_code;
        $evaluate_result = $model_work_evaluate->evaluate_result;
        $evaluate_photo = $model_work_evaluate->photo;
    }
}
?>
<div class="row">
    <div class="col-lg-12">
        <h4>เลขที่ใบแจ้งซ่อม : <span style="font-weight: bold;"><?=$workorder_no?></span></h4>
    </div>
</div>
<form action="<?=\yii\helpers\Url::to(['workorderassignwork/addevaluate'],true)?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 20%;text-align: right;vertical-align: middle;">วันที่แจ้ง</td>
                    <td>
                        <input type="hidden" name="workorder_id" value="<?=$id?>">
                        <input type="text" class="form-control" value="<?=$workorder_date?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;text-align: right;vertical-align: middle;">รหัสเครื่องจักร</td>
                    <td>
                        <input type="text" class="form-control" value="<?=$asset_no?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;text-align: right;vertical-align: middle;">ชื่อเครื่องจักร</td>
                    <td>
                        <input type="text" class="form-control" value="<?=$asset_name?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;text-align: right;vertical-align: middle;">ที่ตั้ง</td>
                    <td>
                        <input type="text" class="form-control" value="<?=$location?>" readonly>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6">
            <table class="table table-bordered">
                <tr>
                    <td style="text-align: right;vertical-align: middle;">ผลที่ได้</td>
                    <td>
                        <input type="text" class="form-control" name="result" value="<?=$result?>">
                    </td>
                </tr>
                <?php if ($model_risk_title): ?>
                    <?php foreach ($model_risk_title as $value_titile): ?>
                        <?php
                        $line_value = 0;
                        $model_work_risk = \common\models\WorkorderRiskAfter::find()->where(['workorder_id' => $id, 'risk_id' => $value_titile->id])->orderBy(['id' => SORT_DESC])->one();
                        if ($model_work_risk) {
                            $line_value = $model_work_risk->risk_value;
                        }
                        $is_sum = '';
                        $line_sum_disabled = '';
                        if ($value_titile->id == 4) {
                            $is_sum = 'line-sum-risk';
                            $line_sum_disabled = 'readonly';
                        }
                        ?>
                        <tr>
                            <td style="width: 20%;text-align: right;vertical-align: middle;">
                                <input type="hidden" class="line-risk-id" name="line_risk_id"
                                       value="<?= $value_titile->id ?>">
                                <?= $value_titile->name ?>
                            </td>
                            <td><input type="text" style="font-weight: bold;"
                                       class="form-control line-risk-factor <?= $is_sum ?>" <?= $line_sum_disabled ?>
                                       name="line_risk_factor[]" value="<?= $line_value ?>"
                                       onclick="calRiskAfter($(this))">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td style="text-align: right;vertical-align: middle;">รหัสความเสี่ยง</td>
                    <td>
                        <input type="text" class="form-control" name="risk_code" value="<?=$risk_code?>">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;vertical-align: middle;">ผ่านการประเมิน</td>
                    <td>
                        <select name="evaluate_result" class="form-control">
                            <?php
                            foreach ($pass_data as $value) {
                                $selected = '';
                                if ($value['id'] == $evaluate_result) {
                                    $selected = 'selected';
                                }
                                echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;vertical-align: middle;"></td>
                    <td>
                        <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/work_evaluate_photo/' . $evaluate_photo ?>"
                           target="_blank"><img
                                    src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/work_evaluate_photo/' . $evaluate_photo ?>"
                                    style="max-width: 130px;margin-top: 5px;" alt=""></a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;vertical-align: middle;">รูปงาน</td>
                    <td>
                        <input type="file" class="form-control" name="evaluate_photo">
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3">
            <button type="submit" class="btn btn-success" >บันทึก</button>
        </div>
    </div>
</form>
