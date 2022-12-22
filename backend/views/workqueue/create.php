<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workqueue $model */

$this->title = 'สร้างคิวงาน';
$this->params['breadcrumbs'][] = ['label' => 'คิวงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workqueue-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
