$(function () {
    $(".btn-show-change").click(function () {
        $("#changeModal").modal("show");
    })

    $(".select2").select2({
        theme: "bootstrap4"
    })

    $(".select2-stove").select2({
        theme: "bootstrap4",
        multiple: true,
        selectAll: true
    })

    if ($('.input-countchecked').val() > 0) {
        $('.btn-copydata').hide()
    }
});

$('.btn-create').click(() => {
    $('#createUser').modal("show")
})

$('.btn-save').click(() => {
    $('.post-empchange').submit()
})

let changeEmp = (e) => {
    $('.current-select').val(null).trigger('change')
    $.get(e.attr('data-url'), {id: e.attr('data-id')}, (res) => {
        console.table(res)
        const mres = res[0]
        const tres = res[1]

        $('#streamChanger').modal("show")
        if (mres[0]['GROUP_NAME'] != "") {
            $('.groupname').text(mres[0]['GROUP_NAME'])
            $('.change_group').val(mres[0]['GROUP_NAME'])
        }
        if (mres[0]['STREAM_NO'] != "") {
            $('.stovename').text(mres[0]['STREAM_NO'])
        } else {
            $('.stovename').text('*')
        }
        $('.current-emp').val(mres[0]['EMP_NAME'])
        $('.current-empid').val(mres[0]['PERSONNELNUMBER'])
        $('.datechange').text(new Date(mres[0]['ASSIGN_DATE']).toLocaleString())
        $('.change_date').val(mres[0]['ASSIGN_DATE'])
        // $('.current-empid').text(res[0]['PERSONNELNUMBER'])

        // let tt = new Option('เลิกก่อนเวลา','0')
        for (let i = 0; i < tres.length; i++) {
            let tx = new Option(tres[i]['text'], tres[i]['val'])
            $('.outtime-selected').append(tx)
        }
    }, 'json')
}

let deleteEmp = (e) => {
    swal({
        title: "ต้องการลบรายการใช่หรือไม่",
        text: "",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: true,
        showLoaderOnConfirm: true
    }, function (isConfirm) {
        if (!isConfirm) {
            location.reload()
        } else {
            $.get(e.attr('data-url'), () => {
                location.reload()
            })
        }
    })
}

function calrow(e) {
    $("table.table-emp tbody tr").each(function () {
        let stream = $(this).closest('tr').find('.select2-stove option:selected').text();
        let xxx = e.val().join(',');
        e.parent().find('.stoveid').val(xxx)
    });
}