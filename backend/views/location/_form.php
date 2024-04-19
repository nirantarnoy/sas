<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-9">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'department_id')->widget(\kartik\select2\Select2::className(),[
                    'data'=>\yii\helpers\ArrayHelper::map(\backend\models\Department::find()->all(),'id','name'),
                    'options' => [
                            'placeholder'=>'--เลือกแผนก--'
                    ],
                    'pluginOptions' => [
                            'allowClear'=>true,
                    ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'pos_x')->textInput(['class'=>'form-control loc-pos-x']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'pos_y')->textInput(['class'=>'form-control loc-pos-y']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="well text-center">
                <?= Html::img('',['style'=>'width:100px;','class'=>'img-rounded']); ?>
            </div>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'loc_photo')->fileInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?php echo $form->field($model, 'status')->widget(Switchery::className())->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <br />
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <h3><b>ระบุตำแหน่งที่ตั้งเครื่องจักร</b></h3>
        </div>
    </div>

    <div id="location-canvas" style="text-align: center;background-color: lightgrey;padding-bottom: 50px;vertical-align: middle;border-radius: 10px;">
<!--        <div id="loc-marker" style="width: 50px;height: 50px;background-color: red;text-align: center;padding-top:10px;color: white;position: relative;z-index: 10000;top:140px;left: 250px;border-radius: 50px">-->
<!--            ที่ตั้ง-->
<!--        </div>-->
        <div id="loc-marker" style="width: 50px;height: 50px;position: relative;z-index: 10000;top:140px;left: 250px">
            <i class="fa fa-map-marker fa-2x" style="color: red;" aria-hidden="true"></i>
        </div>
        <img id="image-canvas" style="position: relative" src="<?=Yii::$app->request->baseUrl.'/uploads/images/loc_image.png'?>" alt="">
    </div>
    <div>
        <span class="xy-position"></span>
    </div>

</div>
<?php
$js=<<<JS
  $(function(){
      var init_pos = $("#image-canvas").position();
      $("#loc-marker").offset({top: init_pos.top ,left: init_pos.left});
      
      var edit_pos_x = $(".loc-pos-x").val();
      var edit_pos_y = $(".loc-pos-y").val();
      
      if(edit_pos_x > 0 || edit_pos_y > 0){
          $("#loc-marker").offset({top: parseFloat(edit_pos_y-10).toFixed(4) ,left: parseFloat(edit_pos_x-18).toFixed(4)});
      }
      
      
      $("#image-canvas").click(function(e){
          e.preventDefault();
          var this_positon = $(this).position();
           var offset = $(this).offset();
          // var x = e.clientX - offset.left;
          // var y = e.clientY - offset.top;
          //  var x = e.clientX;
          //  var y =  e.clientY;
          // var pos = "X:" + x + " Y:"+ offset.top;
          
          // var elm = $(this);
          // var xPos = e.pageX - elm.offset().left;
          // var yPos = e.pageY - elm.offset().top;
          
          // console.log(this_positon.top);
          // console.log(e.pageY);

         // $(".xy-position").html(e.pageY);
          $(".loc-pos-x").val(parseFloat(e.pageX).toFixed(4));
          $(".loc-pos-y").val(parseFloat(e.pageY).toFixed(4));
          $("#loc-marker").offset({top: parseFloat(e.pageY-40).toFixed(4) ,left: parseFloat(e.pageX-18).toFixed(4)});
          
      });
      
      
      $(".loc-pos-x").change(function(e){
          var x_value = $(this).val();
          var y_value = $(".loc-pos-y").val();
          $("#loc-marker").offset({top: (y_value -40) ,left: (x_value-18)});
      });
      $(".loc-pos-y").change(function(e){
          var y_value = $(this).val();
          var x_value = $(".loc-pos-x").val();
          $("#loc-marker").offset({top: (y_value -40) ,left: (x_value-18)});
      });
  });
JS;
$this->registerJs($js,static::POS_END);
?>