$(".btn-add-list").click(function () {
    //alert();
    let prod_id = $(".table-scan tbody tr").find('.line-prod-id').val();
    let product_id = $(".table-scan tbody tr").find('.line-product-id').val();
    let lot = $(".table-scan tbody tr").find('.line-lot').val();
    let warehouse = $(".table-scan tbody tr").find('.line-warehouse').val();
    let location = $(".table-scan tbody tr").find('.line-location').val();
    let qty = $(".table-scan tbody tr").find('.line-qty').val();
    let pcs = $(".table-scan tbody tr").find('.line-pcs').val();

    // let count = $('.table-list tbody tr').length
    let tr = $(".table-list tbody tr:last")

    if (tr.closest('tr').find('.line-add-prodid-show').html() == '') {
        tr.closest('tr').find('.line-add-prodid-show').html(prod_id);
        tr.closest('tr').find('.line-add-prodid').val(prod_id);
        tr.closest('tr').find('.line-add-product-id-show').html(product_id);
        tr.closest('tr').find('.line-add-product-id').val(product_id);
        tr.closest('tr').find('.line-add-lot-show').html(lot);
        tr.closest('tr').find('.line-add-lot').val(lot);
        tr.closest('tr').find('.line-add-warehouse-show').html(warehouse);
        tr.closest('tr').find('.line-add-warehouse').val(warehouse);
        tr.closest('tr').find('.line-add-location-show').html(location);
        tr.closest('tr').find('.line-add-location').val(location);
        tr.closest('tr').find('.line-add-pcs-show').html(pcs);
        tr.closest('tr').find('.line-add-qty').val(qty);
    } else {
        // tr.clone().appendTo($('.table-list tbody'))
        tr.clone().insertAfter('.table-list tbody tr:last')
        tr.closest('tr').find('.line-add-prodid-show').html(prod_id);
        tr.closest('tr').find('.line-add-prodid').val(prod_id);
        tr.closest('tr').find('.line-add-product-id-show').html(product_id);
        tr.closest('tr').find('.line-add-product-id').val(product_id);
        tr.closest('tr').find('.line-add-lot-show').html(lot);
        tr.closest('tr').find('.line-add-lot').val(lot);
        tr.closest('tr').find('.line-add-warehouse-show').html(warehouse);
        tr.closest('tr').find('.line-add-warehouse').val(warehouse);
        tr.closest('tr').find('.line-add-location-show').html(location);
        tr.closest('tr').find('.line-add-location').val(location);
        tr.closest('tr').find('.line-add-pcs-show').html(pcs);
        tr.closest('tr').find('.line-add-qty').val(qty);
    }
});

let removeline = (e) => {
    // let x = e.closest('tr').find('.line-add-prodid-show')
    // console.log(x.text())
    let count = $('.table-list tbody tr').length
    let tr = $(".table-list tbody tr:last")

    // alert(count)
    if (count > 1 && tr.closest('tr').find('.line-add-prodid-show').html() != '')
        e.closest('tr').remove()
    else {
        tr.closest('tr').find('.line-add-prodid-show').html('')
        tr.closest('tr').find('.line-add-prodid').val('')
        tr.closest('tr').find('.line-add-product-id-show').html('')
        tr.closest('tr').find('.line-add-product-id').val('')
        tr.closest('tr').find('.line-add-lot-show').html('')
        tr.closest('tr').find('.line-add-lot').val('')
        tr.closest('tr').find('.line-add-warehouse-show').html('')
        tr.closest('tr').find('.line-add-warehouse').val('')
        tr.closest('tr').find('.line-add-location-show').html('')
        tr.closest('tr').find('.line-add-pcs').html('')
        tr.closest('tr').find('.line-add-location').val('')
        tr.closest('tr').find('.line-add-qty').val(0)
    }
}

let senddata = (e) => {
    let formData = $('#form-send-production').serializeArray()
    // console.table(formData)

    $.post('?r=ptpmreceive/create-journal', {formData}, (rec) => {
        // console.log(rec)
        if (rec == 1) {
            alert('ดำเนินการเรียบร้อย')
        } else {
            alert('มีข้อผิดพลาด')
        }

        location.reload()
    })
}

$('.btn-rptviews').click((e) => {
    // alert('')
    $('#ListManageReport').modal('show')
    // $.get('?r=ptpmreceive/export-x1')
})

let getValue = (e) => {
    // alert(e.val())
    if (e.val() != "" && e.val() == 2) {
        // alert(1234567890)
        $('.time-group').removeAttr('hidden')
    } else {
        $('.time-group').attr('hidden', true)
    }
}