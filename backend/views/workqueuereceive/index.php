<?php
$model = $dataProvider->getModels();
?>
<div style="height: 10px;"></div>
<div class="row">
    <div class="col-lg-3">
        <a href="#">
            <img src="../../backend/web/uploads/logo/narono_logo.png" width="100%" alt="">
        </a>
    </div>
</div>
<div style="height: 10px;"></div>
<div class="row">
    <div class="col-lg-6" style="vertical-align: middle;">
       <h3><span><i class="fa fa-user-circle"></i> </span>พนักงานขับรถ <span style="color: red"> นายทดสอบ คิวงาน</span></h3>
    </div>
    <div class="col-lg-6" style="text-align: right;">
        <button class="btn btn-info">แก้ไขข้อมูลส่วนตัว</button>
    </div>
</div><br />
<div class="row">
    <div class="col-lg-12" style="text-align: center;">
        <h5>รายการคิวงานของคุณ</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered">
          <thead>
          <tr>
              <th style="width: 10%;text-align: center;">ลำดับที่</th>
              <th>บริษัท</th>
              <th>ปลายทาง</th>
              <th style="width: 15%;text-align: center;">รายละเอียด</th>
          </tr>
          </thead>
            <tbody>
            <?php $x = 0;?>
             <?php foreach ($model as $value):?>
                 <?php $x +=1;?>
             <tr>
                 <td style="text-align: center;vertical-align: middle;"><?=$x?></td>
                 <td style="vertical-align: middle;">SCG</td>
                 <td style="vertical-align: middle;">ชุมพร</td>
                 <td style="text-align: center;">
                     <a href="<?=\yii\helpers\Url::to(['workqueuereceive/view','id'=>1],true)?>" target="_parent" class="btn btn-success">ดูรายละเอียด</a>
                 </td>
             </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
