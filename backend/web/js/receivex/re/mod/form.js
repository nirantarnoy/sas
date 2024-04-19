let openReceivex = (e) => {
    const modal = $('#modal');
    const id = document.getElementById('frm-modal');
    id.classList.add('modal-lg');
    const opt = {backdrop: false, keyboard: false};
    const css = {'background-color': '#FFB4B4', 'color': '#FFF'};

    modal.modal(opt).find('.modal-body').load(e).end()
        .find('.modal-title').text('รับเข้า wh receive').end()
        .find('.modal-footer').hide().end()
        .find('.model-header').css(css)
}

let openHistory = (e) => {
    // console.table(e.attr('data-url'))
    const modal = $('#modal');
    const id = document.getElementById('frm-modal');
    id.classList.add('modal-lg');
    const opt = {backdrop: false, keyboard: false};
    const css = {'background-color': '#FFB4B4', 'color': '#FFF'};

    modal.modal(opt).find('.modal-body').load(e.attr('data-url')).end()
        .find('.modal-title').text('รายการสินค้าเข้าคลัง').end()
        .find('.modal-footer').hide().end()
        .find('.model-header').css(css)
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

setInterval('location.reload()', 180000)