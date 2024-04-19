<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Location */

$this->title = 'แก้ไขข้อมูลที่ตั้ง: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลที่ตั้ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="location-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
