<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorder */
$itemcount = 0;
if ($model != null) {
    $itemcount = count($model);
}

//$model_risk_title = \common\models\WorkorderRiskTitle::find()->where(['status' => 1])->all();
$model_work_cause = \common\models\WorkorderCauseTitle::find()->where(['status' => 1])->all();
$model_work_solve = \common\models\SolveTitle::find()->where(['status' => 1])->all();
?>

    <br/>
    <h4>รายการใบงาน <span style="font-weight: bold"><?= $itemcount ?> </span>รายการ</h4>
    <br/>
<?php
$btn_active = 'btn-success';
$btn_inactive = 'btn-secondary';

?>
    <div class="btn-group">
        <a href="index.php?r=myworkassign/index&type=all" class="btn <?= $type == 'all' ? $btn_active : $btn_inactive ?>">All</a>
        <a href="index.php?r=myworkassign/index&type=1" class="btn <?= $type == '1' ? $btn_active : $btn_inactive ?>">รอรับงาน</a>
        <a href="index.php?r=myworkassign/index&type=3" class="btn <?= $type == '3' ? $btn_active : $btn_inactive ?>">ระหว่างซ่อม</a>
        <a href="index.php?r=myworkassign/index&type=4" class="btn <?= $type == '4' ? $btn_active : $btn_inactive ?>">ซ่อมเสร็จ</a>
        <a href="index.php?r=myworkassign/index&type=5" class="btn <?= $type == '5' ? $btn_active : $btn_inactive ?>">ยกเลิก</a>
        <a href="index.php?r=myworkassign/index&type=6" class="btn <?= $type == '6' ? $btn_active : $btn_inactive ?>">ไม่รับงาน</a>
    </div>
    <hr/>
