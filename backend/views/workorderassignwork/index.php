<?php

use backend\models\Workorderassignwork;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\WorkorderassignworkSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->title = 'จ่ายงานซ่อม';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workorderassignwork-index">

    <br/>
    <?php
    if (\Yii::$app->session->hasFlash('msg-success')) {
        echo '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> สําเร็จ!</h4>';
        echo \Yii::$app->session->getFlash('msg-success');
        echo '</div>';
    }
    ?>
    <div class="row">

        <div class="col-lg-2" style="text-align: right">
            <form id="form-perpage" class="form-inline" action="<?= Url::to(['workorderassignwork/index'], true) ?>"
                  method="post">
                <div class="form-group">
                    <label>แสดง </label>
                    <select class="form-control" name="perpage" id="perpage">
                        <option value="20" <?= $perpage == '20' ? 'selected' : '' ?>>20</option>
                        <option value="50" <?= $perpage == '50' ? 'selected' : '' ?> >50</option>
                        <option value="100" <?= $perpage == '100' ? 'selected' : '' ?>>100</option>
                    </select>
                    <label> รายการ</label>
                </div>
            </form>
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => "{items}\n{summary}\n<div class='text-center'>{pager}</div>",
        'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
        'showOnEmpty' => false,
        //    'bordered' => true,
        //     'striped' => false,
        //    'hover' => true,
        'id' => 'product-grid',
        //'tableOptions' => ['class' => 'table table-hover'],
        'emptyText' => '<div style="color: red;text-align: center;"> <b>ไม่พบรายการไดๆ</b> <span> เพิ่มรายการโดยการคลิกที่ปุ่ม </span><span class="text-success">"สร้างใหม่"</span></div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'text-align:center;'],'contentOptions' => ['style' => 'text-align:center;']],
            [
                'attribute' => 'workorder_no',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->workorder_no, ['workorderassignwork/view', 'id' => $data->id]);
                }
            ],
