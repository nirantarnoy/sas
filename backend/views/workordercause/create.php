<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workordercause $model */

$this->title = 'สร้างสาเหตุปัญหา';
$this->params['breadcrumbs'][] = ['label' => 'สาเหตุปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workordercause-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
