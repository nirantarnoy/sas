<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customergroup $model */

$this->title = 'Create Customergroup';
$this->params['breadcrumbs'][] = ['label' => 'Customergroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customergroup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