//            'workorder_date',
            [
                'attribute' => 'workorder_date',
                'value' => function ($data) {
                    return date('d-m-Y H:i:s', strtotime($data->workorder_date));
                }
            ],

            [
                'attribute' => 'created_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->created_by);
                }
            ],
            [
                'label' => 'ผ่านมา(วัน)',
                'value' => function ($data) {
                    $date1 = date_create(date('Y-m-d H:i:s', strtotime($data->workorder_date)));
                    $date2 = date_create(date('Y-m-d H:i:s'));
                    $line_time_use = date_diff($date1, $date2);
                    return $line_time_use->format('%d วัน');
                }
            ],
            [
                'attribute' => 'asset_id',
                'value' => function ($data) {
                    return \backend\models\Asset::findAssetCatName($data->asset_id);
                }
            ],
            [
                'attribute' => 'asset_id',
                'value' => function ($data) {
                    return \backend\models\Asset::findName($data->asset_id);
                }
            ],
            [
                'attribute' => 'asset_id',
                'label' => 'Serial No.',
                'value' => function ($data) {
                    return \backend\models\Asset::findAssetSerialNo($data->asset_id);
                }
            ],
            [
                'attribute' => 'asset_id',
                'label' => 'สถานที่',
                'value' => function ($data) {
                    return \backend\models\Asset::findLocationName($data->asset_id);
                }
            ],
            [
                'attribute' => 'status',
                'label' => 'สถานะ',
                'format' => 'raw',
                'value' => function ($data) {
                    $workstatus_bg = 'badge-secondary';
                    if($data->status == 1){
                        $workstatus_bg = 'badge-secondary';
                    }else if($data->status == 3){
                        $workstatus_bg = 'badge-info';
                    }else if($data->status == 4){
                        $workstatus_bg = 'badge-success';
                    }else if($data->status >= 5){
                        $workstatus_bg = 'badge-danger';
                    }
                    return '<div class="badge ' . $workstatus_bg . '">' . \backend\models\Workorderstatus::findName($data->status) . '</div>';
                }
            ],

            // 'assign_emp_id',
            //'work_recieve_date',
            //'work_assign_date',
            //'status',
            //'created_at',

            //'updated_at',
            //'updated_by',
            [
                'attribute' => 'problem_text',
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['style' => 'text-align: center;'],
                'format' => 'raw',
                'value' => function ($data) {
                    return '<div class="" data-var="' . $data->problem_text . '" data-var2="' . $data->workorder_no . '" onclick="showText($(this))"><i class="fa fa-question-circle"></i> </div>';
                }
            ],
            [
                'label' => 'ผู้ซ่อม',
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['style' => 'text-align: center;'],
                'format' => 'raw',
                'value' => function ($data) {
                    $is_has = checkHasAssignEmployee($data->id);
                    $text_style = 'text-danger';
                    if ($is_has) {
                        $text_style = 'text-success';
                    }
                    return '<div class="" data-var="' . $data->id . '" onclick="showfindemployee($(this))"><i class="fa fa-user '.$text_style.'"></i> </div>';
                }
            ],
            //'stop6',
            //'abnormal',
            //'view_point',
            //'work_cause_id',
            //'weak_point_analysis',
            //'cause_risk_id',
            //'factor_risk_1',
            //'factor_risk_2',
            //'factor_risk_3',
            //'factor_total',
            //'factor_risk_final',
            [

                'header' => 'ประเมินงานซ่อม',
                'headerOptions' => ['style' => 'text-align:center;', 'class' => 'activity-view-link',],
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: center'],
                'template' => '{evaluatework}',
                'buttons' => [

                    'evaluatework' => function ($url, $data, $index) {
                        $options = [
                            'title' => Yii::t('yii', 'ประเมิณ'),
                            'aria-label' => Yii::t('yii', 'ประเมิณ'),
                            'data-pjax' => '0',
                        ];
                        $_has = checkHasEvaluatework($data->id);
                        $btn_style = 'btn-default';
                        if ($_has) {
                            $btn_style = 'btn-success';
                        }
                        if($data->status == 4){
                            return Html::a(
                                '<span class="fas fa-check-circle btn btn-xs ' . $btn_style . '"></span>', $url, $options);
                        }

                    },
//                    'update' => function ($url, $data, $index) {
//                        $options = array_merge([
//                            'title' => Yii::t('yii', 'แก้ไข'),
//                            'aria-label' => Yii::t('yii', 'แก้ไข'),
//                            'data-pjax' => '0',
//                            'id' => 'modaledit',
//                        ]);
//                        return Html::a(
//                            '<span class="fas fa-edit btn btn-xs btn-default"></span>', $url, [
//                            'id' => 'activity-view-link',
//                            //'data-toggle' => 'modal',
//                            // 'data-target' => '#modal',
//                            'data-id' => $index,
//                            'data-pjax' => '0',
//                            // 'style'=>['float'=>'rigth'],
//                        ]);
//                    },

                ]
            ],
        ],
        'pager' => ['class' => LinkPager::className()],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<div id="findModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-lg-12">
                        <b>รายชื่อพนักงาน</b>
                    </div>
                </div>
            </div>
            <form action="<?= Url::to(['workorderassignwork/saveassignemployee'], true) ?>" method="post">
                <div class="modal-body">
                    <!--                <div class="row">-->
                    <!--                    <div class="col-lg-12" style="text-align: right">-->
                    <!--                        <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx" disabled><i-->
                    <!--                                    class="fa fa-check"></i> ตกลง-->
                    <!--                        </button>-->
                    <!--                        <button type="button" class="btn btn-default" data-dismiss="modal"><i-->
                    <!--                                    class="fa fa-close text-danger"></i> ปิดหน้าต่าง-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <div style="height: 10px;"></div>
                    <input type="hidden" name="work_order_id" class="assign-workorder-id" value="">
                    <input type="hidden" name="removelist" class="remove-list" value="">
                    <table class="table table-bordered table-striped table-find-list" width="100%">
                        <thead>
                        <tr>
                            <th>พนักงาน</th>
                            <th style="text-align: center;">-</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                                <div class="btn btn-primary" onclick="addempline($(this))">เพิ่ม</div>
                            </td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>

                    <br/>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-success" data-dismiss="modalx"><i
                                class="fa fa-check"></i> บันทึก
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="problemModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-lg-12">
                        <b>เลขที่ใบแจ้งซ่อม # <span class="show-workorder-no"></span></b>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <p class="problem-text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                </button>
            </div>
        </div>

    </div>
</div>


<?php
function checkHasAssignEmployee($workorder_id)
{
    $res = 0;
    $model = \common\models\WorkorderAssign::find()->where(['workorder_id' => $workorder_id])->count();
    if ($model) {
        $res = $model;
    }
    return $res;
}

function checkHasEvaluatework($workorder_id)
{
    $res = 0;
    $model = \common\models\WorkorderEvaluate::find()->where(['workorder_id' => $workorder_id])->count();
    if ($model) {
        $res = $model;
    }
    return $res;
}

?>

