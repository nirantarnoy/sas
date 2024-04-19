let removeline = (id) => {
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
            $.get('?r=ptpmreceive/removeline', {id: id}, (rec) => {
                location.reload()
            })
        }
    });
}