<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customerinvoice $model */

$this->title = 'แก้ไขใบวางบิล: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'วางบิล', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="customerinvoice-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
