$(function () {
    $(".streamer-select2").select2({
        theme: "bootstrap4",
        multiple: true,
        selectAll: true
    });

    autoinsert()
    chkempstream()

    if ($('.input-countchecked').val() > 0) {
        $('.btn-copydata').hide()
        // $('.btn-save').hide()
    } else {
        $('.btn-newdata').hide()
    }
});

let chkempstream = () => {
    $.post("?r=empdaily/checkempty-stream", "", (rec) => {
        if (rec == 100) location.reload()
    })
}

$(function () {
    $('#timepicker').datetimepicker({
        format: 'HH:mm'
    })
});

let deleteThisLine = (e) => {
    e.parent().parent().remove()
}

let getData = (e) => {
    let xxx = e.val().join(',');
    e.parent().find('.stoveid2').val(xxx)
}

let createData = (e) => {
    $('#newUser').modal("show")
}

let showchangestream = (e) => {
    $('.current-select').val(null).trigger('change')
    $.get(e.attr('data-url'), {id: e.attr('data-id')}, (res) => {
        $('#streamChanger').modal("show")
        $('.stoveid1').val(res['streamno'])
        $('.selected-emp').val(res['empid'])

        if (res['streamno'] != "") {
            let x = res['streamno'].split(',')
            for (i = 0; i < x.length; i++) {
                let newOption = new Option(x[i], x[i], true, true)
                $('.current-select').append(newOption).trigger('change')
            }
        }
    }, 'json').then($.get('?r=empdaily/historychange', {id: e.attr('data-id')}, (res) => {
        $('.table-history tbody').html(res['data'])
    }, 'json'))
}

$('.btn-save').click(() => {
    $('.post-emp').submit()
})

let autoinsert = () => {
    $("table.table-emp tbody tr").each(function () {
        let stream = $(this).closest('tr').find('.streamer-select2 option:selected').text();

        if ($(this).closest('tr').find('.line-group-stream').val() === 'PTVB') {
            $(this).closest('tr').find('.line-extend').prop('disabled', 'disabled')
        }

        if (stream === '') {
            $(this).css('background-color', 'orange');
        } else {
            $(this).css('background-color', '');
        }
    });
}

function calrow(e) {
    $("table.table-emp tbody tr").each(function () {
        let stream = $(this).closest('tr').find('.streamer-select2 option:selected').text();

        let xxx = e.val().join(',');
        e.parent().find('.stoveid').val(xxx)

        if (stream === '') {
            $(this).css('background-color', 'orange');
        } else {
            $(this).css('background-color', '');
        }
    });
}