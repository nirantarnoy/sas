<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workordercause $model */

$this->title = 'แก้ไขสาเหตุปัญหา: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'สาเหตุปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="workordercause-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
