let openReceive = (e) => {
    let url = "?r=receive-wh/open-receive&id=" + e
    _modal(url, "บันทึกรับเข้าคลัง")

    $('.modal-footer').hide()
    $.get('?r=receive-wh/getchkqty', {id: e}, (rec) => {
        $('.select-qty').attr('max', rec)
    })
}

let sendDataLot = (e) => {
    let data = e.val()
    if (data != '') {
        $.getJSON('?r=receive-wh/getdata-lot', {id: data}, (rec) => {
            $('#select-lot option').remove()
            for (let i = 0; i < rec.length; i++) {
                let options = new Option(rec[i]['WMSLOCATIONID'], rec[i]['WMSLOCATIONID'], false, false)
                $('#select-lot').append(options)
            }
        })
    }
}

let Minus = () => {
    let point = $('.select-qty').val()
    if (point > 1)
        $('.select-qty').val(point - 1)
}

let Plus = () => {
    let point = parseInt($('.select-qty').val())
    if (point >= 1)
        $('.select-qty').val(point + 1)
}

let sendDataForm = (e) => {
    console.table($('.form-transmod').serializeArray())
}