<?php
//$browser = get_browser(null, true);
//print_r($browser);

use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;

HighchartsAsset::register($this);

$prod_qty = 0;
?>
<input type="hidden" class="prod-daily-target" value="<?= $target_qty ?>">
<input type="hidden" class="prod-daily-target-ptvm" value="<?= $target_qty_ptvm ?>">
<input type="hidden" class="prod-daily-sum-qty" value="">
<div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12" style="background-color: ;">
                <div class="container">
                    <div class="row" style="background-color: black;color: #00e765">
                        <div class="col-lg-12" style="text-align: center">
                            <div style="font-weight: bold;font-size: 20px;">ยางนอก จกย. วันที่ <span><?= date('d-m-Y') ?></span> กะA
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: left">
                            <div class="row">
                                <div class="col-lg-3" style="text-align: left">
                                    <div style="font-weight: bold;font-size: 25px;color: ">พนักงาน</div>
                                </div>
                                <div class="col-lg-6">
                                    <div style="font-weight: bold;font-size: 25px;"><span class="prod-target"
                                                                                          style="color: #ec4844"><?= number_format($qty_emp_daily) . ' ' ?></span>คน
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: left">
                            <div class="row">
                                <div class="col-lg-3" style="text-align: left">
                                    <div style="font-weight: bold;font-size: 25px;">เป้า</div>
                                </div>
                                <div class="col-lg-6">
                                    <div style="font-weight: bold;font-size: 25px;"><span class="prod-target"
                                                                                          style="color: #ec4844"><?= number_format($target_qty) ?></span>
                                        เส้น
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: left">
                            <div class="row">
                                <div class="col-lg-3" style="text-align: left">
                                    <div style="font-weight: bold;font-size: 25px;">ผลิตได้</div>
                                </div>
                                <div class="col-lg-6">
                                    <div style="font-weight: bold;font-size: 25px;"><span class="total-sum-qty"
                                                                                          style="color: green">0</span>
                                        เส้น
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: center">
                            <div style="font-weight: bold;font-size: 30px;"><span class="total-sum-per"
                                                                                  style="color: red"></span></div>
                            <div id="show-chart"></div>
                            <?php
                            //                    echo Highcharts::widget([
                            //                        'options' => [
                            //                            'chart' => [
                            //                                'type' => 'bar',
                            //                            ],
                            //
                            //                            'title' => ['text' => 'เปอร์เซ็นต์การผลิต'],
                            //
                            //                            'xAxis' => [
                            //                                'categories' => ['ยอด']
                            //                            ],
                            //                            'yAxis' => [
                            //                                'title' => ['text' => '']
                            //                            ],
                            //                            'series' => [
                            //                                ['name' => 'ผลิตจริง', 'data' => [(int)$prod_qty]],
                            //                                ['name' => 'แผน', 'data' => [(int)$target_qty]]
                            //                            ]
                            //                        ]
                            //                    ]);
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="content-trans">
                    <table class="table" width="100%" style="font-size: 25px">
                        <thead>
                        <tr style="background-color: #0e5b44;color: white;width: 100%">
                            <th style="width: 15%;text-align: center">เตา</th>
                            <th style="width: 42%;text-align: center">รหัสนึ่ง</th>
                            <th style="width: 13%;text-align: center">สั่ง</th>
                            <th style="width: 13%;text-align: center">ผลิต</th>
                            <th style="width: 13%;text-align: center">ค้าง</th>
                        </tr>
                        </thead>
                    </table>
                    <table class="table table-bordered table-striped table-list fixed_header"
                           style="font-size: 45px;height: 1000px;overflow: hidden">
                        <thead>
                        <!--                <tr style="background-color: #255985;color: white;width: 100%">-->
                        <!--                    <th style="width: 36%;text-align: center">เตา</th>-->
                        <!--                    <th style="text-align: center">รหัสนึ่ง</th>-->
                        <!--                    <th style="width: 15%;text-align: center">สั่ง</th>-->
                        <!--                    <th style="width: 15%;text-align: center">ผลิต</th>-->
                        <!--                    <th style="width: 15%;text-align: center">ค้าง</th>-->
                        <!--                </tr>-->
                        </thead>
                        <tbody class="list-body" style="width: 100%">

                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12" style="background-color: ;">
                <div class="container">
                    <div class="row" style="background-color: black;color: #e0a800">
                        <div class="col-lg-12" style="text-align: center">
                            <div style="font-weight: bold;font-size: 20px;">ยางนอก มตซ. วันที่ <span><?= date('d-m-Y') ?></span> กะA
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: left">
                            <div class="row">
                                <div class="col-lg-3" style="text-align: left">
                                    <div style="font-weight: bold;font-size: 25px;color: ">พนักงาน</div>
                                </div>
                                <div class="col-lg-6">
                                    <div style="font-weight: bold;font-size: 25px;"><span class="prod-target"
                                                                                          style="color: #ec4844"><?= number_format($qty_emp_daily_ptvm) . ' ' ?></span>คน
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: left">
                            <div class="row">
                                <div class="col-lg-3" style="text-align: left">
                                    <div style="font-weight: bold;font-size: 25px;">เป้า</div>
                                </div>
                                <div class="col-lg-6">
                                    <div style="font-weight: bold;font-size: 25px;"><span class="prod-target"
                                                                                          style="color: #ec4844"><?= number_format($target_qty_ptvm) ?></span>
                                        เส้น
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: left">
                            <div class="row">
                                <div class="col-lg-3" style="text-align: left">
                                    <div style="font-weight: bold;font-size: 25px;">ผลิตได้</div>
                                </div>
                                <div class="col-lg-6">
                                    <div style="font-weight: bold;font-size: 25px;"><span class="total-sum-qty-ptvm"
                                                                                          style="color: green">0</span>
                                        เส้น
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12" style="text-align: center">
                            <div style="font-weight: bold;font-size: 30px;"><span class="total-sum-per-ptvm"
                                                                                  style="color: red"></span></div>
                            <div id="show-chart"></div>
                            <?php
                            //                    echo Highcharts::widget([
                            //                        'options' => [
                            //                            'chart' => [
                            //                                'type' => 'bar',
                            //                            ],
                            //
                            //                            'title' => ['text' => 'เปอร์เซ็นต์การผลิต'],
                            //
                            //                            'xAxis' => [
                            //                                'categories' => ['ยอด']
                            //                            ],
                            //                            'yAxis' => [
                            //                                'title' => ['text' => '']
                            //                            ],
                            //                            'series' => [
                            //                                ['name' => 'ผลิตจริง', 'data' => [(int)$prod_qty]],
                            //                                ['name' => 'แผน', 'data' => [(int)$target_qty]]
                            //                            ]
                            //                        ]
                            //                    ]);
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="content-trans">
                    <table class="table" width="100%" style="font-size: 25px">
                        <thead>
                        <tr style="background-color: #255985;color: white;width: 100%">
                            <th style="width: 15%;text-align: center">เตา</th>
                            <th style="width: 42%;text-align: center">รหัสนึ่ง</th>
                            <th style="width: 13%;text-align: center">สั่ง</th>
                            <th style="width: 13%;text-align: center">ผลิต</th>
                            <th style="width: 13%;text-align: center">ค้าง</th>
                        </tr>
                        </thead>
                    </table>
                    <table class="table table-bordered table-striped table-list-ptvm fixed_header"
                           style="font-size: 45px;height: 1000px;overflow: hidden">
                        <thead>
                        <!--                <tr style="background-color: #255985;color: white;width: 100%">-->
                        <!--                    <th style="width: 36%;text-align: center">เตา</th>-->
                        <!--                    <th style="text-align: center">รหัสนึ่ง</th>-->
                        <!--                    <th style="width: 15%;text-align: center">สั่ง</th>-->
                        <!--                    <th style="width: 15%;text-align: center">ผลิต</th>-->
                        <!--                    <th style="width: 15%;text-align: center">ค้าง</th>-->
                        <!--                </tr>-->
                        </thead>
                        <tbody class="list-body-ptvm" style="width: 100%">

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

