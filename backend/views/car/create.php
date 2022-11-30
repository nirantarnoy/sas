<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Car $model */

$this->title = 'สร้างรถ';
$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
