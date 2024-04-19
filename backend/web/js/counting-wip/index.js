function IsNumeric(e) {
    const keyCode = e.keyCode

    return (keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105);
}

const getItemDetail = (e) => {
    if (e.val().length >= 0) {
        $.getJSON("?r=countingwip-table/getitemdetail", {itemid: e.val()}, (res) => {
            console.log(res)
            const currentRow = e.parent().parent()
            currentRow.find('.itemdesc').val(res['model']['Desc2'].trim())
            currentRow.find('.buyer').val(res['model']['ITEMBUYERGROUPID'])
            currentRow.find('.cost').val(parseFloat(res['price']['PRICE']).toFixed(3))
            currentRow.find('.qty').focus()
        })
    }
}

const addNewRec = () => {
    const table = $(".table-de")
    const nrow = table.find("tr:eq(1)").clone()
    nrow.insertBefore(table.find("tr:last"))

    /**
     * todo: delete old text
     */
    let prevtr = table.find("tr:last").prev()
    prevtr.find(".itemid").val("")
    prevtr.find(".itemdesc").val("")
    prevtr.find(".buyer").val("")
    prevtr.find(".cost").val("")
    prevtr.find(".qty").val(0)
    prevtr.find(".itemid").focus()
}

const removeLine = (e) => {
    const table = $(".table-de tbody:last tr").length
    if (table > 2) {
        e.parent().parent().remove()
    } else {
        const table = $(".table-de")
        let tr = table.find("tr:eq(1)")
        tr.find(".itemid").val("")
        tr.find(".itemdesc").val("")
        tr.find(".buyer").val("")
        tr.find(".cost").val("")
        tr.find(".qty").val(0)
        tr.find(".itemid").focus()
    }
}