<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workorderassignwork $model */

$this->title = 'แก้ไขใบมอบหมายงานซ่อม: ' . $model->workorder_no;
$this->params['breadcrumbs'][] = ['label' => 'มอบหมายงานซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->workorder_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="workorderassignwork-update">


    <?= $this->render('_form', [
        'model' => $model,
        'work_photo' => $work_photo,
        'work_vdo' => $work_vdo,
    ]) ?>

</div>