<!--<div class="show-footer" style='bottom: 0px;height: 100px;background-color: #258faf;width: 100%;position: fixed'>-->
<!--    ABM035(เป่าเจ๊าะ)-->
<!--</div>-->
<!--<div class="slide-left" style='bottom: 0px;height: 100px;background-color: #258faf;width: 100%;position: fixed'>-->
<!---->
<!--</div>-->
<div class="main-slide event-slide-right">
    <!--    <p>It s better to burn out, than to fade away.</p>-->
</div>
<?php
$url_to_find_item = \yii\helpers\Url::to(['site/proddailybyprod'], true);
$url_to_find_item_ptvm = \yii\helpers\Url::to(['site/proddailybyprod-ptvm'], true);
$url_to_find_event = \yii\helpers\Url::to(['site/showevent'], true);
$js = <<<JS
function animatethis(targetElement, speed) {
    var scrollWidth = $(targetElement).get(0).scrollHeight;
    var clientWidth = $(targetElement).get(0).clientHeight;
    $(targetElement).animate({ scrollTop: scrollWidth - clientWidth },
    {
        duration: speed,
        complete: function () {
            targetElement.animate({ scrollTop: 0 },
            {
                duration: speed,
                complete: function () {
                    animatethis(targetElement, speed);
                }
            });
        }
    });
};

 $(function(){
     animatethis($('.list-body'), 75000);
     animatethis($('.list-body-ptvm'), 75000);
     //jQuery.trigger({ type: 'keypress', which: '123'});
    // setTimeout(function(){ location.reload(); }, 15000);
    //   $("#show-chart").highcharts();
    //  var div = $('div.content-trans');
    //     var scroller = setInterval(function(){
    //         var pos = div.scrollTop();
    //         div.scrollTop(++pos);
    //     }, 1000); 
    
  // scrollToBottom();
     getdata();
     getevent();
     setInterval(function(){ 
         getdata();
     }, 75000);
     setInterval(function(){ 
         getevent();
     }, 55000);
     to_right();
 });
 
