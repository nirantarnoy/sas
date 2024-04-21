<aside class="main-sidebar sidebar-light elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?r=site/index" class="brand-link">
<!--        <img src="--><?php //echo Yii::$app->request->baseUrl; ?><!--/uploads/logo/narono_logo.png" alt="Narono" class="brand-image">-->
<!--        <span class="brand-text font-weight-light">VORAPAT</span>-->
        <i class="fa fa-wrench text-success text-lg"> </i>
        <span class="brand-text font-weight-bold" style="font-size: 20px;"> SAS <span style="color: royalblue">system</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <?php if (!isset($_SESSION['driver_login'])): ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php?r=site/index" class="nav-link site">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            ภาพรวมระบบ
                            <!--                                <i class="right fas fa-angle-left"></i>-->
                        </p>
                    </a>
                </li>
<!--                <li class="nav-item has-treeview has-sub">-->
<!--                    <a href="#" class="nav-link">-->
<!--                        <i class="nav-icon fas fa-building"></i>-->
<!--                        <p>-->
<!--                            ข้อมูลบริษัท-->
<!--                            <i class="fas fa-angle-left right"></i>-->
<!--                        </p>-->
<!--                    </a>-->
<!--                    <ul class="nav nav-treeview">-->
<!--                        --><?php ////if (\Yii::$app->user->can('company/index')): ?>
<!--                            <li class="nav-item">-->
<!--                                <a href="index.php?r=company/index" class="nav-link company">-->
<!--                                    <i class="far fa-circlez nav-icon"></i>-->
<!--                                    <p>บริษัท</p>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        --><?php ////endif; ?>
<!--                    </ul>-->
<!--                </li>-->
                <?php if (1>0): ?>
                    <li class="nav-item has-treeview has-sub">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                ตั้งค่าทั่วไป
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?r=workorderstatus" class="nav-link workorderstatus">
                                    <i class="far fa-file-import nav-icon"></i>
                                    <p>สถานะแจ้งซ่อม</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?r=location" class="nav-link location">
                                    <i class="far fa-file-import nav-icon"></i>
                                    <p>ที่ตั้ง (Location)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?r=workordercause" class="nav-link workordercause">
                                    <i class="far fa-file-import nav-icon"></i>
                                    <p>สาเหตุปัญหา</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?r=solvetitle" class="nav-link solvetitle">
                                    <i class="far fa-file-import nav-icon"></i>
                                    <p>วิธีแก้ปัญหา</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item has-treeview has-sub">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            พนักงาน
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php //if (\Yii::$app->user->can('position/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=department/index" class="nav-link department">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>แผนก</p>
                            </a>
                        </li>
                        <?php //endif; ?>
                        <?php //if (\Yii::$app->user->can('position/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=position/index" class="nav-link position">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>ตำแหน่ง</p>
                            </a>
                        </li>
                        <?php //endif; ?>
                        <?php //if (\Yii::$app->user->can('employee/index')): ?>
                            <li class="nav-item">
                                <a href="index.php?r=employee/index" class="nav-link employee">
                                    <i class="far fa-circlez nav-icon"></i>
                                    <p>พนักงาน</p>
                                </a>
                            </li>
                        <?php //endif; ?>
                    </ul>
                </li>

                <li class="nav-item has-treeview has-sub">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            เครื่องจักร
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php //if (\Yii::$app->user->can('customergroup/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=assetcategory/index" class="nav-link assetcategory">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>ประเภทเครื่องจักร</p>
                            </a>
                        </li>
                        <?php //endif; ?>
                        <?php //if (\Yii::$app->user->can('customergroup/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=asset" class="nav-link asset">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>เครื่องจักร</p>
                            </a>
                        </li>
                        <?php //endif; ?>


                    </ul>
                </li>
                <li class="nav-item has-treeview has-sub">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            แจ้งซ่อม
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php //if (\Yii::$app->user->can('customergroup/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=workorder/index" class="nav-link workorder">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>แจ้งซ่อม</p>
                            </a>
                        </li>
                        <?php //endif; ?>
                        <?php //if (\Yii::$app->user->can('customergroup/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=workorderassign" class="nav-link workorderassign">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>มอบหมายงาน</p>
                            </a>
                        </li>
                        <?php //endif; ?>
                        <?php //if (\Yii::$app->user->can('customergroup/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=workorderrate" class="nav-link workorderrate">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>ประเมินงานซ่อม</p>
                            </a>
                        </li>
                        <?php //endif; ?>

                        <?php //if (\Yii::$app->user->can('customergroup/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=asset" class="nav-link asset">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>วิเคราะห์งานซ่อม</p>
                            </a>
                        </li>
                        <?php //endif; ?>


                    </ul>
                </li>
                <li class="nav-item has-treeview has-sub">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            รายงาน
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php //if (\Yii::$app->user->can('salecomreport/index')): ?>
                        <li class="nav-item">
                            <a href="index.php?r=report/workqueuedaily" class="nav-link workqueuedaily">
                                <i class="far fa-circlez nav-icon"></i>
                                <p>รายงานประจำวัน</p>
                            </a>
                        </li>
                        <?php //endif;?>

                    </ul>
                </li>
                <?php // if (isset($_SESSION['user_group_id'])): ?>
                <?php //if ($_SESSION['user_group_id'] == 1): ?>
                <?php //if (\Yii::$app->user->identity->username == 'iceadmin'): ?>
                    <li class="nav-item has-treeview has-sub">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                ผู้ใช้งาน
                                <i class="fas fa-angle-left right"></i>
                                <!--                                <span class="badge badge-info right">6</span>-->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php //if (\Yii::$app->user->can('usergroup/index')): ?>
                                <li class="nav-item">
                                    <a href="index.php?r=usergroup" class="nav-link usergroup">
                                        <i class="far fa-circlez nav-icon"></i>
                                        <p>กลุ่มผู้ใช้งาน</p>
                                    </a>
                                </li>
                            <?php //endif; ?>
                            <?php //if (\Yii::$app->user->can('user/index')): ?>
                                <li class="nav-item">
                                    <a href="index.php?r=user" class="nav-link user">
                                        <i class="far fa-circlez nav-icon"></i>
                                        <p>ผู้ใช้งาน</p>
                                    </a>
                                </li>
                            <?php //endif;?>

                            <?php //if (\Yii::$app->user->can('authitem/index')): ?>
                                <li class="nav-item">
                                    <a href="index.php?r=authitem" class="nav-link auth">
                                        <i class="far fa-circlez nav-icon"></i>
                                        <p>สิทธิ์การใช้งาน</p>
                                    </a>
                                </li>
                            <?php //endif;?>

                        </ul>
                    </li>
                <?php //if (\Yii::$app->user->can('dbbackup/backuplist')): ?>
                    <li class="nav-item has-treeview has-sub">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                สำรองข้อมูล
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="index.php?r=dbbackup/backuplist" class="nav-link dbbackup">
                                    <i class="far fa-file-archivex nav-icon"></i>
                                    <p>สำรองข้อมูล</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?r=dbrestore/restorepage" class="nav-link dbrestore">
                                    <i class="fa fa-uploadx nav-icon"></i>
                                    <p>กู้คืนข้อมูล</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php //endif;?>
                <?php //endif; ?>
                <?php //endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

        <?php endif; ?>

    </div>
    <!-- /.sidebar -->
</aside>

