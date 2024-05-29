<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Workorderassignwork $model */

$this->title = 'Create Workorderassignwork';
$this->params['breadcrumbs'][] = ['label' => 'Workorderassignworks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workorderassignwork-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
