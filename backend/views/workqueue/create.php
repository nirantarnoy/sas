<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workqueue $model */

$this->title = 'Create Workqueue';
$this->params['breadcrumbs'][] = ['label' => 'Workqueues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workqueue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
