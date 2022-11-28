<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fuel $model */

$this->title = 'Update Fuel: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fuels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fuel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
