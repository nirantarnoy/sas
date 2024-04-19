const showAlert = (show_type, msg) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-center',
        showConfirmButton: false,
        timer: 3000
    });

    Toast.fire({
        type: show_type,
        title: msg
    })
}

$(document).ready(() => {
    const btnshAlert = $("#btn-show-alert")
    btnshAlert.trigger("click")

    $(".btn-posted").click(() => {
        if (confirm("ต้องการยืนยันยอดใช่หรือไม่")) {
            $(".t-date").val($(".trans-date").val())
            $(".t-shift").val($(".trans-shift").val())
            $("form#form-posted").submit()
        }
    })

    btnshAlert.click(() => {
        const msg = $(".alert-msg").val()
        const msg_err = $(".alert-msg-error").val()

        if (msg != "" && typeof msg != 'undefined')
            showAlert('success', msg)
        else if (msg_err != "" && typeof msg_err != 'undefined')
            showAlert('error', msg_err)
    })
})