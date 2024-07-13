<?php
$this->title = 'ข้อความแชท';
$workorder_id = 0;
$workorder_no = '';
$workorder_by = '';
$workorder_date = '';
$workorder_status = '';
if ($model != null) {
    $workorder_id = $model->id;
    $workorder_no = $model->workorder_no;
    $workorder_by = \backend\models\User::findName($model->created_by);
    $workorder_date = date('d-m-Y H:i:s', strtotime($model->workorder_date));
    $workorder_status = \backend\models\Workorderstatus::findName($model->status);

}
$current_emp_id = \backend\models\User::findEmpId(\Yii::$app->user->id);
$my_workorder = \common\models\ViewEmpWorkAssign::find()->select(['workorder_id','workorder_status'])->where(['workorder_created_by' => \Yii::$app->user->id])->orFilterWhere(['emp_id' => $current_emp_id])->groupBy(['workorder_id'])->all();
$model_order_message = \common\models\WorkorderChat::find()->select(['workorder_id'])->where(['created_by' => \Yii::$app->user->id])->groupBy(['workorder_id'])->all();
?>
    <div class="row">
        <div class="col-lg-12">
            <input type="hidden" class="workorder-id" value="<?= $workorder_id ?>">
            <input type="hidden" class="user-id" value="<?= \Yii::$app->user->id ?>">

            <!--        <table style="width: 100%;border: 1px;">-->
            <!--            <tr style="background-color: royalblue;">-->
            <!--                <td colspan="2" style="width: 100%;height: 25px;color: white;padding: 15px;border-top-left-radius: 10px;border-top-right-radius: 10px;">ใบแจ้งซ่อม-->
            <!--                    <b>--><?php //= $model->workorder_no ?><!--</b></td>-->
            <!--            </tr>-->
            <!--           -->
            <!--            <tr>-->
            <!--                <td colspan="2" style="padding: 15px;text-align: center">-->
            <!--                    <div class="badge badge-secondary">--><?php //=date('d/m/Y')?><!--</div>-->
            <!--                </td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td style="width: 5%">-->
            <!--                    <div style="border-radius: 50px;background-color: lightgrey;height: 40px;width: 40px;text-align: center;padding: 8px;">-->
            <!--                        <i class="fa fa-user"></i></div>-->
            <!--                </td>-->
            <!--                <td style="width: 95%">-->
            <!--                    <div>--><?php //=date('H:i')?><!--</div>-->
            <!--                    <div style="height: 5px;"></div>-->
            <!--                    <div style="margin-top:5px;"><span style="background-color: lightgrey;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">สวัสดีครับ</span></div>-->
            <!--                    <div style="height: 10px;"></div>-->
            <!--                </td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td style="width: 5%">-->
            <!--                    <div style="border-radius: 50px;background-color: lightgrey;height: 40px;width: 40px;text-align: center;padding: 8px;">-->
            <!--                        <i class="fa fa-user"></i></div>-->
            <!--                </td>-->
            <!--                <td style="width: 95%;">-->
            <!---->
            <!--                    <div>--><?php //=date('H:i')?><!--</div>-->
            <!--                    <div style="height: 5px;"></div>-->
            <!--                    <div style="margin-top:5px;"><span style="background-color: lightgrey;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">สวัสดีครับ ต้องการให้ช่วยเรื่องอะไรครับ</span></div>-->
            <!--                    <div style="height: 10px;"></div>-->
            <!--                </td>-->
            <!---->
            <!--            </tr>-->
            <!--            <tr style="height: 350px;">-->
            <!--                <td></td>-->
            <!--            </tr>-->
            <!---->
            <!--        </table>-->
            <div id="chat-box-container">
                <div class="row">
                    <div class="col-lg-2" style="border-right: 1px solid lightgrey">
                        <div style="height: 50px;"><b>รายการแชท</b></div>
                        <!--                        <hr style="border: 1px solid gray;">-->
                        <?php if ($my_workorder != null): ?>
                            <?php foreach ($my_workorder as $value): ?>
                                <?php
                                $bg_active = '';
                                if ($value->workorder_id == $workorder_id) {
                                    $bg_active = 'background-color: lightblue;';
                                }
                                $workstatus_bg = 'badge-secondary';
                                if($value->workorder_status == 1){
                                    $workstatus_bg = 'badge-secondary';
                                }else if($value->workorder_status == 3){
                                    $workstatus_bg = 'badge-info';
                                }else if($value->workorder_status == 4){
                                    $workstatus_bg = 'badge-success';
                                }else if($value->workorder_status >= 5){
                                    $workstatus_bg = 'badge-danger';
                                }
                                ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <a href="index.php?r=workorderchat/chat&id=<?= $value->workorder_id ?>"
                                           class="chat-list" id="chat-list"
                                           style="border-radius: 5px;">

                                            <div style="width: 100%;<?= $bg_active ?>padding: 10px;border-radius: 10px">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <?= \backend\models\Workorder::findOrderNo($value->workorder_id) ?>
                                                    </div>
                                                    <div class="col-lg-4"><div class="badge <?= $workstatus_bg ?>"><?=\backend\models\Workorderstatus::findName($value->workorder_status)?></div></div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="text-align: center;color: lightgrey;">ไม่พบรายการ</div>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-10">
                        <div style="height: 40px;padding: 8px;"><b
                                    style="vertical-align: middle;">เลขใบแจ้งซ่อม #<?= $workorder_no ?></b><span> แจ้งโดย: <b><?= $workorder_by ?></b></span><span> วันที่แจ้ง: <b><?= $workorder_date ?></b></span><span> สถานะ: <b><?= $workorder_status ?></b></span>
                        </div>
                        <hr style="border: 1px solid lightgrey;">
                        <div id="chat-box" style="width: 100%;height: auto;max-height: 550px;overflow-y: scroll;">

                        </div>
                        <br/>
                        <table style="width: 100%;overflow: scroll">
                            <form id="form-message" action="" method="post" enctype="multipart/form-data">
                                <?php if ($workorder_no !='' || $workorder_by !=null): ?>
                                    <tr>
                                        <td style="width:90%">
                                            <div class="input-group">
                                                <div class="btn btn-secondary btn-click-add-file">แนบไฟล์</div>
                                                <input type="text" class="form-control message-for-send"
                                                       placeholder="กรอกข้อความของคุณที่นี่" name="message">
                                            </div>

                                        </td>

                                        <td>
                                            <!--                                        <div class="btn btn-primary" onclick="sendMessage()">ส่งข้อความ</div>-->
                                            <input type="submit" class="btn btn-primary" value="ส่งข้อความ">
                                            <input type="file" name="message_file" class="form-control file-for-send"
                                                   style="display: none">
                                            <input type="hidden" name="workorder_id" value="<?= $workorder_id ?>">
                                            <input type="hidden" name="user_id" value="<?= \Yii::$app->user->id ?>">
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="2"><span class="count-file-text"></span></td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>

            </div>

            <br/>

        </div>
    </div>