<?php
$url_to_find_employee = \yii\helpers\Url::to(['workorderassignwork/findemployee'], true);
$url_to_save_assign_employee = \yii\helpers\Url::to(['workorderassignwork/saveassignemployee'], true);
$url_to_delete_emp_item = '';
$js = <<<JS
var selecteditem = [];
var removelist = [];
$(function(){
   
    var xx = $(".slip-print").val();
     //   alert(xx);
     if(xx !="empty"){
         myPrint();
     }
     
     
     // $("form#form-submit-select-employee").on("submit", function(e){
     //     e.preventDefault();
//         var formData = new FormData(this);
//         alert('xx');
//         var workorder_id = $(".work-assign-submit-id").val();
//         alert(workorder_id);
//         if (workorder_id) {
//             alert();
//              $.ajax({
//                  dataType: 'html',
//                  url: '$url_to_save_assign_employee',
//                  type: 'POST',
//                  contentType: false,
//                  processData: false,
//                        // data: {
//                        //     workorder_id: workorder_id,
//                        //     user_id: user_id,
//                        //     message: message
//                        // },
//                  data: formData,
//                  success: function(response) {
//                      
//                  }
//              });
//         }
   //  });
     
     
});
function addempline(e){
    var tr = $(".table-find-list tbody tr:last");
    var clone = tr.clone();
    clone.closest("tr").find(".line-emp-id").val('-1').change();
    tr.after(clone);
    
}
function deleteline(e){
    if($(".table-find-list tbody tr").length == 1){
        e.closest("tr").find(".line-emp-id").val('-1').change();
    }else{
        if(confirm("ต้องการลบรายการนี้ใช่หรือไม่ ?")){
            e.parent().parent().remove();
        }
    }
}
function showText(e){
    var text = e.attr("data-var");
    var workorder_no = e.attr("data-var2");
    if(text !='' && workorder_no!=''){
        $(".problem-text").html(text);
        $(".show-workorder-no").html(workorder_no);
        $("#problemModal").modal("show");
    }
    
}
function myPrint(){
        var getMyFrame = document.getElementById('iFramePdf');
        getMyFrame.focus();
        getMyFrame.contentWindow.print();
}

function showfindemployee(e){
    var id = e.attr("data-var");
  //alert(id);
  if(id > 0){
    $.ajax({
      type: 'post',
      dataType: 'html',
      url:'$url_to_find_employee',
      async: false,
      data: {'workorder_id': id },
      success: function(data){
       //   alert(data);
          $(".table-find-list tbody").html(data);
          $(".assign-workorder-id").val(id);
          $("#findModal").modal("show");
          disableselectitemNew();
      },
      error: function(err){
          alert(err);
      }
      
    });  
  }
}

