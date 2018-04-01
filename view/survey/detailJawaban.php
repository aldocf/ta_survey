<style>
    .matrix td {
        padding: 10px;
    }

    .matrix th {
        padding: 10px;
    }

    .matrix-center {
        text-align: center;
    }

    .matrix {
        width: 100%;
    }

    .soal td {
        padding: 5px;
    }

    .soal th {
        padding: 5px;
    }

    .soal {
        margin-bottom: 20px;
    }
</style>

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
            <div class="row">
                <div class="col-md-1 portlets">
                </div>
                <div class="col-md-10 portlets">
                    <div class="panel" <?php //if (count($_SESSION['survey']) == 0) echo 'style="height: 319px"'; ?>>
                        <div class="panel-content">
                            <!--                            --><?php
                            //                            if (count($_SESSION['survey']) == 0) {
                            //                                echo '<h1 style="text-align: center;vertical-align: middle; margin-top: 84px;">Form Survey Kosong</h1>';
                            //                            } else {
                            //                                ?>
                            <div class="row">
                                <div class="col-md-12" style="margin-bottom: 20px">
                                    <h2><b><?php echo $survey->getNamaSurvey(); ?></b></h2>
                                    <h3><?php echo $survey->getDeskripsiSurvey(); ?></h3>
                                </div>
                                <div class="col-md-12">
                                    <div id="form-js">
<!--                                        <div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>1</td></tr><tr><td>Pertanyaan</td><td>:</td><td>AAAA</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Single</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody><tr><td>asdad</td><td>asdad</td></tr></tbody></table></div></div></div>-->
                                        <?php echo $soal; ?>
                                    </div>
                                </div>
                            </div>
                            <!--                                --><?php
                            //                            }
                            //                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 portlets">
                </div>
            </div>
            <?php include_once 'footer.php' ?>

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