<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Quotationtitle $model */

$this->title = 'Create Quotationtitle';
$this->params['breadcrumbs'][] = ['label' => 'Quotationtitles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotationtitle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
