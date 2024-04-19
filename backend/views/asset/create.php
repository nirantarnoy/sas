<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Asset */

$this->title = 'สร้างเครื่องจักร';
$this->params['breadcrumbs'][] = ['label' => 'เครื่องจักร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-create">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
