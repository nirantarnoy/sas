$(function () {
    $('#copydate').datetimepicker({
        format: 'DD/MM/YYYY'
    })
});

let copyStreamer = () => {
    $('#copyStreamer').modal('show')
}

let transferData = (e) => {
    let date = e.find('.datetimepicker-input').val()
    $.get('?r=empdaily/gethistory-copy', {id: date}, (res) => {
        // console.table(res)
        $('.table-emphistory tbody').html(res['data'])
    }, 'json')
}

$('.btn-save1').click((e) => {
    // e.preventDefault()
    // console.table($('.post-copy').serializeArray())
    $('.post-copy').submit()
})