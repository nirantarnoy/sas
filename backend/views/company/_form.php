<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Company $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'status')->textInput() ?> -->
    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>

    <?php if ($model->doc == '' || $model->doc == null): ?>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'doc')->fileInput(['maxlength' => true]) ?>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <label for="">เอกสารแนบ</label>
                <table class="table table-striped table-bordered">

                    <tbody>
                    <tr>
                        <td><?=$model->doc?></td>
                        <td><a href="<?=\Yii::$app->getUrlManager()->getBaseUrl() . '/uploads/company_doc/'.$model->doc ?>" target="_blank">ดูเอกสาร</a></td>
                        <td>
                            <div data-var="<?=$model->doc ?>" class="btn btn-danger" onclick="removedoc($(this))" >ลบ</div>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>

    <?php endif; ?>


    <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<form id="form-delete-doc" action="<?=\yii\helpers\Url::to(['company/removedoc'],true)?>" method="post">
    <input type="hidden" name="company_id" value="<?=$model->id?>">
    <input type="hidden" class="company-doc-delete" name="doc_name" value="">
</form>

<?php
$js = <<<JS
$(function (){
    
});

function removedoc(e){
    var doc_name = e.attr("data-var");
    $(".company-doc-delete").val(doc_name);
    if(doc_name != ''){
        $("form#form-delete-doc").submit();
    }
}
JS;
$this->registerJs($js, static::POS_END);

?>