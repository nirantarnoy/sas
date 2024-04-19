let fetchapi = (pid, dlv, flag) => {
    swal({
        title: "ยืนยันการส่งตรวจสอบ ?",
        text: "",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        dangerMode: false
    }, function (res) {
        if (res) {
            fetch('?r=qc-checklist/confirms&pid=' + pid + '&time=' + dlv + '&flag=' + flag).then((res) => {
                return res.json()
            }).then((data) => {
                location.reload()
            })
        }
    })
};