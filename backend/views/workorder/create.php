<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorder */

$this->title = 'สร้างใบแจ้งซ่อม';
$this->params['breadcrumbs'][] = ['label' => 'ใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workorder-create">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
        'work_photo' => null,
        'work_vdo' => null,
    ]) ?>

</div>
