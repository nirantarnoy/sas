<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Routeplan $model */

$this->title = 'Create Routeplan';
$this->params['breadcrumbs'][] = ['label' => 'Routeplans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routeplan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