<?php if ($model): ?>
    <?php foreach ($model as $value): ?>
        <?php
        $work_photo = '';
        $work_vdo = '';
        $asset_photo = '';
        $last_message = '';

        $model_work_photo = \common\models\WorkorderPhoto::find()->select(['photo'])->where(['workorder_id' => $value->workorder_id])->one();
        $model_work_vdo = \common\models\WorkorderVdo::find()->select(['file_name'])->where(['workorder_id' => $value->workorder_id])->one();
        $model_asset = \common\models\AssetPhoto::find()->select(['photo'])->where(['asset_id' => $value->asset_id])->one();

        $model_message = \common\models\WorkorderChat::find()->select(['message'])->where(['workorder_id' => $value->workorder_id])->orderBy(['id' => SORT_DESC])->one();
        if ($model_message) {
            $last_message = $model_message->message;
        }

        if ($model_work_photo) {
            $work_photo = $model_work_photo->photo;
        }
        if ($model_work_vdo) {
            $work_vdo = $model_work_vdo->file_name;
        }
        if ($model_asset) {
            $asset_photo = $model_asset->photo;
        }
        ?>
        <div class="workorder-view">

            <div style="border: 1px solid grey;padding: 15px;border-radius: 10px;">
                <div class="row">
                    <div class="col-lg-4">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 25%;">ชื่อเครื่อง</td>
                                <td><b><?= \backend\models\Asset::findName($value->asset_id) ?></b></td>
                            </tr>
                            <tr>
                                <td>ใบแจ้งซ่อม</td>
                                <td><b><?= $value->workorder_no ?></b></td>
                            </tr>
                            <tr>
                                <td>ยี่ห้อ</td>
                                <td><b><?= \backend\models\Asset::findAssetBrand($value->asset_id) ?></b></td>
                            </tr>
                            <tr>
                                <td>รุ่น</td>
                                <td><b><?= \backend\models\Asset::findAssetmodel($value->asset_id) ?></b></td>
                            </tr>
                            <tr>
                                <td>แผนก</td>
                                <td><b><?= \backend\models\Asset::findDeptName($value->asset_id) ?></b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <table style="width: 100%">
                            <tr>
                                <td style="text-align: center;border: 1px dashed grey;">STOP6</td>
                                <td style="text-align: center;border: 1px dashed grey;">Abnormal</td>
                                <td style="text-align: center;border: 1px dashed grey;">View point</td>
                            </tr>

                            <tr>
                                <td style="text-align: center;border: 1px dashed grey;"><b><?= $value->stop6 ?></b></td>
                                <td style="text-align: center;border: 1px dashed grey;">
                                    <b><?= \backend\helpers\YesnoType::getTypeById($value->abnormal) ?></b></td>
                                <td style="text-align: center;border: 1px dashed grey;"><b><?= $value->view_point ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="height: 20px;">อาการ</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                            <textarea class="form-control" name="" id="" cols="30"
                                      rows="3"><?= $value->problem_text ?></textarea>
                                </td>

                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12" style="text-align: right">
                                <div class="btn btn-warning btn-show-risk" data-var="<?= $value->workorder_id ?>">
                                    ความเสี่ยง
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">

                                <table style="width: 100%">
                                    <tr>
                                        <td style="width: 25%;"></td>
                                        <td style=""><label for="">รูปเครื่องจักร</label></td>
                                        <td style="width: 25%"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%;height: 100px;"></td>
                                        <td style="border: 1px dashed grey;text-align: center;">
                                            <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/asset_photo/' . $asset_photo ?>"
                                               target="_blank"><img
                                                        src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/asset_photo/' . $asset_photo ?>"
                                                        style="max-width: 130px;margin-top: 5px;" alt=""></a>
                                        </td>
                                        <td style="width: 25%"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="">รูปภาพ</label>
                        <?php if ($work_photo == ''): ?>
                            <table style="width: 100%">
                                <tr>
                                    <td style="border: 1px dashed grey;height: 260px;text-align: center;">
                                        <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                        <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                                    </td>
                                </tr>
                            </table>
                        <?php else: ?>
                            <table style="width: 100%">
                                <tr>
                                    <td style="border: 1px dashed grey;height: 260px;text-align: center;padding: 5px;">
                                        <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/workorder_photo/' . $work_photo ?>"
                                           target="_blank"><img
                                                    src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/workorder_photo/' . $work_photo ?>"
                                                    style="max-width: 130px;margin-top: 5px;" alt=""></a>
                                    </td>
                                </tr>
                            </table>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-6">
                        <label for="">วิดีโอ</label>
                        <?php if ($work_vdo == ''): ?>
                            <table style="width: 100%">
                                <tr>
                                    <td style="border: 1px dashed grey;height: 260px;text-align: center;">
                                        <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                        <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                                    </td>
                                </tr>
                            </table>
                        <?php else: ?>
                            <table style="width: 100%">
                                <tr>
                                    <td style="border: 1px dashed grey;height: 200px;text-align: center;padding: 5px;">
                                        <video width="320" height="240" controls autoplay>
                                            <source src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/workorder_vdo/' . $work_vdo ?>"
                                                    type="video/mp4">
                                            Sorry, your browser doesn't support the video element.
                                        </video>
                                    </td>
                                </tr>
                            </table>
                        <?php endif; ?>

                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-lg-4">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 25%">ผู้แจ้ง</td>
                                <td><b><?= \backend\models\User::findName($value->workorder_created_by) ?></b></td>
                                <td>เวลาแจ้ง</td>
                                <td><b><?= date('d/m/Y H:i:s', strtotime($value->workorder_date)) ?></b></td>
                            </tr>
                            <tr>
                                <td>สถานที่</td>
                                <td><b><?= \backend\models\Asset::findLocationName($value->asset_id) ?></b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4"></div>
                    <input type="hidden" class="accept-workorder-id"
                           value="<?= $value->workorder_id ?>">
                    <input type="hidden" class="accept-workorder-no"
                           value="<?= $value->workorder_no ?>">
                    <input type="hidden" class="accept-workorder-asset"
                           value="<?= \backend\models\Asset::findName($value->asset_id) ?>">
                    <input type="hidden" class="accept-workorder-location"
                           value="<?= \backend\models\Asset::findLocationName($value->asset_id) ?>">
                    <input type="hidden" class="accept-workorder-status"
                           value="<?= \backend\models\Workorderstatus::findName($value->workorder_status) ?>">
                    <?php if ($value->workorder_status == 1): ?>
                        <div class="col-lg-1"
                             style="text-align: right;border: 1px dashed grey;border-right: none;padding: 10px;">
                            <div class="btn btn-success btn-accept-workorder">รับงาน</div>
                        </div>
                        <div class="col-lg-1" style="border: 1px dashed grey;border-left: none;padding: 10px;">
                            <div class="btn btn-danger btn-deny-workorder">ไม่รับงาน</div>
                        </div>
                    <?php endif; ?>
                </div>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col-lg-6">

                        <table style="width: 100%">
                            <tr>
                                <td style="width: 20%">วันที่คาดว่าจะเสร็จ</td>
                                <td><b><?= date('d/m/Y') ?></b></td>
                            </tr>
                            <tr>
                                <td>ข้อความล่าสุด</td>
                                <td><b><?= $last_message ?></b> <a
                                            href="index.php?r=workorderchat%2Fchat&id=<?= $value->workorder_id ?>"
                                            class="btn btn-primary"><i class="fa fa-comments"></i> <span>แชท</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 20px;"></td>
                                <td>
                                </td>
                            </tr>
                            <?php if ($value->workorder_status == 3): ?>
                                <?php
                                $line_time_use = '';
                                $date1 = date_create(date('Y-m-d H:i:s', strtotime($value->workorder_date)));
                                $date2 = date_create(date('Y-m-d H:i:s'));
                                $line_time_use = date_diff($date1, $date2);
                                ?>
                                <tr>
                                    <td colspan="2">
                                        <input type="hidden" class="line-work-time-use"
                                               value="<?= $line_time_use->format('%d days %h hours %i minute') ?>">
                                        <input type="hidden" class="line-workorder-no"
                                               value="<?= $value->workorder_no ?>">
                                        <input type="hidden" class="line-workorder-asset"
                                               value="<?= \backend\models\Asset::findName($value->asset_id) ?>">
                                        <input type="hidden" class="line-workorder-location"
                                               value="<?= \backend\models\Asset::findLocationName($value->asset_id) ?>">
                                        <input type="hidden" class="line-workorder-status"
                                               value="<?= \backend\models\WorkorderStatus::findName($value->workorder_status) ?>">
                                        <div data-var="<?= $value->workorder_id ?>"
                                             class="btn btn-success btn-close-workorder">
                                            ปิดงาน
                                        </div>
                                    </td>

                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table>
                            <tr>
                                <td>สถานะเครื่อง</td>
                                <td>
                                    <div class="btn-group">
                                        <div class="btn btn-sm btn-success">ทำงาน</div>
                                        <div class="btn btn-sm btn-secondary">หยุดทำงาน</div>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>

                <br/>
            </div>

        </div>
        <br/>
        <div style="height: 20px;">

        </div>

    <?php endforeach; ?>
