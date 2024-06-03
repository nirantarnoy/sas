<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AssetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เครื่องจักร';
$this->params['breadcrumbs'][] = '/ '.$this->title;
?>
<div class="asset-index">
    <?php if (!empty(\Yii::$app->session->getFlash('msg-success'))): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= \Yii::$app->session->getFlash('msg-success') ?>
        </div>
    <?php endif; ?>
    <br />
    <div class="row">
        <div class="col-lg-10">
            <p>
                <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้างใหม่'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-lg-2" style="text-align: right">
            <form id="form-perpage" class="form-inline" action="<?= Url::to(['asset/index'], true) ?>"
                  method="post">
                <div class="form-group">
                    <label>แสดง </label>
                    <select class="form-control" name="perpage" id="perpage">
                        <option value="20" <?= $perpage == '20' ? 'selected' : '' ?>>20</option>
                        <option value="50" <?= $perpage == '50' ? 'selected' : '' ?> >50</option>
                        <option value="100" <?= $perpage == '100' ? 'selected' : '' ?>>100</option>
                    </select>
                    <label> รายการ</label>
                </div>
            </form>
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //        'filterModel' => $searchModel,
        'layout' => "{items}\n{summary}\n<div class='text-center'>{pager}</div>",
        'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
        'showOnEmpty' => false,
        //    'bordered' => true,
        //     'striped' => false,
        //    'hover' => true,
        'id' => 'product-grid',
        //'tableOptions' => ['class' => 'table table-hover'],
        'emptyText' => '<div style="color: red;text-align: center;"> <b>ไม่พบรายการไดๆ</b> <span> เพิ่มรายการโดยการคลิกที่ปุ่ม </span><span class="text-success">"สร้างใหม่"</span></div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'asset_no',
            'name',
            'description',
            [
                'attribute' => 'asset_cat_id',
                'value' => function ($data) {
                    return \backend\models\Assetcategory::findName($data->asset_cat_id);
                },
            ],
            //'asset_brand_name',
            //'model_no',
            'serail_no',
            //'department_id',
            [
                'attribute' => 'location_id',
                'value' => function ($data) {
                    return \backend\models\Location::findName($data->location_id);
                },
            ],
            //'supplier_name',
            //'supplier_contact',
            //'cost',
            //'recieve_date',
            //'waranty_exp_date',
            //'watt',
            //'electric_type',
            //'breaker_no',
            //'photo',
            ['attribute' => 'status',
                'format' => 'html',
                'value' => function ($data) {
                    if($data->status == 0){
                        return '<div class="badge badge-secondary">'.\backend\helpers\CommonStatus::getTypeById($data->status).'</div>';
                    }else{
                        return '<div class="badge badge-success">'.\backend\helpers\CommonStatus::getTypeById($data->status).'</div>';
                    }
                },],
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            [

                'header' => 'ตัวเลือก',
                'headerOptions' => ['style' => 'text-align:center;', 'class' => 'activity-view-link',],
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: center'],
                'template' => '{tasklist}{view}{update}{delete}',
                'buttons' => [
                    'tasklist' => function ($url, $data, $index) {
                        $options = [
                            'title' => Yii::t('yii', 'Task List'),
                            'aria-label' => Yii::t('yii', 'Task List'),
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            '<span class="fas fa-list-alt btn btn-xs btn-default"></span>', $url, $options);
                    },
                    'view' => function ($url, $data, $index) {
                        $options = [
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            '<span class="fas fa-eye btn btn-xs btn-default"></span>', $url, $options);
                    },
                    'update' => function ($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'id' => 'modaledit',
                        ]);
                        return Html::a(
                            '<span class="fas fa-edit btn btn-xs btn-default"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]);
                    },
                    'delete' => function ($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            //'data-method' => 'post',
                            //'data-pjax' => '0',
                            'data-url' => $url,
                            'data-var' => $data->id,
                            'onclick' => 'recDelete($(this));'
                        ]);
                        return Html::a('<span class="fas fa-trash-alt btn btn-xs btn-default"></span>', 'javascript:void(0)', $options);
                    }
                ]
            ],
        ],
        'pager' => ['class' => LinkPager::className()],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
