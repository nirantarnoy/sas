<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Recieptrecord $model */

$this->title = 'Create Recieptrecord';
$this->params['breadcrumbs'][] = ['label' => 'Recieptrecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recieptrecord-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
