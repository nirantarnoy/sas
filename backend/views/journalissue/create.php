<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Journalissue $model */

$this->title = 'Create Journalissue';
$this->params['breadcrumbs'][] = ['label' => 'Journalissues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journalissue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
