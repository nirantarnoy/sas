<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DropoffPlace $model */

$this->title = 'จแก้ไขจุดรับ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'จุดรับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="dropoff-place-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
