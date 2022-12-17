<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Routeplan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="routeplan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'route_plan_id')->textInput() ?>

    <?= $form->field($model, 'dropoff_place_id')->textInput() ?>

    <?= $form->field($model, 'dropoff_qty')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
