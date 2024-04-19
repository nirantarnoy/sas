<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */

$this->title = 'แก้ไขพนักงาน: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'พนักงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="employee-update">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