<?php else: ?>
<?php endif; ?>

    <div id="closeWorkModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <b>ปิดใบสั่งงาน</b>
                        </div>
                    </div>
                </div>
                <form action="<?= Url::to(['myworkassign/closeworkorder'], true) ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="modal-body">
                        <div style="height: 10px;"></div>
                        <input type="hidden" name="workorder_id" class="close-workorder-id" value="">
                        <table class="table table-bordered table-striped table-find-list" width="100%">
                            <tbody>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">เลขที่ใบแจ้งซ่อม</td>
                                <td>
                                    <input type="text" style="font-weight: bold;"
                                           class="form-control line-close-workorder-no" value="" readonly>
                                </td>
                                <td style="vertical-align: middle;text-align: right;">
                                    ใช้เวลา
                                </td>
                                <td>
                                    <input type="text" class="form-control line-close-workorder-time-use" readonly
                                           value="">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">เครื่องจักร</td>
                                <td colspan="3">
                                    <input type="text" class="form-control line-close-workorder-asset" value=""
                                           readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">ต้นเหตุปัญหา</td>
                                <td colspan="3">
                                    <select name="line_work_cause" id="" class="form-control">
                                        <option value="-1">--เลือก--</option>
                                        <?php foreach ($model_work_cause as $value): ?>
                                            <option value="<?= $value->id ?>"><?= $value->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">การแก้ปัญหา</td>
                                <td colspan="3">
                                    <select name="line_work_solve" id="" class="form-control">
                                        <option value="-1">--เลือก--</option>
                                        <?php foreach ($model_work_solve as $value): ?>
                                            <option value="<?= $value->id ?>"><?= $value->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">
                                    มาตรการป้องกันทั้งชั่วคราว/ถาวร
                                </td>
                                <td colspan="3">
                                    <textarea class="form-control" name="preventive_text" id="" cols="30"
                                              rows="5"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">รูปภาพหลังซ่อม</td>
                                <td colspan="3">
                                    <input type="file" class="form-control" name="file_close" id="file_closeworkorder">
                                </td>
                            </tr>

                            </tbody>
                        </table>

                        <br/>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success" data-dismiss="modalx"><i
                                    class="fa fa-check"></i> บันทึก
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                    class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="acceptWorkModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-12" style="text-align: center;">
                            <b><span class="work-accept-text"></span></b>
                        </div>
                    </div>
                </div>
                <form action="<?= Url::to(['myworkassign/acceptworkorder'], true) ?>" method="post">
                    <div class="modal-body">
                        <div style="height: 10px;"></div>
                        <input type="hidden" name="workorder_id" class="accept-workorder-id" value="">
                        <input type="hidden" name="workorder_accept_type" class="workorder-accept-type" value="">
                        <table class="table table-bordered table-striped table-find-list" width="100%">
                            <tbody>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">เลขที่ใบแจ้งซ่อม</td>
                                <td>
                                    <input type="text" style="font-weight: bold;"
                                           class="form-control accept-workorder-no" value="" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">เครื่องจักร</td>
                                <td>
                                    <input type="text" class="form-control accept-workorder-asset" value=""
                                           readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">ที่ตั้ง</td>
                                <td>
                                    <input type="text" class="form-control accept-workorder-location" value=""
                                           readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">สถานะ</td>
                                <td>
                                    <input type="text" class="form-control accept-workorder-status" value=""
                                           readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">รายละเอียด</td>
                                <td>
                                    <textarea class="form-control" name="accept_workorder_reason" id="" cols="30"
                                              rows="5"></textarea>
                                </td>
                            </tr>


                            </tbody>
                        </table>

                        <br/>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success" data-dismiss="modalx"><i
                                    class="fa fa-check"></i> บันทึก
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                    class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="riskafterModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <b>ความเสี่ยงหลังการแก้ไข</b>
                        </div>
                    </div>
                </div>
                <form action="<?= Url::to(['myworkassign/saveriskafter'], true) ?>" method="post">
                    <input type="hidden" class="save-risk-workorder-id" name="workorder_id" value="">
                    <div class="modal-body">
                        <div style="height: 10px;"></div>
                        <table class="table table-bordered table-striped table-risk-list" width="100%">
                            <tbody>

                            </tbody>
                        </table>

                        <br/>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success" data-dismiss="modalx"><i
                                    class="fa fa-check"></i> บันทึก
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                    class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="riskBeforeModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <b>ความเสี่ยงก่อนการแก้ไข</b>
                        </div>
                    </div>
                </div>

                <input type="hidden" class="save-risk-workorder-id" name="workorder_id" value="">
                <div class="modal-body">
                    <div style="height: 10px;"></div>
                    <table class="table table-bordered table-striped table-risk-before-list" width="100%">
                        <tbody>

                        </tbody>
                    </table>

                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                    </button>
                </div>

            </div>

        </div>
    </div>

