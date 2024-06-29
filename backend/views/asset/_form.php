<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Asset */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="asset-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'asset_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'asset_cat_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Assetcategory::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '--เลือกประเภท--'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'asset_brand_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'model_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'serail_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">

                <?= $form->field($model, 'department_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Department::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '--เลือกแผนก--'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'location_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Location::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '--เลือกที่ตั้ง--'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'supplier_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'supplier_contact')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'cost')->textInput() ?>
            </div>
            <div class="col-lg-4">
                <?php $model->recieve_date = $model->isNewRecord ? date('d/m/Y') : date('d/m/Y', strtotime($model->recieve_date)); ?>
                <?= $form->field($model, 'recieve_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
                    'pluginOptions' => [
                        'format' => 'dd/mm/yyyy'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-4">
                <?php $model->waranty_exp_date = $model->isNewRecord ? date('d/m/Y') : date('d/m/Y', strtotime($model->waranty_exp_date)); ?>
                <?= $form->field($model, 'waranty_exp_date')->widget(\kartik\date\DatePicker::className(), [
                    'value' => date('Y-m-d'),
                    'pluginOptions' => [
                        'format' => 'dd/mm/yyyy'
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'watt')->textInput() ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'electric_type')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'breaker_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <?php //echo $form->field($model, 'photo')->fileInput(['multiple'=>'multiple','id'=>'asset-photo','accept'=>'image/*']) ?>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'photo[]')->fileInput(['multiple' => 'multiple', 'id' => 'asset-photo', 'accept' => 'image/*']) ?>
            </div>
            <div class="col-lg-6">
                <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h5><b>รูปภาพเครื่องจักร</b></h5>
            </div>
        </div>
        <?php if ($model->isNewRecord): ?>
            <div class="row" style="padding: 1px;">
                <div class="col-lg-3"
                     style="border: 1px dashed grey;border-right: none;height: 150px;text-align: center;">

                </div>
                <div class="col-lg-3" style="border: 1px dashed grey;border-right: none;height: 150px;">

                </div>
                <div class="col-lg-3" style="border: 1px dashed grey;border-right: none;height: 150px;">

                </div>
                <div class="col-lg-3" style="border: 1px dashed grey;height: 150px;">

                </div>
            </div>
        <?php else: ?>
            <div class="row" style="padding: 1px;">
                <?php for ($x = 0; $x <= 3; $x++): ?>
                    <?php $loop = -1; ?>
                    <?php foreach ($model_asset_photo as $valuex): ?>
                        <?php $loop += 1; ?>
                        <?php if ($x == 0 && $loop == 0): ?>
                            <div class="col-lg-3"
                                 style="border: 1px dashed grey;border;height: 250px;text-align: center;">
                                <input type="hidden" name="old_photo" value=" <?= $valuex->photo ?>">
                                <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/location_photo/' . $valuex->photo ?>"
                                   target="_blank">
                                <img src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/asset_photo/' . $valuex->photo ?>"
                                     style="max-width: 150px;margin-top: 5px;" alt=""></a>
                            </div>
                            <?php continue 2; ?>
                        <?php elseif ($x == 1 && $loop == 1): ?>
                            <div class="col-lg-3"
                                 style="border: 1px dashed grey;border-right: none;height: 250px;text-align: center;">
                                <img src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/asset_photo/' . $valuex->photo ?>"
                                     style="max-width: 130px;margin-top: 5px;" alt="">
                            </div>
                            <?php continue 2; ?>
                        <?php elseif ($x == 2 && $loop == 2): ?>
                            <div class="col-lg-3"
                                 style="border: 1px dashed grey;border-right: none;height: 250px;text-align: center;">
                                <img src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/asset_photo/' . $valuex->photo ?>"
                                     style="max-width: 130px;margin-top: 5px;" alt="">
                            </div>
                            <?php continue 2; ?>
                        <?php elseif ($x == 3 && $loop == 3): ?>
                            <div class="col-lg-3" style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <img src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/asset_photo/' . $valuex->photo ?>"
                                     style="max-width: 130px;margin-top: 5px;" alt="">
                            </div>
                            <?php continue 2; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
        <br/>



        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$js = <<<JS
 // $("#asset-photo").change(function(){
 //    if (parseInt($(this).get(0).files.length) > 4){
 //                  alert("You are only allowed to upload a maximum of 4 files");
 //                  $(this).val(null);
 //    }
 // });
JS;
$this->registerJs($js, static::POS_END);
?>