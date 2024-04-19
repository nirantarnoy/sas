const copyNextDay = () => {
    Swal.fire({
        title: 'ต้องการคัดลอกข้อมูลไปวันถัดไปหรือไม่ ?',
        showCancelButton: true,
        confirmButton: "Yes"
    }).then((res) => {
        if (res.value == true) {
            $.post('?r=pi-stream-assign/setnextday', (res) => {
                if (res['id'] != "") {
                    Swal.fire({
                        title: "แจ้งเตือน",
                        text: res['txt']
                    }).then((res) => {
                        location.reload()
                    })
                }
            }, 'json')
        }
    })
}