function addselecteditem(e) {
        var id = e.attr('data-var');
        var work_assign_id = e.closest('tr').find('.line-find-work-assign-id').val();
        var work_assign_line_id = e.closest('tr').find('.line-find-work-assign-line-id').val();
        var emp_code = e.closest('tr').find('.line-find-emp-code').val();
        var emp_name = e.closest('tr').find('.line-find-emp-name').val();
        var emp_position_name = e.closest('tr').find('.line-find-emp-position').val();
        if (id) {
           // alert(id);
            // if(checkhasempdaily(id)){
            //     alert("คุณได้ทำการจัดรถให้พนักงานคนนี้ไปแล้ว");
            //     return false;
            // }
            if (e.hasClass('btn-outline-success')) {
                e.removeClass('btn-outline-success');
                e.addClass('btn-success');
                
                
                var obj = {};
                obj['work_assign_id'] = work_assign_id;
                obj['work_assign_line_id'] = work_assign_line_id;
                obj['emp_id']  = id;
                obj['emp_code'] = emp_code;
                obj['emp_name'] = emp_name;
                obj['emp_position_name'] = emp_position_name;
                obj['selected'] = 1;
                selecteditem.push(obj);
                
                disableselectitemNew();
                console.log(selecteditem);
            } else {
                e.removeClass('btn-success');
                e.addClass('btn-outline-success');
                if(selecteditem.length > 0){
                    selecteditem.forEach(function(item){
                        if(item.emp_id == id){
                            selecteditem.splice(selecteditem.indexOf(item), 1);
                        }
                    });
                    
                    // $.each(selecteditem, function (i, el) {
                    //     if (this.id == id) {
                    //         var qty = this.qty;
                    //         var product_group_id = this.product_group_id;
                    //         selecteditem.splice(i, 1);
                    //         selectedorderlineid.splice(i,1);
                    //         deleteorderlineselected(product_group_id, qty); // update data in selected list
                    //         console.log(selecteditemgroup);
                    //         caltablecontent(); // refresh table below
                    //     }
                    // });
                }
                disableselectitemNew();
                 console.log(selecteditem);
            }
        }
      
    }
    function deleteorderlineselected(id, qty){
       $.each(selecteditemgroup, function(i, el){
           if(this.product_group_id == id && this.qty > 0){
               this.qty = (this.qty - qty);
               if(this.qty <= 0){
                   selecteditemgroup.splice(i,1);
               }
               
           }
       });
    }
    // function caltablecontent(){
    // var html = '';
    // $.each(selecteditem, function(i,el){    
    //      html +='<tr>';
    //      html +='<td><input type="hidden" name="work_assign_id[]" class="work-assign-id" value="'+ this.work_assign_id +'"></td>';
    //      html +='<td><input type="hidden" name="employee_id[]" class="work-employee-id" value="'+ this.emp_id +'"></td>';
    //      html +='<td><input type="hidden" name="employee_selected[]" class="work-employee-selected" value="'+ this.selected +'"></td>';
    //      html +='</tr>';
    // });
    //        
    //   $(".table-after-list tbody").html(html);
    // }
    function disableselectitem() {
        if (selecteditem.length > 0) {
            $(".btn-emp-selected").prop("disabled", "");
            $(".btn-emp-selected").removeClass('btn-outline-success');
            $(".btn-emp-selected").addClass('btn-success');
        } else {
            $(".btn-emp-selected").prop("disabled", "disabled");
            $(".btn-emp-selected").removeClass('btn-success');
            $(".btn-emp-selected").addClass('btn-outline-success');
        }
    }
     function disableselectitemNew() {
           
           if(selecteditem.length >0){
               $(".btn-emp-selected").prop("disabled", "");
               $(".btn-emp-selected").removeClass('btn-outline-success');
               $(".btn-emp-selected").addClass('btn-success');
           }else{
               $(".btn-emp-selected").prop("disabled", "disabled");
               $(".btn-emp-selected").removeClass('btn-success');
               $(".btn-emp-selected").addClass('btn-outline-success');
           }
    }
    $(".btn-emp-selected").click(function () {
        if(selecteditem.length > 0){
            var work_assign_id = 0;
             var html = '';
                $.each(selecteditem, function(i,el){    
                     work_assign_id = this.work_assign_id;
                     html +='<tr>';
                     html +='<td><input type="hidden" name="work_assign_id[]" class="work-assign-id" value="'+ this.work_assign_id +'"></td>';
                     html +='<td><input type="hidden" name="employee_id[]" class="work-employee-id" value="'+ this.emp_id +'"></td>';
                     html +='<td><input type="hidden" name="employee_selected[]" class="work-employee-selected" value="'+ this.selected +'"></td>';
                     html +='</tr>';
                });
                  alert(html);
                $(".table-after-list tbody").html(html);
                
                if($(".table-after-list tbody tr").length > 0){
                    $("form#form-submit-select-employee").find(".work-assign-submit-id").val(work_assign_id);
                    $("form#form-submit-select-employee").submit();
                    $(".select-employee-submit").trigger('click');
                }
        }
    });

  
  function check_dup(prod_id){
      var _has = 0;
      $("#table-list tbody tr").each(function(){
          var p_id = $(this).closest('tr').find('.line-car-emp-id').val();
         // alert(p_id + " = " + prod_id);
          if(p_id == prod_id){
              _has = 1;
          }
      });
      return _has;
  }
  
  function removeline(e){
     
          if(confirm('ต้องการลบรายการนี้ใช่หรือไม่ ?')){
              if($(".table-find-list tbody tr").length > 0)
              {
                 if($(".table-find-list tbody tr").length == 1){
                  
                   var del_id = e.parent().parent().attr("data-var");
                   removelist.push(del_id);
                   e.closest("tr").find(".line-emp-id").val('-1').change();
                   e.closest("tr").find(".line-work-assign-id").val('');
                 }else{
                    var del_id = e.parent().parent().attr("data-var");
                   // alert(del_id);
                   removelist.push(del_id);
                   e.parent().parent().remove();
               } 
              }else{
                   alert();
                   e.closest("tr").find(".line-emp-id").val('-1').change();
              }
               
          }
          
          $(".remove-list").val(removelist);
  }  
  
  // function checkallreadyseleled(order_id){
  //     selectedorderid.forEach((item){
  //        if(item.code == order_id){
  //            alert();
  //        } 
  //     });
  // }

JS;

$this->registerJs($js, static::POS_END);
?>
