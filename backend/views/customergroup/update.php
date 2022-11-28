<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customergroup $model */

$this->title = 'Update Customergroup: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customergroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customergroup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
