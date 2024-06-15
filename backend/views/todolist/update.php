<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Todolist $model */

$this->title = 'แก้ไข Todolist: ' . $model->todolist_name;
$this->params['breadcrumbs'][] = ['label' => 'Todolists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->todolist_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="todolist-update">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => $model_line
    ]) ?>

</div>
