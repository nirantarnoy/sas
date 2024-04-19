<?php

use yii\widgets\ActiveForm;

//echo md5(1);
?>

<!--<link rel="stylesheet" href="../../backend/web/plugins/fontawesome-free/css/all.min.css">-->
<!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
<!--<link rel="stylesheet" href="../../backend/web/plugins/icheck-bootstrap/icheck-bootstrap.min.css">-->
<!--<link rel="stylesheet" href="../../backend/web/dist/css/adminlte.min.css">-->
<!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->


<!--    <style>-->
<!--        @font-face {-->
<!--            font-family: 'Kanit-Regular';-->
<!--            src: url('../../backend/web/fonts/Kanit-Regular.ttf') format('truetype');-->
<!--            /* src: url('../fonts/thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),-->
<!--                  url('../fonts/thsarabunnew-webfont.woff') format('woff'),-->
<!--                  url('../fonts/EkkamaiStandard-Light.ttf') format('truetype');*/-->
<!--            font-weight: normal;-->
<!--            font-style: normal;-->
<!--        }-->
<!--        body{-->
<!--            font-family: "Kanit-Regular";-->
<!--            font-size: 16px;-->
<!--        }-->
<!--        .help-block{-->
<!--            color: red;-->
<!--        }-->
<!--    </style>-->

<div class="hold-transition login-page">
    <div class="login-box" style="margin-top: 10px">

        <!-- /.login-logo -->
        <div class="card" style="margin-top: 0px;">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <h3>SAS</h3>
<!--                    <a href="#">-->
<!--                        <img src="../../backend/web/uploads/logo/Logo2.jpg" width="50%" alt="">-->
<!--                    </a>-->
                </div>
                <p class="login-box-msg">ลงชื่อเข้าเพื่อเข้าใช้งานระบบของคุณ</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Username']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Password']) ?>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                จำฉันไว้ในระบบ
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-warning btn-block">เข้าใช้งาน</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?php ActiveForm::end() ?>

                <div class="social-auth-links text-center mb-3">
                    <!--        <p>- OR -</p>-->
                    <!--        <a href="#" class="btn btn-block btn-primary">-->
                    <!--          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook-->
                    <!--        </a>-->
                    <!--        <a href="#" class="btn btn-block btn-danger">-->
                    <!--          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+-->
                    <!--        </a>-->
                </div>
                <!-- /.social-auth-links -->

<!--                <p class="mb-1">-->
<!--                    <a href="forgot-password.html">I forgot my password</a>-->
<!--                </p>-->
                <!--      <p class="mb-0">-->
                <!--        <a href="register.html" class="text-center">Register a new membership</a>-->
                <!--      </p>-->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->


<!--    <script src="../../backend/web/plugins/jquery/jquery.min.js"></script>-->
<!--    <script src="../../backend/web/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!--    <script src="../../backend/web/dist/js/adminlte.min.js"></script>-->


    <script>
        $("#refresh_captcha").click(function (event) {
          //  alert();
            // event.preventDefault();
            //$('#my-captcha-image').yiiCaptcha('refresh');
            $('#my-captcha-image').trigger('click');
        })
    </script>

</div>

