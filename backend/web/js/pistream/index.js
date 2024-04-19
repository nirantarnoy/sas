$(document).ready(() => {
    $(".search-date").datepicker({todayHighlight: true, format: 'dd/mm/yyyy'})

    $("form").submit(() => {
        return $(document.activeElement).attr('type') == 'submit';
    })

    setTimeout(() => {
        checkEmptySTREAMData()
    }, 1800000)
})

const showCopy = (e) => {
    $.getJSON('?r=pi-stream-assign/checkdatatoday').then((res) => {
        if (res > 0) {
            // checkEmptySTREAMData()
            // e.preventDefault()
            $("#copyModal").modal("show")
        } else {
            $("#copyModal").modal("show")
        }
    })
}

const showStreamInfo = (e) => {
    const stream = e.attr('data-var')
    const assign_id = e.attr('data-x')
    const assign_date = e.attr('data-y')
    const lvl_cnt = e.attr('data-id')
    const stream_status = e.parent().find('.line-stream-status').val()

    const setText = () => {
        const txt = $(".stream_status").text()
        if (txt == 'Canceled') $(".btn-cancel-prod").text('เริ่มการผลิต')
    }

    if (stream == "" || stream != null) {
        $.getJSON("?r=pi-stream-assign/getstreamdata", {streamid: stream}, (res) => {
            // console.log(res)
            $(".stream_no").text(res['NAME'])
            $(".stream_lv_count").text(lvl_cnt)
            $(".cur-stream").val(stream)
            $(".stream_status").text(stream_status)
            $(".work-date").val(assign_date)
            $(".c-work-date").html(assign_date)

            setText()
            showLevel(stream, assign_id, lvl_cnt, assign_date)
            showWorker(stream, assign_date)
            $("#streaminfoModel").modal("show")
        })
    }
}

const showWorker = (stream_no, assign_date) => {
    $.getJSON("?r=pi-stream-assign/showworker-all", {
        stream: stream_no, transdate: assign_date
    }, (res) => {
        $("table.table-emp-stream tbody").html(res)
    })
}

const showLevel = (stream_no, assign_id, lvl_qty, trans_date) => {
    if (lvl_qty > 0) {
        $.getJSON("?r=pi-stream-assign/showlevel-all-mod", {
            stream: stream_no, assignid: assign_id, lvlqty: lvl_qty, transdate: trans_date
        }, (res) => {
            $(".mainprod").html(res['sPage'])
            $(".secprod").html(res['secPage'])
            $(".workpage").html(res['workPage'])
        })
    }
}

const updateProd = () => {
    const status = $(".stream_status").text()
    if (status != 'Canceled') {
        cancelProd()
    } else {
        const c_stream = $(".cur-stream").val()
        const c_date = $(".search-date").val()

        if (c_stream != "") {
            Swal.fire({
                title: 'ต้องการเริ่มการผลิตใช่หรือไม่?', showCancelButton: true, confirmButtonText: "Yes",
            }).then((result) => {
                if (result.value == true) {
                    $.post('?r=pi-stream-assign/updateprod', {'streamid': c_stream, 'proddate': c_date}, (res) => {
                        if (res > 0) {
                            $(".btn-cancel-prod").hide()
                            location.reload()
                        }
                    })
                }
            })
        }
    }
}
const cancelProd = () => {
    const c_stream = $(".cur-stream").val()
    const c_date = $(".search-date").val()

    if (c_stream != "") {
        Swal.fire({
            title: 'ต้องการยกเลิกการผลิตเตานี้ใช่หรือไม่?', showCancelButton: true, confirmButtonText: "Yes",
        }).then((result) => {
            if (result.value == true) {
                $.post('?r=pi-stream-assign/cancelprod', {'streamid': c_stream, 'proddate': c_date}, (res) => {
                    if (res > 0) {
                        $(".btn-cancel-prod").hide()
                        location.reload()
                    }
                })
            }
        })
    }
}

const createChange = (e) => {
    const its = e.closest("tr")
    const stream_no = $(".cur-stream").val()
    const trans_date = $(".work-date").val()
    const recid = its.find(".recid").val()
    const stream_lv = e.text()

    function showLevelchange(stream_no, trans_date, stream_lv, recid) {
        $.getJSON('?r=pi-stream-assign/showlevel-change-mod', {
            'streamid': stream_no,
            'transdate': trans_date,
            'level': stream_lv,
            'shift': its.find(".streamsh").val(),
            'linestatus': its.find(".streamat").val()
        }, (res) => {
            if (res != null && res.length > 0) {
                $(".origin-id").val(recid)
                $(".changepage").html(res)
            }
        })
    }

    showLevelchange(stream_no, trans_date, stream_lv, recid)
    $(".selected-stream-change").val(stream_no)
    $("#changeitemModal").modal("show")
}

const forceChange = (e) => {
    const its = e.closest("tr")
    const recid = its.find(".recid").val()

    $.post("?r=pi-stream-assign/force-change", {assignid: recid}, (res) => {
        location.reload()
    })
}

const getItem = (e) => {
    let prodid = e.val()

    if (prodid != "" && prodid.length == 8) {
        $.getJSON("?r=pi-stream-assign/getitemdata", {prodid: prodid}, (res) => {
            const rec = e.closest('tr')
            const item = res[0]
            if (item === undefined) {
                rec.find('.line-item').val(null)
                rec.find('.line-brand').val(null)
                rec.find('.line-mold').val(null)
                rec.find('.line-prodqty').val(null)
                rec.find('.line-prodqty-show').val(null)
                rec.find('.line-qty').val(null)
            } else {
                rec.find('.line-item').val(item['itemid'])
                rec.find('.line-brand').val(item['brand'])
                rec.find('.line-mold').val(item['mold'])
                rec.find('.line-prodqty').val(item['prod_qty'])
                rec.find('.line-prodqty-show').val(item['prod_qty_show'])
                rec.find('.line-qty').focus().select()
            }
        })
    }
}

const empChange = (e) => {
    const worker = e.attr("data-var")
    const worker_name = e.closest('tr').find('td:eq(1)').text()
    const worker_line_id = e.attr("data-id")
    const stream_no = $(".cur-stream").val()

    $('#timepicker').datetimepicker({
        format: 'HH:mm'
    })

    if (stream_no != '' && worker != '') {
        $(".c-emp").val(worker_name)
        $(".selected-worker-line-id").val(worker_line_id)
        $(".selected-stream").val(stream_no)
        $("#empchangeModal").modal("show")
    }
}
const updateStatus = (id) => {
    if (id) {
        $.post("?r=pi-stream-assign/updatelinestatus", {id: id}, (res) => {
            location.reload()
        })
    }
}

let checkEmptySTREAMData = () => {
    $.post("?r=pi-stream-assign/checkemptydata", (res) => {
        location.reload()
    })
}