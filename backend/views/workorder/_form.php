<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorder */
/* @var $form yii\widgets\ActiveForm */

$loc_name = '';
if ($model->asset_id != null) {
    $loc_name = \backend\models\Asset::findLocationName($model->asset_id);
}
?>

    <div class="workorder-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'workorder_no')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => $model->isNewRecord ? '' : $model->workorder_no]) ?>
            </div>
            <div class="col-lg-4">
                <?php $model->workorder_date = $model->isNewRecord ? date('d/m/Y') : date('d/m/Y', strtotime($model->workorder_date)); ?>
                <?php if ($model->isNewRecord): ?>
                    <?= $form->field($model, 'workorder_date')->widget(\kartik\date\DatePicker::className(), [
                        'value' => date('Y-m-d'),
                        'readonly' => true,
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                        ],
                        'options' => [
                            'disabled' => 'true',
//                            'readonly' => 'readonly',
                        ],
                    ]) ?>
                <?php else: ?>
                    <?php //echo 'hello error'?>
                    <input type="hidden" name="old_date" value="<?= $model->workorder_date ?>">
                    <?= $form->field($model, 'workorder_date')->widget(\kartik\date\DatePicker::className(), [
                        'value' => date('Y-m-d'),
                        'readonly' => true,
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                        ],
                        'options' => [
                            'disabled' => 'disabled',
//                            'readonly' => 'readonly',
                        ],
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'asset_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Asset::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--เครื่องจักร--',
                        'onchange' => 'getLocationOption($(this))',
                    ]
                ]) ?>

            </div>
            <div class="col-lg-3">
                <label for="">ที่ตั้งเครื่องจักร</label>
                <!--                <input type="text" class="form-control location-name" readonly value="-->
                <?php //= $loc_name ?><!--">-->
                <?= $form->field($model, 'work_asset_location_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Location::find()->all(), 'id', 'name'),
                    'options' => [
                        'class' => 'select-location',
                    ]
                ])->label(false) ?>
            </div>
            <div class="col-lg-3">
                <?php
                if ($model->isNewRecord) {
                    $model->work_recieve_date = null;
                    $model->work_assign_date = null;
                } else {
                    $init_year = date('Y', strtotime($model->work_recieve_date));
                    if ($init_year != 1970) {
                        $model->work_recieve_date = date('d/m/Y', strtotime($model->work_recieve_date));
                        $model->work_assign_date = date('d/m/Y', strtotime($model->work_assign_date));
                    } else {
                        $model->work_recieve_date = null;
                        $model->work_assign_date = null;
                    }
                }
                // $model->work_recieve_date = $model->isNewRecord ? null: date('d/m/Y', strtotime($model->work_recieve_date));
                ?>
                <?= $form->field($model, 'work_recieve_date')->widget(\kartik\date\DatePicker::className(), [
                    //  'value' => $model->work_recieve_datedate('Y-m-d'),
                    'options' => [
                        'disabled' => 'disabled',
                    ],
                    'pluginOptions' => [
                        'format' => 'dd/mm/yyyy'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'work_assign_date')->widget(\kartik\date\DatePicker::className(), [
                    //'value' => date('Y-m-d'),
                    'options' => [
                        'disabled' => 'disabled',
                    ],
                    'pluginOptions' => [
                        'format' => 'dd/mm/yyyy',
                        //  'disabled' => true,
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($model, 'problem_text')->textarea(['maxlength' => true,]) ?>
                <input type="hidden" name="work_old_photo" value="<?= $work_photo ?>">
                <input type="hidden" name="work_old_vdo" value="<?= $work_vdo ?>">
            </div>
        </div>

        <br/>
        <div class="row">
            <div class="col-lg-6">
                <label for="">รูปภาพ</label>
                <?php if ($model->isNewRecord): ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table style="width: 100%">
                        <tr>
                            <?php if ($work_photo != ''): ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/workorder_photo/' . $work_photo ?>"
                                       target="_blank"><img
                                                src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/workorder_photo/' . $work_photo ?>"
                                                style="max-width: 130px;margin-top: 5px;" alt=""></a>
                                </td>
                            <?php else: ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                    <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </table>
                <?php endif; ?>
                <input type="file" name="work_photo" class="form-control">
            </div>
            <div class="col-lg-6">
                <label for="">วิดีโอ</label>
                <?php if ($model->isNewRecord): ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table style="width: 100%">
                        <tr>
                            <?php if ($work_vdo != ''): ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <video width="320" height="240" controls autoplay>
                                        <source src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/workorder_vdo/' . $work_vdo ?>"
                                                type="video/mp4">
                                        Sorry, your browser doesn't support the video element.
                                    </video>
                                </td>
                            <?php else: ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                    <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </table>
                <?php endif; ?>
                <input type="file" name="work_video" class="form-control">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'stop6')->textInput(['maxlength' => true,]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'abnormal')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\YesnoType::asArrayObject(), 'id', 'name'),
                    'pluginOptions' => []
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'view_point')->textInput(['maxlength' => true,]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'work_cause_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\WorkorderCauseTitle::find()->all(), 'id', 'name'),
                    'pluginOptions' => []
                ]) ?>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'weak_point_analysis')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\WorkorderWeakpoint::find()->all(), 'id', 'name'),
                    'pluginOptions' => []
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'cause_risk_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\WorkorderCauseRisk::find()->all(), 'id', 'name'),
                    'pluginOptions' => []
                ]) ?>
            </div>
            <div class="col-lg-3">
                <input type="hidden" name="work_created_by" value="<?= $model->created_by ?>">
                <?= $form->field($model, 'created_by')->textInput(['maxlength' => true, 'readonly' => 'readonly', 'value' => \backend\models\User::findName($model->created_by)]) ?>
            </div>
            <div class="col-lg-3">
                <input type="hidden" name="work_status" value="<?= $model->status ?>">
                <?= $form->field($model, 'status')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Workorderstatus::find()->all(), 'id', 'name'),
                    'pluginOptions' => [
                        'disabled' => true,
                    ]
                ])->label() ?>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-4">
                <label for="">ความเสี่ยงก่อนการแก้ไข</label>
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>ความรุนแรง</td>
                        <td>
                            <input class="form-control factor-risk-1" type="number" min="0" name="factor_risk_1"
                                   value="<?= $model->factor_risk_1 ?>" onchange="calfactorrisk($(this))">
                        </td>
                    </tr>
                    <tr>
                        <td>ความถี่</td>
                        <td>
                            <input class="form-control factor-risk-2" type="number" min="0" name="factor_risk_2"
                                   value="<?= $model->factor_risk_2 ?>" onchange="calfactorrisk($(this))">
                        </td>
                    </tr>
                    <tr>
                        <td>มาตรการ Safety</td>
                        <td>
                            <input class="form-control factor-risk-3" type="number" min="0" name="factor_risk_3"
                                   value="<?= $model->factor_risk_3 ?>" onchange="calfactorrisk($(this))">
                        </td>
                    </tr>
                    <tr>
                        <td>(1)+(2)+(3)</td>
                        <td>
                            <input class="form-control factor-total" type="text" readonly name="factor_total"
                                   value="<?= $model->factor_total ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>สรุปความเสี่ยง</td>
                        <td>
                            <input class="form-control" type="text" name="factor_final"
                                   value="<?= $model->factor_risk_final ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-8">
            </div>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$url_to_get_location = \yii\helpers\Url::to(['asset/getlocation'], true);
$url_to_get_location_option = \yii\helpers\Url::to(['asset/getlocationoption'], true);
$js = <<<JS
function getLocation(e){
    var asset_id = e.val();
    $.ajax({
        'type': 'post',
        'dataType': 'html',
        'url': "$url_to_get_location",
        'data': {'asset_id': asset_id},
        'success': function(data){
            // alert(data)
            if(data!=''){
                // alert('hello')
                $(".location-name").val(data);
            }
        }       
    });    
}
function getLocationOption(e){
    var asset_id = e.val();
    //alert(asset_id);
    $.ajax({
        'type': 'post',
        'dataType': 'html',
        'url': "$url_to_get_location_option",
        'data': {'asset_id': asset_id},
        'success': function(data){
            // alert(data)
            if(data!=''){
                $(".select-location").html(data);
            }
        }       
    });    
}
function calfactorrisk(e){
    var fac1 = $(".factor-risk-1").val();
    var fac2 = $(".factor-risk-2").val();
    var fac3 = $(".factor-risk-3").val();
    var total = parseFloat(fac1) + parseFloat(fac2) + parseFloat(fac3);
    $(".factor-total").val(parseFloat(total).toFixed(2));
}
JS;
$this->registerJs($js, static::POS_END);
?>