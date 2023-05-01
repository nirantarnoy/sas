<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Quotationtitle $model */

$this->title = 'Update Quotationtitle: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quotationtitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quotationtitle-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
