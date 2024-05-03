<?php
$this->title = 'ข้อความแชท';
?>
<div class="row">
    <div class="col-lg-12">
        <table style="width: 100%;border: 1px;">
            <tr style="background-color: royalblue">
                <td colspan="2" style="width: 100%;height: 25px;color: white;padding: 15px;">ใบแจ้งซ่อม
                    <b><?= $model->workorder_no ?></b></td>
            </tr>
            <!--            <tr>-->
            <!--                <td style="padding: 15px;text-align: center"><div class="badge badge-secondary">ไม่พบข้อความ</div></td>-->
            <!--            </tr>-->
            <tr>
                <td colspan="2" style="padding: 15px;text-align: center">
                    <div class="badge badge-secondary">03/05/2024</div>
                </td>
            </tr>
            <tr>
                <td style="width: 5%">
                    <div style="border-radius: 50px;background-color: lightgrey;height: 40px;width: 40px;text-align: center;padding: 8px;">
                        <i class="fa fa-user"></i></div>
                </td>
                <td style="width: 95%">
                    <div><?=date('H:i')?></div>
                    <div style="height: 5px;"></div>
                    <div style="margin-top:5px;"><span style="background-color: lightgrey;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">สวัสดีครับ</span></div>
                    <div style="height: 10px;"></div>
                </td>
            </tr>
            <tr>
                <td style="width: 5%">
                    <div style="border-radius: 50px;background-color: lightgrey;height: 40px;width: 40px;text-align: center;padding: 8px;">
                        <i class="fa fa-user"></i></div>
                </td>
                <td style="width: 95%;">

                    <div><?=date('H:i')?></div>
                    <div style="height: 5px;"></div>
                    <div style="margin-top:5px;"><span style="background-color: lightgrey;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">สวัสดีครับ ต้องการให้ช่วยเรื่องอะไรครับ</span></div>
                    <div style="height: 10px;"></div>
                </td>

            </tr>
            <tr style="height: 350px;">
                <td></td>
            </tr>

        </table>
        <br/>
        <table style="width: 100%;">
            <tr>
                <td style="width:93%"><input type="text" class="form-control" placeholder="กรอกข้อความของคุณที่นี่">
                </td>
                <td>
                    <div class="btn btn-primary">ส่งข้อความ</div>
                </td>
            </tr>
        </table>
    </div>
</div>
