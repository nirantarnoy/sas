let selectRow = (e) => {
    const prod_id = e.closest('tr').find('.line-prod-id').val()
    const item_id = e.closest('tr').find('.line-item-id').val()
    const item_name = e.closest('tr').find('.line-item-name').val()
    const lot_no = e.closest('tr').find('.line-batch').val()
    const trans_id = e.closest('tr').find('.line-rec-id').val()

    $('.select-prod-id').val(prod_id)
    $('.select-product-id').val(item_id)
    $('.select-product-name').val(item_name)
    $('.select-batch').val(lot_no)
    $('.selected-trans-id').val(trans_id)

    $.get('?r=receive-wh/getchkqty', {id: trans_id}, (rec) => {
        if (rec > 0)
            $('.select-qty').attr('max', rec)
    })

    $('#ScanModalR').modal('show')
    e.val('')
    e.focus()
}

let getLocation = (e) => {
    if (e.val() != '' || e.val() != null) {
        $.post('?r=receive-wh/getlocation', {wh: e.val()}, (rec) => {
            console.log(rec)
            if (rec != null || rec != '')
                $(".select-location").html(rec)
        })
    }
}

let removeLine = (id) => {
    swal({
        title: "ยกเลิกยอดรับเข้า ?",
        text: "",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        dangerMode: false,
    }, function (res) {
        if (res) {
            $.get('?r=receive-wh/removeline', {id: id}, (rec) => {
                location.reload()
            })
        }
    })
}