<?php
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['depends' => [\yii\web\JqueryAsset::className()]]);
$url_to_find_risk_after = Url::to(['myworkassign/findriskafter'], true);
$url_to_find_risk_before = Url::to(['myworkassign/findriskbefore'], true);
$js = <<<JS
$(function(){
    $(".btn-close-workorder").on("click",function(){
        var workorder_id = $(this).attr("data-var");
        var workorder_no = $(this).closest("tr").find(".line-workorder-no").val();
        var workorder_asset = $(this).closest("tr").find(".line-workorder-asset").val();
        var workorder_location = $(this).closest("tr").find(".line-workorder-location").val();
        var workorder_status = $(this).closest("tr").find(".line-workorder-status").val();
        var time_use = $(this).closest("tr").find(".line-work-time-use").val();
      //  alert(workorder_no);
        $(".close-workorder-id").val(workorder_id);
        $(".line-close-workorder-no").val(workorder_no);
        $(".line-close-workorder-asset").val(workorder_asset);
        $(".line-close-workorder-location").val(workorder_location);
        $(".line-close-workorder-status").val(workorder_status);
        $(".line-close-workorder-time-use").val(time_use);
        $("#closeWorkModal").modal("show");
    });
    
    $(".btn-accept-workorder").on("click",function(){
        var work_order_id = $(this).parent().parent().find(".accept-workorder-id").val();
        var work_order_no = $(this).parent().parent().find(".accept-workorder-no").val();
        var work_order_asset = $(this).parent().parent().find(".accept-workorder-asset").val();
        var work_order_location = $(this).parent().parent().find(".accept-workorder-location").val();
        var work_order_status = $(this).parent().parent().find(".accept-workorder-status").val();
      
        $(".accept-workorder-id").val(work_order_id);
        $(".accept-workorder-no").val(work_order_no);
        $(".accept-workorder-asset").val(work_order_asset);
        $(".accept-workorder-location").val(work_order_location);
        $(".accept-workorder-status").val(work_order_status);
        $(".workorder-accept-type").val(1);
        
        $(".modal-header").css("background-color","#00a65a");
        $(".work-accept-text").html("รับงาน").css("color","#fff","text-align:center");
        $("#acceptWorkModal").modal("show");
    });
    $(".btn-deny-workorder").on("click",function(){
        var work_order_id = $(this).parent().parent().find(".accept-workorder-id").val();
        var work_order_no = $(this).parent().parent().find(".accept-workorder-no").val();
        var work_order_asset = $(this).parent().parent().find(".accept-workorder-asset").val();
        var work_order_location = $(this).parent().parent().find(".accept-workorder-location").val();
        var work_order_status = $(this).parent().parent().find(".accept-workorder-status").val();
     alert(work_order_id);
        $(".accept-workorder-id").val(work_order_id);
        $(".accept-workorder-no").val(work_order_no);
        $(".accept-workorder-asset").val(work_order_asset);
        $(".accept-workorder-location").val(work_order_location);
        $(".accept-workorder-status").val(work_order_status);
        $(".workorder-accept-type").val(0);
       
        $(".modal-header").css("background-color","red");
        $(".work-accept-text").html("ไม่รับงาน").css("color","#fff","text-align:center");
        $("#acceptWorkModal").modal("show");
    });
    $(".btn-show-risk").on("click",function(){
        var workorder_id = $(this).attr("data-var");
       // alert(workorder_id);
        if(workorder_id > 0){
            $.ajax({
              'dataType': 'html',
              'type': 'POST',
              'url': '$url_to_find_risk_before',
              'data': {
                  'workorder_id': workorder_id
              },
              'success': function (data) {
               // $(".save-risk-workorder-id").val(workorder_id);  
                $(".table-risk-before-list tbody").html(data);
                $("#riskBeforeModal").modal("show");
              }
            });
        }
       
    });
});
function calRiskAfter(e){
    var total_risk_sum = 0;
    //console.log($(".table-risk-list tbody tr").length);
    $(".table-risk-list tbody tr").each(function(){
        //alert();
        var risk_id = $(this).closest("tr").find(".line-risk-id").val();
        var risk_factor = $(this).closest("tr").find(".line-risk-factor").val();
        if(risk_id <=3){
            total_risk_sum = parseFloat(total_risk_sum) + parseFloat(risk_factor);
        }
        if(risk_id == 4){
            $(this).find(".line-risk-factor").val(total_risk_sum);
        }
      
    });
}
JS;

$this->registerJs($js, static::POS_END);
?>