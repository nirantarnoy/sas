let wipalert = () => Swal.fire({title: 'Under Process.', type: 'info'})

$(document).ready(() => {

})

let showMacInfo = (e) => {
    const mac_name = e.attr('data-var')
    const assign_id = e.attr('data-x')
    const assign_date = e.attr('data-y')
    const lv = 1
    const st_text = e.parent().find('.line-mac-status').val()

    const setText = () => {
        const _text = $('.mac-status').text()
        if (_text == 'Canceled') $('.btn-cancel-prod').text('เริ่มการผลิต')
    }

    if (mac_name != null) {
        $.getJSON('?r=piass-macassign/getmachine-data', {macno: mac_name}, (res) => {
            $('.mac_no').text(res['code'] ?? 'X')
            $('.cur-machine').val(mac_name)
            $('.mac_lv').val(lv)
            $('.mac-status').val(st_text)
            $('.work-date').val(assign_date)
            $('.c-work-date').text(assign_date)
            setText()
            showLevel(mac_name, assign_id, lv, assign_date)

            $('#machineinfoM').modal('show')
        })
    }
}

let showLevel = (mac_name, as_id, lv, as_date) => {
    if (lv > 0) {
        $.getJSON('?r=piass-macassign/showlevel', {
            mac_name: mac_name, assignid: as_id, lv: lv, assigndate: as_date
        }, (res) => {
            $('.mainprod').html(res['prodPage'])
            $(".workpage").html(res['workPage'])
        })
    }
}

let showCopy = () => {
    $('#copyModal').modal('show')
}

let showPropCopyNextDay = () => {
    Swal.fire({
        title: 'แจ้งเตือนระบบ',
        text: 'ต้องการคัดลอกข้อมูลไปวันถัดไปใช่หรือไม่ ?',
        showCancelButton: true,
    }).then((res) => {
        if (res.value == true) {
            $.post('?r=piass-macassign/copytonextday', (data) => {
                Swal.fire({title: 'แจ้งเตืองระบบ', text: data['msg']}).then(() => {
                    location.reload()
                })
            }, 'json')
        }
    })
}

let getItem = (e) => {
    let prodid = e.val()
    if (prodid != '' && prodid.length == 8) {
        $.getJSON('?r=piass-macassign/getitemdata', {id: prodid}, (res) => {
            const rec = e.closest('tr')
            const item = res[0]
            if (item == undefined) {
                rec.find('.line-item').val(null)
                rec.find('.line-brand').val(null)
                rec.find('.line-prodqty').val(null)
                rec.find('.line-prodqty-show').val(null)
                rec.find('.line-qty').val(null)
            } else {
                rec.find('.line-item').val(item['itemid'])
                rec.find('.line-brand').val(item['brand'])
                rec.find('.line-prodqty').val(item['prod_qty'])
                rec.find('.line-prodqty-show').val(item['prod_qty_show'])
                rec.find('.line-qty').focus().select()
            }
        })
    }
}