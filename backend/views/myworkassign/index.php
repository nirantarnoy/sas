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
?>

    <br/>
    <h4>รายการใบงาน <span style="font-weight: bold"><?= $itemcount ?> </span>รายการ</h4>
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
                                <div class="btn btn-warning">ความเสี่ยง</div>
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
                           value="<?= \backend\models\WorkorderStatus::findName($value->workorder_status) ?>">
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
                            <?php if ($value->workorder_status == 2): ?>
                                <tr>
                                    <td colspan="2">
                                        <input type="hidden" class="line-workorder-no"
                                               value="<?= $value->workorder_no ?>">
                                        <input type="hidden" class="line-workorder-asset"
                                               value="<?= \backend\models\Asset::findName($value->asset_id) ?>">
                                        <input type="hidden" class="line-workorder-location"
                                               value="<?= \backend\models\Asset::findLocationName($value->asset_id) ?>">
                                        <input type="hidden" class="line-workorder-status"
                                               value="<?= \backend\models\WorkorderStatus::findName($value->workorder_status) ?>">
                                        <div class="btn btn-success btn-close-workorder">
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
                <form action="<?= Url::to(['myworkassign/closeworkorder'], true) ?>" method="post">
                    <div class="modal-body">
                        <div style="height: 10px;"></div>
                        <input type="hidden" name="removelist" class="remove-list" value="">
                        <table class="table table-bordered table-striped table-find-list" width="100%">
                            <tbody>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">เลขที่ใบแจ้งซ่อม</td>
                                <td>
                                    <input type="text" style="font-weight: bold;"
                                           class="form-control line-close-workorder-no" value="" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">เครื่องจักร</td>
                                <td>
                                    <input type="text" class="form-control line-close-workorder-asset" value=""
                                           readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">ที่ตั้ง</td>
                                <td>
                                    <input type="text" class="form-control line-close-workorder-location" value=""
                                           readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">สถานะ</td>
                                <td>
                                    <input type="text" class="form-control line-close-workorder-status" value=""
                                           readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: right;vertical-align: middle;">รายละเอียด</td>
                                <td>
                                    <textarea class="form-control" name="" id="" cols="30" rows="5"></textarea>
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
                                    <textarea class="form-control" name="accept_workorder_reason" id="" cols="30" rows="5"></textarea>
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

<?php
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['depends' => [\yii\web\JqueryAsset::className()]]);
$js = <<<JS
$(function(){
    $(".btn-close-workorder").on("click",function(){
        var workorder_no = $(this).closest("tr").find(".line-workorder-no").val();
        var workorder_asset = $(this).closest("tr").find(".line-workorder-asset").val();
        var workorder_location = $(this).closest("tr").find(".line-workorder-location").val();
        var workorder_status = $(this).closest("tr").find(".line-workorder-status").val();
      //  alert(workorder_no);
        $(".line-close-workorder-no").val(workorder_no);
        $(".line-close-workorder-asset").val(workorder_asset);
        $(".line-close-workorder-location").val(workorder_location);
        $(".line-close-workorder-status").val(workorder_status);
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
});
JS;

$this->registerJs($js, static::POS_END);
?>