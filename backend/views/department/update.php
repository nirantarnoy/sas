<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Department */

$this->title = 'แก้ไขแผนก: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'แผนก', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="department-update">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
