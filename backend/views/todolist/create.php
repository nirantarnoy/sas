<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Todolist $model */

$this->title = 'สร้าง Todolist';
$this->params['breadcrumbs'][] = ['label' => 'Todolist', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todolist-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => null,
    ]) ?>

</div>
