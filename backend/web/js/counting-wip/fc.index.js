let onCreated = () => {
    $("#newJournal").modal("show")
}

let showAlert = (type, msg) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-center',
        showConfirmButton: false,
        timer: 3000
    })

    Toast.fire({type: type, title: msg})
}

let getDataList = (e, jrno) => {
    if (e.val() != "") {
        $.getJSON("?r=countingwip-table/getdataprop", {wcid: e.val(), jrno: jrno}, (res) => {
            $('.showprop_tb').html(res)
        })
    } else {
        $('.showprop_tb').html('<label style="color: red;">ไม่พบข้อมูล</label>')
    }
}

let updateQTY = (e) => {

    const recid = e.parent().parent().find(".recid").val()
    if (recid > 0) {
        $.post("?r=countingwip-table/updateqty-mod", {id: recid, qty: e.val()}, (res) => {
            if (res == 1)
                showAlert('success', 'บันทึกเรียบร้อย')
            else
                showAlert('error', 'พบข้อผิดพลาด')
        })
    }
}

$(document).ready(() => {
    const showalert = $("#btn-show-alert")

    $(window).keydown((event) => {
        if (event.keyCode == 13) {
            event.preventDefault()
            return false
        }
    })

    showalert.click(() => {
        let msg = $(".alert-msg").val()
        let msg_err = $(".alert-msg-error").val()

        if (msg != "" && typeof msg != "undefined")
            showAlert('success', msg)
        else if (msg_err != "" && typeof msg_err != "undefined")
            showAlert('error', msg_err)
    })

    showalert.trigger('click')

    $('.showprop_tb').html('<label style="color: red;">ไม่พบข้อมูล</label>')

})

function IsNumeric(e) {
    const keyCode = e.keyCode

    return (keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105);
}