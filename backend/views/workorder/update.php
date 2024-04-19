<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorder */

$this->title = 'แก้ไชใบแจ้งซ่อม: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="workorder-update">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
