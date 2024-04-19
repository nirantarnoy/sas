$(document).ready(() => {
    const Toast = Swal.mixin({toast: true, position: 'top-center', showConfirmButton: false, timer: 3000})
    const btnShowAlert = $("#btn-show-alert")
    const tagScan = $(".tag-num-scan")

    btnShowAlert.click(() => {
        let msg = $(".alert-msg").val()
        let msg_err = $(".alert-msg-error").val()

        if (msg != "" && typeof msg != "undefined")
            Toast.fire({type: 'success', title: msg})
        if (msg_err != "" && typeof msg_err != "undefined")
            Toast.fire({type: 'error', title: msg_err})
    })

    $(".trans-date").datepicker({todayHighlight: true, format: 'dd/mm/yyyy'})

    btnShowAlert.trigger("click")

    tagScan.focus()
    tagScan.change(() => {
        let tag_no = tagScan.val().toUpperCase()
        let trans_date = $(".trans-datex").val()

        if (tag_no != "" && tag_no != 100) {
            $(".tag-num").val(tag_no)
            $.getJSON('?r=pi-daily-receive/finddata', {'tag_no': tag_no, 'trans_date': trans_date}, (res) => {
                let showTable = $("table.table-show-data tbody")
                showTable.html("")

                if (res != "") {
                    showTable.html(res)
                    $(".no-data").hide()
                } else {
                    showTable.html("")
                    $(".no-data").show()
                }
            }, (err) => {
                alert(err)
            })
        } else if (tag_no == 100) {
            if ($("table.table-show-data tbody tr").length > 0) {
                $(".tag-no").val($(".tag-num").val())
                $(".tran-date-data").val(trans_date)
                $("form#form-tag-data").submit()
            }
        }
        $(".tag-num-scan").focus().select();
    })
})

const changeItem = (e) => {
    const id = e.attr('data-var')

    if (id > 0) {
        if (confirm('ต้องการเปลี่ยนรหัสนึ่งตามนี้ใช่หรือไม่')) {
            $.post('?r=pi-daily-receive/changeitem', {id: id}, (res) => {
                if (res != "")
                    showAlert('success', res)
            })
        }
    }
}

const showAlert = (al_type, msg) => {
    const Toast = Swal.mixin({toast: true, position: 'top-center', showConfirmButton: false, timer: 3000})

    Toast.fire({type: al_type, title: msg})
}

const addFail = (e) => {
    const selected = e.val()
    const id = e.parent().parent().attr('data-key')
    let qty = 0

    if (selected != "") qty = 0
    else qty = 20

    if (id) {
        $.post("?r=pi-daily-receive/addfail", {id: id, qty: qty, failcode: selected}, (res) => {
            if (res == 1) {
                showAlert('success', 'อัพเดทรายการสำเร็จ')
                e.parent().closest('tr').find('.line-qty').val(qty)
            } else {
                showAlert('error', 'พบข้อผิดพลาด');
            }

            if (qty == 1) {
                e.parent().parent().css('background-color', 'white')
            } else {
                e.parent().parent().css('background-color', 'pink')
            }

            $(".tag-num-scan").focus()
        })
    }
}

const addWorkend = (e) => {
    const selected = e.val()
    const id = e.parent().parent().attr('data-key')

    if (id) {
        $.post("?r=pi-daily-receive/addworkend", {id: id, endtime: selected}, (res) => {
            if (res == 1) {
                showAlert('success', 'อัพเดทรายการสำเร็จ')
            } else {
                showAlert('error', 'พบข้อผิดพลาด')
            }

            $(".tag-num-scan").focus()
        })
    }
}

const recDelete = (e) => {
    const id = e.attr('data-var')
    if (id > 0) {
        swal({
            title: "ต้องการลบรายการใช่หรือไม่",
            type: "warning",
            showConfirmButton: true,
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, () => {
            $.post("?r=pi-daily-receive/delete-line", {id: id}, (res) => {
                if (res == 1)
                    showAlert('success', 'ทำรายการสำเร็จ')
                else
                    showAlert('error', 'พบข้อผิดพลาด')
                location.reload()
            })
        })
    }
}

const qtyChange = (e) => {
    const qty = e.val()
    const id = e.parent().parent().attr('data-key')

    if (id) {
        $.post("?r=pi-daily-receive/qty-change", {id: id, qty: qty}, (res) => {
            if (res == 1) {
                showAlert('success', 'อัพเดทรายการสำเร็จ')
            } else {
                showAlert('error', 'พบข้อผิดพลาด')
            }

            $(".tag-num-scan").focus()
        })
    }
}