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
                <h2><strong>Insert</strong> Survey</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li class="active">Insert Survey</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 "></div>
                <div class="col-md-6 portlets">
                    <div class="panel">
                        <div class="panel-header">
                            <h3><i class="icon-doc"></i> <strong>Form</strong> Buat Survey</h3>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <form class="form-horizontal" method="post">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12 m-b-10">
                                                <label>Nama Survey</label>
                                                <input type="text" class="form-control form-white" placeholder="Nama Survey">
                                            </div>
                                            <div class="col-md-12 m-b-10">
                                                <label>Deskripsi Survey</label>
                                                <textarea type="text" class="form-control form-white" placeholder="Deskripsi Survey"></textarea>
                                            </div>
                                            <div class="col-md-12 m-b-10">
                                                <label>Target Responden</label>
                                                <select class="form-control">
                                                    <option value="Test1">Test 1</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 m-b-10">
                                                <label>Status</label>
                                                <select class="form-control">
                                                    <option value="Test1">Test 1</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 m-b-10">
                                                <label>Periode Survey</label>
                                                <input type="date" class="form-control form-white input-sm" placeholder="Periode Survey">
                                            </div>
                                            <div class="col-md-12 m-b-10">
                                                <label>Periode Survey Akhir</label>
                                                <input type="date" class="form-control form-white input-sm" placeholder="Periode Akhir Survey">
                                            </div>
                                            <div class="col-md-12 m-b-10 m-t-10">
                                                <button class="btn btn-primary" name="btnBuatSurvey">Buat Survey</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 "></div>
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
        <!-- END PAGE CONTENT -->
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
<script src="./assets/global/plugins/switchery/switchery.min.js"></script> <!-- IOS Switch -->
<script src="./assets/global/plugins/bootstrap-tags-input/bootstrap-tagsinput.min.js"></script> <!-- Select Inputs -->
<script src="./assets/global/plugins/dropzone/dropzone.min.js"></script>  <!-- Upload Image & File in dropzone -->
<script src="./assets/global/js/pages/form_icheck.js"></script>  <!-- Change Icheck Color - DEMO PURPOSE - OPTIONAL -->
<!-- END PAGE SCRIPT -->
<script src="./assets/admin/layout4/js/layout.js"></script>
</body>