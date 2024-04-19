<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Assetcategory */

$this->title = 'แก้ไขประเภทเครื่องจักร: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทเครื่องจักร', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="assetcategory-update">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
