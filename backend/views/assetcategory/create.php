<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Assetcategory */

$this->title = 'สร้างประเภทเครื่องจักร';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทเครื่องจักร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assetcategory-create">
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
