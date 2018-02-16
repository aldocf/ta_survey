<body class="sidebar-top fixed-topbar fixed-sidebar theme-sdtl color-default">

<section>
    <?php
    include_once 'sidebar.php';
    ?>

    <div class="main-content">

        <?php
        include_once 'topbar.php';
        ?>
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
            <div class="header">
                <h2><strong>My</strong> Profile</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li class="active">My Profile</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="panel">
                                <div class="panel-header">
                                    <h3>Update <strong>profile</strong></h3>
                                </div>
                                <div class="panel-content">
                                    <ul class="nav nav-tabs nav-primary">
                                        <li class="active"><a href="#tab2_1" data-toggle="tab"><i class="icon-user"></i>
                                                Profile</a>
                                        </li>
                                        <li class=""><a href="#tab2_2" data-toggle="tab"><i class="icon-lock"></i>
                                                Change Password</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="tab2_1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="form-horizontal" method="post">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-md-12 m-b-10">
                                                                    <label>Nama</label>
                                                                    <input type="text" class="form-control form-white"
                                                                           placeholder="Nama"
                                                                           name="nama" required
                                                                           value="<?php echo $data->getNama(); ?>">
                                                                </div>
                                                                <div class="col-md-12 m-b-10">
                                                                    <label>Nomor Telepon</label>
                                                                    <input type="number" class="form-control form-white"
                                                                           placeholder="Nomor Telepon" name="telepon"
                                                                           required value="<?php echo $data->getNomorTelepon(); ?>">
                                                                </div>
                                                                <div class="col-md-12 m-b-10">
                                                                    <label>Email</label>
                                                                    <input type="email" class="form-control form-white"
                                                                           placeholder="Email"
                                                                           name="email" required
                                                                           value="<?php echo $data->getEmail(); ?>">
                                                                </div>
                                                                <div class="col-md-12 m-t-10">
                                                                    <button class="btn btn-primary" name="btnInsert">
                                                                        Update Profile
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab2_2">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form class="form-horizontal" method="post">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-md-12 m-b-10">
                                                                    <label>Old Password</label>
                                                                    <input type="password"
                                                                           class="form-control form-white"
                                                                           placeholder="Old Password" name="password"
                                                                           required>
                                                                </div>
                                                                <div class="col-md-12 m-b-10">
                                                                    <label>New Password</label>
                                                                    <input type="password"
                                                                           class="form-control form-white"
                                                                           placeholder="New Password" name="password"
                                                                           required>
                                                                </div>
                                                                <div class="col-md-12 m-b-10">
                                                                    <label>Confirm Password</label>
                                                                    <input type="password"
                                                                           class="form-control form-white"
                                                                           placeholder="Confirm Password"
                                                                           name="re-password" required>
                                                                </div>
                                                                <div class="col-md-12 m-t-10">
                                                                    <button class="btn btn-primary" name="btnInsert">
                                                                        Change Password
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="copyright">
                    <p class="pull-left sm-pull-reset">
                        <span>Copyright <span class="copyright">©</span> 2016 </span>
                        <span>THEMES LAB</span>.
                        <span>All rights reserved. </span>
                    </p>
                    <p class="pull-right sm-pull-reset">
                        <span><a href="#" class="m-r-10">Support</a> | <a href="#"
                                                                          class="m-l-10 m-r-10">Terms of use</a> | <a
                                    href="#" class="m-l-10">Privacy Policy</a></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</section>
<!-- BEGIN PRELOADER -->
<div class="loader-overlay">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!-- END PRELOADER -->
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
<script src="./assets/global/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="./assets/global/plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
<script src="./assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="./assets/global/plugins/gsap/main-gsap.min.js"></script>
<script src="./assets/global/plugins/tether/js/tether.min.js"></script>
<script src="./assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/global/plugins/bootstrap/js/jasny-bootstrap.min.js"></script>

<script src="./assets/global/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
<script src="./assets/global/plugins/jquery-block-ui/jquery.blockUI.min.js"></script>
<!-- simulate synchronous behavior when using AJAX -->
<script src="./assets/global/plugins/bootbox/bootbox.min.js"></script> <!-- Modal with Validation -->
<script src="./assets/global/plugins/mcustom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Custom Scrollbar sidebar -->
<script src="./assets/global/plugins/bootstrap-dropdown/bootstrap-hover-dropdown.min.js"></script>
<!-- Show Dropdown on Mouseover -->
<script src="./assets/global/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->
<script src="./assets/global/plugins/retina/retina.min.js"></script> <!-- Retina Display -->
<script src="./assets/global/plugins/select2/dist/js/select2.full.min.js"></script> <!-- Select Inputs -->
<script src="./assets/global/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->
<script src="./assets/global/plugins/backstretch/backstretch.min.js"></script> <!-- Background Image -->
<script src="./assets/global/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- Animated Progress Bar -->
<script src="./assets/global/plugins/charts-chartjs/Chart.min.js"></script>
<script src="./assets/global/js/builder.js"></script> <!-- Theme Builder -->
<script src="./assets/global/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
<script src="./assets/global/js/application.js"></script> <!-- Main Application Script -->
<script src="./assets/global/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
<script src="./assets/global/js/widgets/notes.js"></script> <!-- Notes Widget -->
<script src="./assets/global/js/quickview.js"></script> <!-- Chat Script -->
<script src="./assets/global/js/pages/search.js"></script> <!-- Search Script -->
<!-- BEGIN PAGE SCRIPT -->
<script src="./assets/global/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
<script src="./assets/global/js/pages/notifications.js"></script>
<script src="./assets/global/plugins/switchery/switchery.min.js"></script> <!-- IOS Switch -->
<script src="./assets/global/plugins/bootstrap-tags-input/bootstrap-tagsinput.min.js"></script> <!-- Select Inputs -->
<script src="./assets/global/plugins/dropzone/dropzone.min.js"></script>  <!-- Upload Image & File in dropzone -->
<script src="./assets/global/js/pages/form_icheck.js"></script>  <!-- Change Icheck Color - DEMO PURPOSE - OPTIONAL -->
<!-- END PAGE SCRIPT -->
<script src="./assets/admin/layout4/js/layout.js"></script>
</body>

<script>
    $(document).ready(function () {
        <?php
        if ($msg == 1) {
            echo "makeAlert('danger', 'Insert Failed!', 'Password dan Confirm Password tidak sama.')";
        } else if ($msg == 2) {
            echo "makeAlert('danger', 'Insert Failed!', 'Email sudah tersedia.')";
        } else if ($msg == 3) {
            echo "makeAlert('danger', 'Insert Failed!', 'Terjadi kesalahan didalam database.')";
        }
        ?>
    });
</script>