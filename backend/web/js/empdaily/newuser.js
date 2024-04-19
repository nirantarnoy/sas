$(() => {
    $('.select2-form').select2({theme: "bootstrap4"})
})

let calrownew = (e) => {
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