<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workqueue $model */

$this->title = 'แก้ไขคิวงาน: ' . $model->work_queue_no;
$this->params['breadcrumbs'][] = ['label' => 'Workqueues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->work_queue_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="workqueue-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
