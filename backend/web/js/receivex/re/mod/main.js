// const modal = $('#modal');
// const id = document.getElementById('frm-modal');
// id.classList.add('modal-lg');
// const opt = {backdrop: false, keyboard: false};
// const css = {'background-color': '#FFB4B4', 'color': '#FFF'};

let openSetWh = (e) => {
    modal.modal(opt).find('.modal-body').load(e).end()
        .find('.modal-title').text('ตั้งค่ารับเข้า wh receive').end()
        .find('.modal-footer').hide().end()
        .find('.model-header').css(css)
}

let getlocation_loc = (e) => {
    $.getJSON('?r=receive-wh/getdata-lotlist', {id: e.val()}, (res) => {
        res.forEach((inData) => {
            let options = new Option(inData['WMSLOCATIONID'], inData['WMSLOCATIONID'], false, false)
            $('#lotselect').append(options)
        })
    })
}

modal.on('hidden.bs.modal', () => {
    location.reload()
})