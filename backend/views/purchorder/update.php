<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Purchorder $model */

$this->title = 'Update Purchorder: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Purchorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="purchorder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
