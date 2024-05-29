<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workorderassignwork $model */

$this->title = 'Update Workorderassignwork: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Workorderassignworks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="workorderassignwork-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
