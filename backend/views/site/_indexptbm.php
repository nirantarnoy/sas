<?php

use yii\helpers\Url;


$total_receive = 0;
$modelx = \common\models\USRNPTBREC::find()->where(['MACHINENO'=>$model->MACHINENO,'PRODID'=>$model->PRODID])->sum('QTY');
if($modelx){
    $total_receive = $modelx;
}

?>
    <input type="hidden" class="current-recid" value="<?=$model->RECID?>">
<div style="background-color: white">
    <table class="table" style="background-color: #1aa67d;border: none;">
        <tr>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold;color: black">เครื่อง
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold; color: white;">
                    <?=$model->MACHINENO?>
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold;color: black">
                    ใบสั่งผลิต
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold; color: white;"><?=$model->PRODID?>
                </div>
            </td>
        </tr>
        <tr>

            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold;color: black">
                    รหัสประกอบ
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold; color: white;"><?=$model->ITEMID?>
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold;color: black">
                    สั่งผลิต
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold; color: white;"><?=number_format($model->QTY_PER_DAY)?>
                </div>
            </td>
        </tr>
        <tr>

            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold;color: black">
                    พนักงาน
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold; color: white;"><?=$model->EMPNO?>
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold;color: black">
                    สถานะ
                </div>
            </td>
            <td>
                <div class="col-lg-6" style="text-align: left;font-size: 20px;font-weight: bold; color: white;">ปกติ
                </div>
            </td>
        </tr>

    </table>
    <div>
        <button class="btn btn-primary" id="btn-add-qty">บันทึกส่งยอด</button>
    </div>


    <hr/>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;font-size: 20px;font-weight: bold;color: black">ยอดผลิต</div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;font-size: 100px;font-weight: bold; color: #0c525d;"><?=number_format($total_receive)?></div>
    </div>
</div>

<div id="modal-receive" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
<!--            <div class="modal-header">-->
<!--                <div class="row" style="width: 100%">-->
<!--                    <div class="col-lg-9">-->
<!--                        <h4><i class="fa fa-arrow-alt-circle-up text-success"></i> บันทึกรับยอด</h4>-->
<!--                    </div>-->
<!--                    <div class="col-lg-3" align="right">-->
<!--                        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <form action="<?= Url::to(['site/prodrecadd'], true) ?>" method="post">
                <input type="hidden" class="selected-trans-id" name="selected_trans_id" value="">
                <div class="modal-body">

                    <table style="width: 100%">
                        <tr>
                            <td style="width: 25%"></td>
                            <td>
                                <input type="text" name="receive_qty" class="form-control receive-qty" style="padding: 15px;background-color: #0c525d;color: white;font-size: 35px;text-align: center;height: 50px;" value="0" readonly>
                            </td>
                            <td style="width: 25%"></td>
                        </tr>
                    </table>
                    <br />
                    <table style="width: 100%">
                        <tr>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="1" onclick="calqty($(this))">1</div></td>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="2" onclick="calqty($(this))">2</div></td>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="3" onclick="calqty($(this))">3</div></td>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="4" onclick="calqty($(this))">4</div></td>
                        </tr>
                        <tr>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="5" onclick="calqty($(this))">5</div></td>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="6" onclick="calqty($(this))">6</div></td>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="7" onclick="calqty($(this))">7</div></td>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="8" onclick="calqty($(this))">8</div></td>
                        </tr>
                        <tr>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="9" onclick="calqty($(this))">9</div></td>
                            <td><div class="btn btn-default btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="0" onclick="calqty($(this))">0</div></td>
                            <td colspan="2"><div class="btn btn-danger btn-block" style="padding: 10px;height: 55px;font-weight: bold" data-var="100" onclick="calqty($(this))">Clear</div></td>
                        </tr>
                    </table>

                    <br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-lg">บันทึกข้อมูล</button>
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-close text-danger"></i> ยกเลิก
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$js=<<<JS
  $(function (){
      $("#btn-add-qty").click(function(){
         // alert();
         $(".receive-qty").val(0);
         $("#modal-receive").modal();
         var c_recid = $(".current-recid").val();
         $(".selected-trans-id").val(c_recid);
      });
  });

  function calqty(e){
      var old_qty = $(".receive-qty").val();
      var qty = old_qty;
      var key_data = e.attr('data-var');
      if(old_qty == 0 && key_data == qty ){
          
      }else{
          if(qty==0){
               qty = key_data;
          }else{
              qty = ''+qty+key_data;
          }
          
         
      }
      if(key_data == 100){
          qty = 0;
      }
      
      $(".receive-qty").val(qty);
  }
JS;
$this->registerJs($js, static::POS_END);
?>