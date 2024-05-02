<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorder */

$this->title = $model->workorder_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="workorder-view">

    <br>

    <p>
        <?= Html::a('แก้ไช', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'workorder_no',
            [
                'attribute' => 'workorder_date',
                'value' => function ($data) {
                    return date('d/m/Y', strtotime($data->workorder_date));
                },
            ],
            [
                'attribute' => 'asset_id',
                'value' => function ($data) {
                    return \backend\models\Asset::findName($data->asset_id);
                }
            ],
            'assign_emp_id',
            //'work_recieve_date',
            //'work_assign_date',
            [
                'attribute' => 'created_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->created_by);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($data) {
                    $status_name = \backend\models\Workorderstatus::findName($data->status);
                    if($data->status == 1){
                        return '<div class="badge badge-success">'.$status_name.'</div>';
                    }
                }
            ],
            'work_recieve_date',
            'work_assign_date',
 //           'status',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
        ],
    ]) ?>

</div>
