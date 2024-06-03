<?php
$this->title = 'Todo List'
?>

    <h3>เครื่องจักร <?= \backend\models\Asset::findName($asset_id) ?></h3>
    <form action="<?= \yii\helpers\Url::to(['asset/addtasklist'], true) ?>" method="post">
        <input type="hidden" class="remove-list" name="remove_list" value="">
        <input type="hidden" name="asset_id" value="<?= $asset_id ?>">
        <div class="row">

            <div class="col-lg-12">
                <table class="table table-bordered" id="table-list">
                    <thead>
                    <tr>
                        <th style="width: 10%">ลำดับงาน</th>
                        <th>หัวข้อ TodoList</th>
                        <th>รายละเอียด</th>
                        <th style="text-align: center;width: 10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model): ?>
                        <?php foreach ($model as $value): ?>
                            <tr data-var="<?=$value->id?>">
                                <td>
                                    <input type="number" class="form-control line-seq-no" name="line_seq_no[]" value="<?=$value->seq_no?>">
                                    <input type="hidden" class="line-rec-id" name="line_rec_id[]" value="<?=$value->id?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-todolist" name="line_todolist[]" value="<?=$value->todo_name?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-detail" name="line_detail[]" value="<?=$value->todo_description?>">
                                </td>
                                <td style="text-align: center;width: 10%">
                                    <div class="btn btn-sm- btn-danger" onclick="removeline($(this))">ลบ</div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td>
                                <input type="number" class="form-control line-seq-no" name="line_seq_no[]" value="">
                                <input type="hidden" class="line-rec-id" name="line_rec_id[]" value="0">
                            </td>
                            <td>
                                <input type="text" class="form-control line-todolist" name="line_todolist[]" value="">
                            </td>
                            <td>
                                <input type="text" class="form-control line-detail" name="line_detail[]" value="">
                            </td>
                            <td style="text-align: center;width: 10%">
                                <div class="btn btn-sm- btn-danger" onclick="removeline($(this))">ลบ</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td style="text-align: center;width: 5%">
                            <div class="btn btn-sm btn-primary" onclick="addline($(this))">เพิ่ม</div>
                        </td>
                        <td colspan="2"></td>

                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class="row">
            <div class="col-log-3">
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </div>
    </form>


<?php
$js = <<<JS
var removelist = [];
$(function(){
    
});
function addline(e){
    var tr = $("#table-list tbody tr:last");
    
    if(tr.find(".line-seq-no").val() == ""){
        alert("กรุณากรอกลําดับงาน");
        return false;
    }
    if(tr.find(".line-todolist").val() == ""){
        alert("กรุณากรอกหัวข้องาน");
        return false;
    }
    var clone = tr.clone();
    clone.find(".line-rec-id").val("0");
    clone.find(".line-seq-no").val("");
    clone.find(".line-todolist").val("");
    clone.find(".line-detail").val("");

    tr.after(clone);
     
}
function removeline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removelist.push(e.parent().parent().attr("data-var"));
                $(".remove-list").val(removelist);
            }
            // alert(removelist);
            // alert(e.parent().parent().attr("data-var"));

            if ($("#table-list tbody tr").length == 1) {
                $("#table-list tbody tr").each(function () {
                    $(this).find(":text").val("");
                    $(this).find(".line-seq-no").val("");
                    $(this).find(".line-detail").val("")
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
}
JS;
$this->registerJs($js, static::POS_END);
?>