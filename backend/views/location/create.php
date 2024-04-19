<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Location */

$this->title = 'สร้างข้อมูลที่ตั้ง';
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลที่ตั้ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = '/ '.$this->title;
?>
<div class="location-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
