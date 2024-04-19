$(function () {
    $('#copydate').datetimepicker({
        format: 'DD/MM/YYYY'
    })
});

let copyStreamer = () => {
    $('#copyStreamer').modal('show')
}

let copyStreamerNextDay = () => {
    Swal.fire({
        title: 'ต้องการคัดลอกข้อมูลไปวันถัดไปหรือไม่ ?',
        showCancelButton: true,
        confirmButton: "Yes",
    }).then((res) => {
        if (res.value == true) {
            $.post('?r=pi-worker-assign/setnextday', (res) => {
                if (res['id'] != "") {
                    Swal.fire({
                        title: "แจ้งเตือน",
                        text: res['txt']
                    }).then((res) => {
                        location.reload()
                    })
                }
            }, 'json')
        }
    })
}

let transferData = (e) => {
    let date = e.find('.datetimepicker-input').val()
    $.get('?r=pi-worker-assign/gethistory-copy', {q: date}, (res) => {
        // console.table(res)
        $('.table-emphistory tbody').html(res['data'])
    }, 'json')
}

$('.btn-save1').click((e) => {
    $('.post-copy').submit()
})