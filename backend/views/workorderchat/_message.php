<?php
$this->title = 'ข้อความแชท';
$workorder_id = 0;
$workorder_no = '';
if ($model != null) {
    $workorder_id = $model->id;
    $workorder_no = $model->workorder_no;

}
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
                        <?php if ($model_order_message != null): ?>
                            <?php foreach ($model_order_message as $value): ?>
                            <?php
                            $bg_active = '';
                            if($value->workorder_id == $workorder_id){
                                $bg_active = 'background-color: lightblue;';
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="index.php?r=workorderchat/chat&id=<?= $value->workorder_id ?>" class="chat-list" id="chat-list"
                                       style="border-radius: 5px;">
                                        <div style="width: 100%;<?=$bg_active?>padding: 10px;border-radius: 10px" >
                                           <?= \backend\models\Workorder::findOrderNo($value->workorder_id) ?>
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
                                    style="vertical-align: middle;">เลขใบแจ้งซ่อม #<?= $workorder_no ?></b></div>
                        <hr style="border: 1px solid lightgrey;">
                        <div id="chat-box" style="width: 100%;height: 750px;overflow-y: scroll;">

                        </div>
                        <br/>
                        <table style="width: 100%;">
                            <tr>
                                <td style="width:90%"><input type="text" class="form-control message-for-send"
                                                             placeholder="กรอกข้อความของคุณที่นี่">
                                </td>
                                <td>
                                    <div class="btn btn-primary" onclick="sendMessage()">ส่งข้อความ</div>
                                </td>
                            </tr>
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
});
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