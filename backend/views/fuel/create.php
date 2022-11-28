<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fuel $model */

$this->title = 'Create Fuel';
$this->params['breadcrumbs'][] = ['label' => 'Fuels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fuel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
