const api = '?r=qcinspection-pi'

const showAlert = (show_type, msg) => {
    const Toast = Swal.mixin({
        toast: true, position: 'top-center', showConfirmButton: false, timer: 3000
    });

    Toast.fire({
        type: show_type, title: msg
    })
}

$(document).ready(() => {
    $('.trans-date').datepicker({
        todayHighlight: true, format: 'dd/mm/yyyy', autoclose: true
    })

    $(".line-problem-code").select2({theme: "bootstrap4"})
})

const savenoneQC = (e) => {
    const id = e.attr('data-var')

    if (id) {
        swal({
            title: "ต้องการบันทึกผลไม่ผ่านใช่หรือไม่",
            type: 'warning',
            showCancelButton: true,
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, () => {
            $.post(api + '/savenoneqc', {id: id}, (res) => {
                if (res == 1) {
                    showAlert('success', 'ทำรายการสำเร็จ')
                    location.reload();
                } else {
                    showAlert('error', 'พบข้อผิดพลาด')
                    location.reload();
                }
            })
        })
    }
}

const updateProblem = (e) => {
    const id = e.parent().parent().attr('data-var')
    const problem = e.closest('tr').find('.line-problem-code').val()
    const worker = e.closest('tr').find('.line-worker').val()
    const ass_no = e.closest('tr').find('.line-assno-code').val()

    if (id > 0) {
        $.post(api + '/updateqc', {id: id, problem: problem, worker: worker, assno: ass_no}, (res) => {
            if (res == 1) showAlert('success', 'บันทึกรายการสำเร็จ')
            else showAlert('error', 'พบข้อผิดพลาด')
            location.reload()
        })
    }
}

const changeQTY = (e) => {
    const id = e.parent().parent().attr('data-var')
    const qty = e.val()

    if (qty > 0) {
        $.post(api + '/updateqty', {id: id, qty: qty}, (res) => {
            if (res == 1) showAlert('success', 'บันทึกรายการสำเร็จ')
            else showAlert('error', 'พบข้อผิดพลาด')
            location.reload()
        })
    }
}

const updateShift = (e) => {
    const id = e.parent().parent().attr('data-var')
    const qty = e.val()

    if (qty > 0) {
        $.post(api + '/updateshift', {id: id, qty: qty}, (res) => {
            if (res == 1) showAlert('success', 'บันทึกรายการสำเร็จ')
            else showAlert('error', 'พบข้อผิดพลาด')
            location.reload()
        })
    }
}

const removeLine = (e) => {
    const id = e.parent().parent().attr('data-var')

    if (id > 0) {
        swal({
            title: "ต้องการลบรายการใช่หรือไม่",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: true,
            showLoaderOnConfirm: true
        }, () => {
            $.post(api + '/deleteqc', {id: id}, (res) => {
                if (res == 1) showAlert('success', 'บันทึกรายการสำเร็จ')
                else showAlert('error', 'พบข้อผิดพลาด')
                location.reload()
            })
        })
    }
}

const confirmQC = (e) => {
    swal({
        title: "ต้องการยืนยันผลใช่หรือไม่",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: true,
        showLoaderOnConfirm: true
    }, () => {
        $.post(api + '/confirmqc', {id: 1}, (res) => {
            if (res == 1) showAlert('success', 'บันทึกรายการสำเร็จ')
            else showAlert('error', 'พบข้อผิดพลาด')
            location.reload()
            // console.table(res)
        })
    })
}

const updateSession = (e) => {
    $.post(api + '/update-session', {id: e.val()}, (res) => {
        location.reload()
    })
}