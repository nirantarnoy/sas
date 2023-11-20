<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Cashrecord $model */

$this->title = 'Update Cashrecord: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cashrecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cashrecord-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