<?php
$url_to_get_messages = \yii\helpers\Url::to(['workorderchat/get-messages'], true);
$url_to_post_message = \yii\helpers\Url::to(['workorderchat/post-message'], true);
$url_to_update_messages = \yii\helpers\Url::to(['workorderchat/update-message'], true);
$js = <<<JS
$(function(){
    
    setInterval(loadMessages, 2000);
    loadMessages();
    
     const divId = "#chat-box";
            const storageKey = "scrollPosition_" + divId;

            // Retrieve the scroll position and set it
            if (localStorage.getItem(storageKey) !== null) {
                $(divId).scrollTop(localStorage.getItem(storageKey));
                localStorage.removeItem(storageKey);
                //alert();
            }

            // Save the scroll position before the page unloads
            $(window).on("beforeunload", function() {
                localStorage.setItem(storageKey, $(divId).scrollTop());
            });
    
   // if (localStorage.getItem("scrollPosition") !== null) {
   //              $("#chat-box").scrollTop(localStorage.getItem("scrollPosition"));
   //              localStorage.removeItem("scrollPosition");
   //          }
   //
   //          // Save the scroll position before the page unloads
   //          $(window).on("beforeunload", function() {
   //             // localStorage.setItem("scrollPosition", $(window).scrollTop());
   //            localStorage.setItem("scrollPosition", $("#chat-box").scrollTop());
   //          });
    // $("#chat-box").scroll(function(){
    //    var s = $("#chat-box");
    //    var pos = s.position();
    //    // var windowpos = $(window).scrollTop();
    //    // console.log('window is ' + windowpos);
    //    // console.log(pos);
    //    // chatboxScroll(); 
    // });
    
    $(".btn-click-add-file").click(function(){
       $(".file-for-send").trigger('click'); 
       setInterval(checkHasFile,2000);
    });
    
    $("#form-message").on("submit", function(e){
        e.preventDefault();
        var formData = new FormData(this);
        
        var workorder_id = $(".workorder-id");
        var user_id = $(".user-id");
        var message = $(".message-for-send").val("");

    if (workorder_id && message) {
        $.ajax({
            dataType: 'html',
            url: '$url_to_post_message',
            type: 'POST',
            contentType: false,
            processData: false,
            // data: {
            //     workorder_id: workorder_id,
            //     user_id: user_id,
            //     message: message
            // },
            data: formData,
            success: function(response) {
                loadMessages();
                document.getElementById('message').value = '';
            }
        });
    } else {
        alert('Please enter both username and message.');
    }
    });
});
function checkHasFile(){
   var file_count = $(".file-for-send").get(0).files.length;
   if(file_count > 0){
       $(".count-file-text").text(file_count + " ไฟล์");
   }else{
       $(".count-file-text").text("");
   }
}
function chatboxScroll(){
   // alert();
   console.log();
}
function loadMessages() {
    var workorder_id = $(".workorder-id").val();
    var user_id = $(".user-id").val();
    if(workorder_id != null && user_id != null){
         $.ajax({
        dataType: 'html',
        url: '$url_to_get_messages',
        type: 'POST',
        data: {
            'workorder_id': workorder_id,
            'user_id': user_id
        },
        success: function(response) {
            $('#chat-box').html(response);
          //  var myscroll = $('#chat-box');
          //  var pos = myscroll.position();
           // myscroll.scrollTop(myscroll[0].scrollHeight);
            
            updateMessageStatus(workorder_id,user_id);
        }
    });
    }
   
}

function updateMessageStatus(workorder_id, user_id) {
    if(workorder_id !=null && user_id != null){
        $.ajax({
        dataType: 'html',
        url: '$url_to_update_messages',
        type: 'POST',
        data: {
            'workorder_id': workorder_id,
            'user_id': user_id
        },
        success: function(response) {
           console.log(response);
        }
    })
    }
    
    
}

function sendMessage() {
   // const username = document.getElementById('username').value;
   // const message = document.getElementById('message').value;
    
    var workorder_id = $(".workorder-id");
    var user_id = $(".user-id");
    var message = $(".message-for-send").val();

    if (workorder_id && message) {
        $.ajax({
            dataType: 'html',
            url: '$url_to_post_message',
            type: 'POST',
            data: {
                workorder_id: workorder_id,
                user_id: user_id,
                message: message
            },
            success: function(response) {
                loadMessages();
                document.getElementById('message').value = '';
            }
        });
    } else {
        alert('Please enter both username and message.');
    }
}

// Load messages every 2 seconds
// setInterval(loadMessages, 2000);

// Initial load
// loadMessages();

JS;
$this->registerJs($js, static::POS_END);
?>