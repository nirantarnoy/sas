<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Solvetitle $model */

$this->title = 'สร้างวิธีแก้ปัญหา';
$this->params['breadcrumbs'][] = ['label' => 'วิธีแก้ปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solvetitle-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
