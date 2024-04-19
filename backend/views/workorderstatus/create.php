<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Workorderstatus */

$this->title = 'สร้างสถานะใบแจ้งซ่อม';
$this->params['breadcrumbs'][] = ['label' => 'สถานะใบแจ้งซ่อม', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workorderstatus-create">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
