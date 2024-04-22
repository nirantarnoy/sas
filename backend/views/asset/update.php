<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Asset */

$this->title = 'แก้ไขเครื่องจักร: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'เครื่องจักร', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="asset-update">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
        'model_asset_photo' => $model_asset_photo,
    ]) ?>

</div>
