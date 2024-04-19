$(document).ready(() => {
    $('.select2-form').select2({theme: 'bootstrap4'})

    $(".streamn-select2").select2({
        theme: "bootstrap4",
        multiple: true,
        selectAll: true
    })
})

let calRow_New = (e) => {
    // let stream = []
    // let options = e && e.options
    // let opt
    //
    // for (let i = 0, iLen = options.length; i < iLen; i++) {
    //     opt = options[i]
    //
    //     if (opt.selected) {
    //         stream.push(opt.value || opt.text)
    //     }
    // }

    $("table.table-emp tbody tr").each(function () {
        let stream = $(this).closest('tr').find('.streamn-select2 option:selected').text();

        let xxx = e.val().join(',');
        e.parent().find('.stoveid').val(xxx)

        if (stream === '') {
            $(this).css('background-color', 'orange');
        } else {
            $(this).css('background-color', '');
        }
    });

}