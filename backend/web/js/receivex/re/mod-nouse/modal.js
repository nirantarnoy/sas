const modal = $("#modal")
const id = document.getElementById("frm-modal")
const opt = {backdrop: false, keyboard: false}
const css = {"background-color": "#7F7978", "color": "#FFF"}

id.classList.add("modal-xl")
const text = "XXXXX"

let _modal = (url, text) => {
    modal.modal(opt).find(".modal-body").load(url).end()
        .find(".modal-title").text(text).end()
        .find(".modal-header").css(css)
}

modal.on("hidden.bs.modal", () => {
    location.reload()
})