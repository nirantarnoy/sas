<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Workorderassignwork $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Workorderassignworks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="workorderassignwork-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'workorder_no',
            'workorder_date',
            'asset_id',
            'assign_emp_id',
            'work_recieve_date',
            'work_assign_date',
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'problem_text',
            'stop6',
            'abnormal',
            'view_point',
            'work_cause_id',
            'weak_point_analysis',
            'cause_risk_id',
            'factor_risk_1',
            'factor_risk_2',
            'factor_risk_3',
            'factor_total',
            'factor_risk_final',
        ],
    ]) ?>

</div>
