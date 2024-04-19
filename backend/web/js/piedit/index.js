const modal = $('.editinfoxModel')
const css = {'background-color': '#F5F5F5', 'color': '#000'}

modal.on('hidden.bs.modal', () => {
    modal.find('.modal-body').text(null)
    location.reload()
})

let showStreamInfoe = (e) => {
    showModal(e.attr('data-url'))

}

let showModal = (uri) => {
    let x = modal
    x.modal('show')
    x.find('.modal-body').load(uri)
}