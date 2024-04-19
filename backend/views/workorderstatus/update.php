<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorderstatus */

$this->title = 'แก้ไขสถานะใบแจ้งซ่อม: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'สถานะใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="workorderstatus-update">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
