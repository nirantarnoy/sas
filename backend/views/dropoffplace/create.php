<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DropoffPlace $model */

$this->title = 'สร้างจุดรับ';
$this->params['breadcrumbs'][] = ['label' => 'จุดรับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dropoff-place-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
