<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Purchorder $model */

$this->title = 'Create Purchorder';
$this->params['breadcrumbs'][] = ['label' => 'Purchorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchorder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
