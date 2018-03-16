<link href="./assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">

<!-- BEGIN PAGE STYLE -->
<link href="./assets/global/plugins/magnific/magnific-popup.min.css" rel="stylesheet">
<link href="./assets/global/plugins/hover-effects/hover-effects.min.css" rel="stylesheet">
<!-- END PAGE STYLE -->

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
                <h2><strong>Berita</strong></h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li class="active">Berita</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 portlets">
                    <div class="panel panel-transparent">
                        <div class="panel-content">
                            <div class="portfolioFilter">
                                <a href="#" data-filter="*" class="current">Semua Kategori</a>
                                <?php
                                while ($kategori->valid()){
                                    ?>
                                    <a href="#" data-filter=".<?php echo $kategori->current()->getNamaKategori();?>"><?php echo $kategori->current()->getNamaKategori();?></a>
                                    <?php
                                    $kategori->next();
                                }
                                ?>
                            </div>
                            <div class="portfolioContainer grid">
                                <?php
                                while ($data->valid()){
                                    ?>
                                    <figure class="<?php echo $data->current()->getKategori();?> effect-zoe" onclick="window.location = 'index.php?menu=berita_s&id=<?php echo $data->current()->getIdBerita()?>'">
                                        <img src="./assets/img_berita/<?php echo $data->current()->getCover()?>" alt="Berita"/>
                                        <figcaption>
                                            <h2 style="word-spacing: normal; font-weight: 700">
                                                <?php
                                                if(strlen($data->current()->getJudul()) <= 40){
                                                    echo $data->current()->getJudul();
                                                } else {
                                                    echo substr($data->current()->getJudul(), 0, 36) . " ...";
                                                }
                                                ;?>
                                            </h2>
<!--                                            <p>-->
<!--                                                --><?php
//                                                echo html_entity_decode($data->current()->getDeskripsi());
//                                                ?>
<!--                                            </p>-->
                                        </figcaption>
                                    </figure>
                                    <?php
                                    $data->next();
                                }
                                ?>
                            </div>
                        </div>
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
<script src="./assets/global/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="./assets/global/plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
<script src="./assets/global/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="./assets/global/plugins/gsap/main-gsap.min.js"></script>
<script src="./assets/global/plugins/tether/js/tether.min.js"></script>
<script src="./assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/global/plugins/appear/jquery.appear.js"></script>
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
<!-- BEGIN PAGE SCRIPTS -->
<script src="./assets/global/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/global/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
<script src="./assets/global/js/pages/notifications.js"></script>
<!-- BEGIN PAGE SCRIPTS -->
<script src="./assets/global/plugins/magnific/jquery.magnific-popup.min.js"></script>  <!-- Image Popup -->
<script src="./assets/global/plugins/isotope/isotope.pkgd.min.js"></script>  <!-- Filter & sort magical Gallery -->
<!-- END PAGE SCRIPTS -->
<script>
    $(window).load(function(){
        var $container = $('.portfolioContainer');
        $container.isotope();
        $('.portfolioFilter a').click(function(){
            $('.portfolioFilter .current').removeClass('current');
            $(this).addClass('current');
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector
            });
            return false;
        });
    });
</script>
<script src="./assets/admin/layout4/js/layout.js"></script>
</body>

<script>
    $(document).ready(function () {
        <?php
        if ($msg == 1) {
            echo "makeAlert('success', 'Insert Success!', 'Admin telah dimasukan kedalam database.')";
        }
        ?>
    });
</script>