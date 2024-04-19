let wipalert = () => Swal.fire({title: 'Under Process.', type: 'info'})

$(document).ready(() => {
    $('.mac-select2').select2({theme: 'bootstrap4'})
    $('.mac-select2-new').select2({theme: 'bootstrap4'})

    $('#copydate').datetimepicker({format: 'DD/MM/YYYY'})

    if (parseInt($('.input-countchk').val()) > 0) {
        $('.btn-copydata').hide()
    } else {
        $('.btn-newdata').hide()
    }

    $('#timepicker').datetimepicker({
        format: 'HH:mm'
    })

    $('.btn-save').click(() => {
        let streamer = ""
        const pemp = $('.post-emp')

        let postdata = pemp.serializeArray()
        for (let i = 0; i < postdata.length; i++) {
            if (postdata[i].name === "line_mac[]") {
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

    autoInsert1()
    chkEmpstream1()
})

let autoInsert1 = () => {
    $('table.table-emp1 tbody tr').each(function () {
        const _machine = $(this).find('.mac-select2 option:selected').text()

        if (_machine == '')
            $(this).css('background-color', 'orange')
        else
            $(this).css('background-color', '')
    })
}

let delThisL = (e) => {
    e.parent().parent().remove()
}

let chkEmpstream1 = () => {
    $.post('?r=piass-empdaily/checkempty-stream', (rec) => {
        if (rec == 100) location.reload()
    })
}

let calRows = (e) => {
    $("table.table-emp1 tbody tr").each(function () {
        let mc = $(this).closest('tr').find('.mac-select2 option:selected').text()

        // let xxx = e.val().join(",")
        e.parent().find(".macid").val(mc)

        if (mc == '')
            $(this).css("background-color", "orange")
        else
            $(this).css("background-color", "")
    })
}

let calRowService = (e) => {
    $('.form-newuser').each(function () {
        let _xx = e.val()
        console.log(_xx)
        $(this).find('.macid-new').val(_xx)
    })
}

let showChangeMac = (e) => {
    $('.current-select').val(null).trigger('change')
    $.getJSON(e.attr('data-url'), {id: e.attr('data-id')}, (res) => {
        $('#machineChanger').modal('show')
        $('.macidcurrent').val(res['machineno'])
        $('.selected-emp').val(res['empid'])

        if (res['machineno'] != '') {
            let _x = res['machineno'].split(',')
            for (let i = 0; i < _x.length; i++) {
                let nopt = new Option(_x[i], _x[i], true, true)
                $('.current-select').append(nopt).trigger('change')
            }
        }
    }).then($.getJSON('?r=piass-empdaily/history', {id: e.attr('data-id')}, (res) => {
        console.log(res);
        $('.table-history tbody').html(res['data'])
    }))
}

let createData = (e) => {
    $('#newUser').modal('show')

    let calOnload = () => {
        calRowService($('.mac-select2-new'))
    }
    setTimeout(calOnload, 5500)
}

let copyData = (e) => {
    $('#copyData').modal('show')
}

let copyDataNextDay = () => {
    Swal.fire({
        title: 'ต้องการคัดลอกข้อมูลไปวันถัดไปหรือไม่ ?',
        showCancelButton: true,
    }).then((res) => {
        if (res.value == true) {
            $.post('?r=piass-empdaily/setnextday', (data) => {
                if (data['id'] != undefined) {
                    Swal.fire({title: 'แจ้งเตือน', text: data['msg']}).then((sw) => {
                        location.reload()
                    })
                }
            }, 'json')
        }
    })
}

let transferData = (e) => {
    let date = e.find('.datetimepicker-input-1').val()
    $.get('?r=piass-empdaily/gethistory-copy', {q: date}, (res) => {
        if (res['status'] == 200) {
            $('.table-emphistory tbody').html(res['data'])
        }
    }, 'json')
}

$('.btn-save1').click((e) => {
    $('.form3').submit()
})

let setData = (e) => {
    // let _x = e.val().join(',')
    // console.log(e.val())
    e.parent().find('.macidnext').val(e.val())
}