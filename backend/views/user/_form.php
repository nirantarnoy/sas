<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-11">
                    <?= $form->field($model, 'username')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-11">
                    <?= $form->field($model, 'usergroup_id')->widget(\kartik\select2\Select2::className(),[
                            'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Usergroup::find()->all(),'id','name'),
                        'options' => [
                                'placeholder'=>'--เลือก--'
                        ]
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-11">
                    <?= $form->field($model, 'emp_ref_id')->widget(\kartik\select2\Select2::className(),[
                        'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Employee::find()->all(),'id',function($data){
                            return $data->fname.' '.$data->lname;
                        }),
                        'options' => [
                            'placeholder'=>'--เลือก--'
                        ]
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-11">
                    <?= $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className())->label(false) ?>
                </div>
            </div>
          <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-11">
                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <?php echo $form->field($model, 'roles')->checkboxList($model->getAllRoles(),[

                'separator' => '<br>',
                'itemOptions' => [
                    'class' => 'roles'
                ]
            ])->label('<label style="color: red">สิทธิ์การเข้าถึงระบบ</label>') ?>
        </div>
    </div>





    <?php ActiveForm::end(); ?>

</div>
