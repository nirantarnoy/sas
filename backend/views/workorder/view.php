<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorder */

$this->title = $model->workorder_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$work_photo = '';
$work_vdo = '';

$model_work_photo = \common\models\WorkorderPhoto::find()->select(['photo'])->where(['workorder_id'=>$model->id])->one();
$model_work_vdo = \common\models\WorkorderVdo::find()->select(['file_name'])->where(['workorder_id'=>$model->id])->one();

if($model_work_photo){
    $work_photo = $model_work_photo->photo;
}
if($model_work_vdo){
    $work_vdo = $model_work_vdo->file_name;
}
?>
<div class="workorder-view">

    <br>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!--    --><?php //= DetailView::widget([
    //        'model' => $model,
    //        'attributes' => [
    ////            'id',
    //            'workorder_no',
    //            [
    //                'attribute' => 'workorder_date',
    //                'value' => function ($data) {
    //                    return date('d/m/Y', strtotime($data->workorder_date));
    //                },
    //            ],
    //            [
    //                'attribute' => 'asset_id',
    //                'value' => function ($data) {
    //                    return \backend\models\Asset::findName($data->asset_id);
    //                }
    //            ],
    //            'assign_emp_id',
    //            //'work_recieve_date',
    //            //'work_assign_date',
    //            [
    //                'attribute' => 'created_by',
    //                'value' => function ($data) {
    //                    return \backend\models\User::findName($data->created_by);
    //                }
    //            ],
    //            [
    //                'attribute' => 'status',
    //                'format' => 'html',
    //                'value' => function ($data) {
    //                    $status_name = \backend\models\Workorderstatus::findName($data->status);
    //                    if($data->status == 1){
    //                        return '<div class="badge badge-success">'.$status_name.'</div>';
    //                    }
    //                }
    //            ],
    //            'work_recieve_date',
    //            'work_assign_date',
    // //           'status',
    ////            'created_at',
    ////            'created_by',
    ////            'updated_at',
    ////            'updated_by',
    //        ],
    //    ]) ?>

    <div style="border: 1px solid grey;padding: 15px;border-radius: 10px;">
        <div class="row">
            <div class="col-lg-4">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 25%;">ชื่อเครื่อง</td>
                        <td><b><?= \backend\models\Asset::findName($model->asset_id) ?></b></td>
                    </tr>
                    <tr>
                        <td>ใบแจ้งซ่อม</td>
                        <td><b><?= $model->workorder_no ?></b></td>
                    </tr>
                    <tr>
                        <td>ยี่ห้อ</td>
                        <td><b><?= \backend\models\Asset::findAssetBrand($model->asset_id) ?></b></td>
                    </tr>
                    <tr>
                        <td>รุ่น</td>
                        <td><b><?= \backend\models\Asset::findAssetmodel($model->asset_id) ?></b></td>
                    </tr>
                    <tr>
                        <td>แผนก</td>
                        <td><b><?= \backend\models\Asset::findDeptName($model->asset_id) ?></b></td>
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
                        <td style="text-align: center;border: 1px dashed grey;"><b><?=$model->stop6?></b></td>
                        <td style="text-align: center;border: 1px dashed grey;"><b><?=\backend\helpers\YesnoType::getTypeById($model->abnormal)?></b></td>
                        <td style="text-align: center;border: 1px dashed grey;"><b><?=$model->view_point?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="height: 20px;">อาการ</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea class="form-control" name="" id="" cols="30" rows="3"><?=$model->problem_text?></textarea>
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
                             <td style="width: 20%;"></td>
                             <td style="">   <label for="">รูปเครื่องจักร</label></td>
                             <td style="width: 20%"></td>
                         </tr>
                         <tr>
                             <td style="width: 20%;height: 100px;"></td>
                             <td style="border: 1px dashed grey;"></td>
                             <td style="width: 20%"></td>
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
                <?php if ($model->isNewRecord): ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 200px;text-align: center;">
                                <img src=""
                                     style="max-width: 130px;margin-top: 5px;" alt="">
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 260px;text-align: center;padding: 5px;">
                                <img src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/workorder_photo/' . $work_photo ?>"
                                     style="max-width: 130px;margin-top: 5px;" alt="">
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>

            </div>
            <div class="col-lg-6">
                <label for="">วิดีโอ</label>
                <?php if ($model->isNewRecord): ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 200px;text-align: center;">

                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 200px;text-align: center;padding: 5px;">
                                <video width="320" height="240" controls autoplay>
                                    <source src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/workorder_vdo/' . $work_vdo ?>" type="video/mp4">
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
                        <td><b><?= \backend\models\User::findName($model->created_by) ?></b></td>
                        <td>เวลาแจ้ง</td>
                        <td><b><?= date('d/m/Y H:i:s', strtotime($model->workorder_date)) ?></b></td>
                    </tr>
                    <tr>
                        <td>สถานที่</td>
                        <td><b><?=\backend\models\Asset::findLocationName($model->asset_id) ?></b></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-1" style="text-align: right;border: 1px dashed grey;border-right: none;padding: 10px;">
                <div class="btn btn-success">รับงาน</div>
            </div>
            <div class="col-lg-1" style="border: 1px dashed grey;border-left: none;padding: 10px;">
                <div class="btn btn-danger">ไม่รับงาน</div>
            </div>
        </div>
        <hr />
        <br/>
        <div class="row">
            <div class="col-lg-6">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 20%">วันที่คาดว่าจะเสร็จ</td>
                        <td><b><?=date('d/m/Y')?></b></td>
                    </tr>
                    <tr>
                        <td>ข้อความล่าสุด</td>
                        <td><b><?= ''?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="btn btn-success">
                                ปิดงาน
                            </div>
                        </td>

                    </tr>
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