function change_left() {
    $('div').removeClass('slide-right').addClass('slide-left');
}

function change_right() {
    $('div').removeClass('slide-left').addClass('slide-right');
   // change_title();
}

function to_left() {
setInterval(change_left, 10000);
};

function to_right() {
    setInterval(change_right, 20000);
};

function scrollToBottom() {
   var scrollBottom = Math.max($('.table-list').height() - $('.content-trans').height() + 20, 0);
   $('.table-list').scrollTop(scrollBottom);
}

function getdata(){
    $.ajax({
              'type':'post',
              'dataType': 'json',
              'async': false,
              'url': "$url_to_find_item",
              'data': {},
              'success': function(data) {
                  //  alert(data);
                  if(data.length > 0){
                     // alert();
                       $(".table-list tbody").html('');
                       $(".table-list tbody").html(data[0]['html']);
                       $(".total-sum-qty").html(addCommas(data[0]['prod_sum_qty']));
                       $(".prod-daily-sum-qty").val(data[0]['prod_sum_qty']);
                       var real_qty =  data[0]['prod_sum_qty'];
                       var target =  $(".prod-daily-target").val();
                       if(target > 0){
                           var qty_per = parseFloat((real_qty * 100))/parseFloat(target);
                           $(".total-sum-per").html(parseFloat(qty_per).toFixed(1)+"%")
                       }
                  }
                  
                 }
    });
    $.ajax({
              'type':'post',
              'dataType': 'json',
              'async': false,
              'url': "$url_to_find_item_ptvm",
              'data': {},
              'success': function(data) {
                  //  alert(data);
                  if(data.length > 0){
                     // alert();
                       $(".table-list-ptvm tbody").html('');
                       $(".table-list-ptvm tbody").html(data[0]['html']);
                       $(".total-sum-qty-ptvm").html(addCommas(data[0]['prod_sum_qty']));
                       //$(".prod-daily-sum-qty").val(data[0]['prod_sum_qty']);
                        var real_qty =  data[0]['prod_sum_qty'];
                        var target =  $(".prod-daily-target-ptvm").val();
                       if(target > 0){
                           var qty_per = parseFloat((real_qty * 100))/parseFloat(target);
                           $(".total-sum-per-ptvm").html(parseFloat(qty_per).toFixed(1)+"%")
                       }
                  }
                  
                 }
    });
}
function getevent(){
    $(".event-slide-right").html('');
    $.ajax({
              'type':'post',
              'dataType': 'html',
              'async': false,
              'url': "$url_to_find_event",
              'data': {},
              'success': function(data) {
                  console.log('read');
                  //  alert(data);
                   $(".event-slide-right").append(data);
                 }
        });
}
function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
 }
JS;

$this->registerJs($js, static::POS_END);
?>
