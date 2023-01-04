<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fueldailyprice $model */

$this->title = 'ราคาน้ำมันประจำวัน: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ราคาน้ำมันประจำวัน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fueldailyprice-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
