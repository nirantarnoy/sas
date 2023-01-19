<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var backend\models\Car $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="car-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'plate_no')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <!-- <?= $form->field($model, 'car_type_id')->textInput() ?> -->
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'brand_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\CarBrand::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--ยี่ห้อรถ--',
//                        'onchange' => 'showid($(this))',
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'car_type_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\CarType::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--ประเภทรถ--'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'type_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\CarcatType::asArrayObject(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '--ต่อพ่วง--',
                        'onchange' => 'showtail($(this))',
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'tail_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Car::find()->where(['type_id' => 2])->all(), 'id', 'name'),
                    'options' => [
                        'class' => 'tail-id',
                        'placeholder' => '--ต่อพ่วง--',
                        'disabled' => 'true',
                    ],

                ])->label('หาง') ?>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'horse_power')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'fuel_type')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\FuelType::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--ประเภทน้ำมัน--'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'company_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Company::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--บริษัท--'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-4">
                <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>

            </div>
        </div>
        <?php if ($model->doc == '' || $model->doc == null): ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'doc')->fileInput(['maxlength' => true]) ?>
                </div>
            </div>
        <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <label for="">เอกสารรถ</label>
                <table class="table table-striped table-bordered">

                    <tbody>
                    <tr>
                        <td><?=$model->doc?></td>
                        <td><a href="<?=\Yii::$app->getUrlManager()->getBaseUrl() . '/uploads/car_doc/'.$model->doc ?>" target="_blank">ดูเอกสาร</a></td>
                        <td>
                            <div data-var="<?=$model->doc ?>" class="btn btn-danger" onclick="removedoc($(this))" >ลบ</div>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <?php endif; ?>

        <!-- <?= $form->field($model, 'company_id')->textInput() ?> -->


        <!-- <?= $form->field($model, 'status')->textInput() ?> -->


        <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?> -->


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <form id="form-delete-doc" action="<?=\yii\helpers\Url::to(['car/removedoc'],true)?>" method="post">
        <input type="hidden" name="car_id" value="<?=$model->id?>">
        <input type="hidden" class="car-doc-delete" name="doc_name" value="">
    </form>

<?php
$js = <<<JS
$(function (){
    
});
function showtail(e){
    var id = e.val();
    if(id == 1){
        $(".tail-id").prop("disabled","");
    }else{
        $(".tail-id").prop("disabled","disabled");
    }
}
function removedoc(e){
    var doc_name = e.attr("data-var");
    $(".car-doc-delete").val(doc_name);
    if(doc_name != ''){
        $("form#form-delete-doc").submit();
    }
}

function showid(e){
    var id = e.val();
    alert(e.val());
}

JS;
$this->registerJs($js, static::POS_END);

?>