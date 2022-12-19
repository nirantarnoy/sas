<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DropoffPlace $model */

$this->title = 'จแก้ไขุดรับ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dropoff Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dropoff-place-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
