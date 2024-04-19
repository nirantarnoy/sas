$(document).ready(() => {
    $(".stream-select2").select2({
        theme: "bootstrap4",
        multiple: true,
        selectAll: true
    })

    $('#timepicker').datetimepicker({
        format: 'HH:mm'
    })

    autoInsert()
    chkEmpstream()

    $('.btn-save').click(() => {
        let streamer = ""
        const pemp = $('.post-emp')

        let postdata = pemp.serializeArray()
        for (let i = 0; i < postdata.length; i++) {
            if (postdata[i].name === "line_streamer[]") {
                if (streamer == "") {
                    streamer += postdata[i].value
                } else if (postdata[i].value !== "") {
                    streamer += ',' + postdata[i].value
                }
            }
        }

        if (streamer !== "") {
            pemp.submit()
        } else {
            location.reload()
        }
    })

    if ($('.input-countchecked').val() > 0) {
        $('.btn-copydata').hide()
    } else {
        $('.btn-newdata').hide()
    }
})

const calRows = (e) => {
    $("table.table-emp tbody tr").each(() => {
        let stream = $(this).closest('tr').find('.stream-select2 option:selected').text()

        let xxx = e.val().join(",")
        e.parent().find(".stoveid").val(xxx)

        if (stream == "")
            $(this).css("background-color", "orange")
        else
            $(this).css("background-color", "")
    })
}

const autoInsert = () => {
    $("table.table-emp tbody tr").each(function () {
        let stream = $(this).closest('tr').find('.stream-select2 option:selected').text();

        if ($(this).closest('tr').find('.line-group-stream').val() == 'PIVB' || $(this).closest('tr').find('.line-group-stream').val() == 'PIVM') {
            $(this).closest('tr').find('.line-extend').prop('disabled', 'disabled')
        }

        if (stream === '') {
            $(this).css('background-color', 'orange')
        } else {
            $(this).css('background-color', '')
        }
    })
}

const chkEmpstream = () => {
    $.post("?r=pi-worker-assign/checkempty-stream", (rec) => {
        if (rec == 100) location.reload()
    })
}

const showChangeStream = (e) => {
    $('.current-select').val(null).trigger('change')
    $.get(e.attr('data-url'), {id: e.attr('data-id')}, (res) => {
        $('#streamChanger').modal("show")
        $('.stoveid1').val(res['streamno'])
        $('.selected-emp').val(res['empid'])

        if (res['streamno'] != "") {
            let x = res['streamno'].split(',')
            for (let i = 0; i < x.length; i++) {
                let newOption = new Option(x[i], x[i], true, true)
                $('.current-select').append(newOption).trigger('change')
            }
        }
    }, 'json').then($.get('?r=pi-worker-assign/historychange', {id: e.attr('data-id')}, (res) => {
        $('.table-history tbody').html(res['data'])
    }, 'json'))
}

const createData = (e) => {
    $('#newUser').modal("show")
}

const getData = (e) => {
    let xxx = e.val().join(',');
    e.parent().find('.stoveid2').val(xxx)
}

const deleteThisLine = (e) => {
    e.parent().parent().remove()
}