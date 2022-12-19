<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Routeplan $model */

$this->title = 'แก้ไขจัดการปลายทาง: ' . $model->des_name;
$this->params['breadcrumbs'][] = ['label' => 'Routeplans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="routeplan-update">


    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line,
    ]) ?>

</div>
