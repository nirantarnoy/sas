<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Cashrecord $model */

$this->title = 'Create Cashrecord';
$this->params['breadcrumbs'][] = ['label' => 'Cashrecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashrecord-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
