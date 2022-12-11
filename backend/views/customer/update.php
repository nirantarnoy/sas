<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Customer $model */

$this->title = 'แก้ไข้ลูกค้า: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">



    <?= $this->render('_form', [
        'model' => $model,
        'model_line'=>$model_line,
        'model_contact_line'=>$model_contact_line,
    ]) ?>

</div>
