<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Solvetitle $model */

$this->title = 'แก้ไขวิธีแก้ปัญหา: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'วิธีแก้ปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="solvetitle-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
