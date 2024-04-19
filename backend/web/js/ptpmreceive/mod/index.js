let FindDataDB = (e) => {
    if (e.val().length == 8)
        $.get('?r=ptpmreceive/getdatawk-mod', {prodno: e.val()}, (res) => {
            //alert(res)
            $('.table-result tbody').html(res)
            $('.line_qty').focus()
        })
}

let AddedDataDB = () => {
    let onForm = $('.form-result').serializeArray()

    if ($('.table-receive tbody tr').length == 10)
        return swal({
            title: "",
            text: "คีย์ยอดรับเข้าได้ครั้งละ 10 แถวเท่านั้น",
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            dangerMode: false,
        })

    if (onForm != '') {
        if (onForm[6]['value'] != '' || onForm[6]['value'] != 0) {
            let tablelast = $('.table-receive tbody tr:last')
            if (!tablelast.closest('tr').find('.added-prodid').val()) {
                $.get('?r=ptpmreceive/gettemplate-mod', {data: 0}, (res) => {
                    $('.table-receive tbody').html(res)

                    tablelast = $('.table-receive tbody tr:last')
                    tablelast.closest('tr').find('.added-prodid').val(onForm[0]['value']).html(onForm[0]['value'])
                    tablelast.closest('tr').find('.added-productid').val(onForm[1]['value']).html(onForm[1]['value'])
                    tablelast.closest('tr').find('.added-lot').val(onForm[2]['value']).html(onForm[2]['value'])
                    tablelast.closest('tr').find('.added-wh').val(onForm[3]['value']).html(onForm[3]['value'])
                    tablelast.closest('tr').find('.added-location').val(onForm[4]['value']).html(onForm[4]['value'])
                    tablelast.closest('tr').find('.added-pcs').val(onForm[5]['value']).html(onForm[5]['value'])
                    tablelast.closest('tr').find('.added-qty').val(onForm[6]['value']).html(onForm[6]['value'])
                    tablelast.closest('tr').find('.added-bg').val(onForm[7]['value']).html(onForm[7]['value'])
                })
            } else {
                tablelast.clone().insertBefore('.table-receive tbody tr:last')
                tablelast.closest('tr').find('.added-prodid').val(onForm[0]['value']).html(onForm[0]['value'])
                tablelast.closest('tr').find('.added-productid').val(onForm[1]['value']).html(onForm[1]['value'])
                tablelast.closest('tr').find('.added-lot').val(onForm[2]['value']).html(onForm[2]['value'])
                tablelast.closest('tr').find('.added-wh').val(onForm[3]['value']).html(onForm[3]['value'])
                tablelast.closest('tr').find('.added-location').val(onForm[4]['value']).html(onForm[4]['value'])
                tablelast.closest('tr').find('.added-pcs').val(onForm[5]['value']).html(onForm[5]['value'])
                tablelast.closest('tr').find('.added-qty').val(onForm[6]['value']).html(onForm[6]['value'])
                tablelast.closest('tr').find('.added-bg').val(onForm[7]['value']).html(onForm[7]['value'])
            }

            // console.log($('.table-receive tbody tr').length)
            $('.table-result tbody').html(onLoadData())
            $('.input-wk').val('').focus()
        }
    }
}

let onLoadData = (cosl = 7) => {
    let htmlq;
    htmlq = "<tr>"
    htmlq += "<td colspan='" + cosl + "'>"
    htmlq += "ไม่พบข้อมูล"
    htmlq += "</td>"
    htmlq += "</tr>"

    return htmlq
}

let RemoveLine = (e) => {
    // console.table(e.val())
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
            let count = $('.table-receive tbody tr').length
            let trlast = $('.table-receive tbody tr:last')

            if (count > 1 && trlast.closest('tr').find('.added-prodid').val() != '')
                e.closest('tr').remove()
            else {
                trlast.closest('tr').find('.added-prodid').val(null).html(null)
                trlast.closest('tr').find('.added-productid').val(null).html(null)
                trlast.closest('tr').find('.added-lot').val(null).html(null)
                trlast.closest('tr').find('.added-wh').val(null).html(null)
                trlast.closest('tr').find('.added-location').val(null).html(null)
                trlast.closest('tr').find('.added-pcs').val(null).html(null)
                trlast.closest('tr').find('.added-qty').val(null).html(null)
                trlast.closest('tr').find('.added-bg').val(null).html(null)
            }
        }
    })
}

let SendDataonForm = (e) => {
    e.hide()
    let formData = $('.form-receive').serializeArray()
    // console.table(formData)
    $.post('?r=ptpmreceive/added-journal-mod', {formData}, (rec) => {
        // console.table(rec)
        if (rec == 1)
            swal({title: '', text: "ดำเนินการเรียบร้อย"})
        else
            swal({title: '', text: "มีข้อผิดพลาด"})

        location.reload()
    })
}

let getValue = (e) => {
    if (e.val() != "" && e.val() == 2) {
        $('.time-group').removeAttr('hidden')
    } else {
        $('.time-group').attr('hidden', true)
    }
}

$(document).keypress((event) => {
    /* todo@ disable Enter key */
    if (event.which == 13)
        event.preventDefault()
})

$(document).ready(() => {
    /* todo@ load hide table */
    $('.table-receive tbody').html(onLoadData(8))
    $('.table-result tbody').html(onLoadData())

    $('.btn-rptviews').click((e) => {
        $('#ListManageReport').modal('show')
    })

    $('.btnchkrec').click(() => {
        $('#ListDetailR').modal('show').find('.modal-body').load('?r=ptpmreceive/get-history')
    })
})