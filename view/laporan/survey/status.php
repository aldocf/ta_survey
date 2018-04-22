<link href="./assets/global/plugins/datatables/dataTables.min.css" rel="stylesheet">

<body class="sidebar-top fixed-topbar fixed-sidebar theme-sdtl color-default">

<style>
    .select2-container {
        z-index: 0;
    }
</style>
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
                <h2>Laporan Survey By<strong> Status</strong></h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li class="active">Laporan Survey By Status</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <form class="form-horizontal" method="post">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12 m-b-10">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="-" selected disabled>- Pilih Status -
                                                    </option>
                                                    <?php if (isset($_GET['id'])) {
                                                        if ($_GET['id'] == 0) {
                                                            ?>
                                                            <option value="0" selected>Belum dimulai
                                                            </option>
                                                            <option value="1">Dimulai
                                                            </option>
                                                            <option value="2">Sudah beres
                                                            </option>
                                                            <?php
                                                        } else if ($_GET['id'] == 1) {
                                                            ?>
                                                            <option value="0">Belum dimulai
                                                            </option>
                                                            <option value="1" selected>Dimulai
                                                            </option>
                                                            <option value="2">Sudah beres
                                                            </option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="0">Belum dimulai
                                                            </option>
                                                            <option value="1">Dimulai
                                                            </option>
                                                            <option value="2" selected>Sudah beres
                                                            </option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="0">Belum dimulai
                                                        </option>
                                                        <option value="1">Dimulai
                                                        </option>
                                                        <option value="2">Sudah beres
                                                        </option>
                                                        <?php
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12 m-b-10 m-t-10">
                                                <button class="btn btn-primary" name="btnFilter">Filter
                                                </button>
                                                <?php
                                                if (isset($_GET['id'])) {
                                                    ?>
                                                    <a href="./TCPDF-master/examples/laporanSurvey1.php?id=<?php echo $_GET['id'] ?>"
                                                       target="_blank" class="btn btn-warning">Export PDF
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                                <a href="index.php?menu=indexLaporanSurvey" class="btn btn-danger">Kembali
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-content pagination2 table-responsive">
                            <table class="table table-hover table-dynamic">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Survey</th>
                                    <th>Deskripsi Survey</th>
                                    <th>Target Responden</th>
                                    <th>Periode Survey</th>
                                    <th>Periode Survey Akhir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($_GET['id'])) {
                                    $no = 1;
                                    while ($data->valid()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $data->current()->getNamaSurvey(); ?></td>
                                            <td><?php echo $data->current()->getDeskripsiSurvey(); ?></td>
                                            <td><?php echo $data->current()->getTargetResponden(); ?></td>
                                            <td><?php echo date_format(date_create($data->current()->getPeriodeSurvey()), "d F Y"); ?></td>
                                            <td><?php echo date_format(date_create($data->current()->getPeriodeSurveyAkhir()), "d F Y"); ?></td>
                                        </tr>
                                        <?php
                                        $no++;
                                        $data->next();
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
<!-- Tables Filtering, Sorting & Editing -->
<script src="./assets/global/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="./assets/global/js/pages/table_dynamic.js"></script>
<script src="./assets/global/plugins/noty/jquery.noty.packaged.min.js"></script>  <!-- Notifications -->
<script src="./assets/global/js/pages/notifications.js"></script>
<!-- END PAGE SCRIPTS -->
<script src="./assets/admin/layout4/js/layout.js"></script>
</body>

<script>
    $(document).ready(function () {
        <?php
        if ($msg == 1) {
            echo "makeAlert('success', 'Insert Success!', 'Data kategori berita telah dimasukan kedalam database.')";
        } else if ($msg == 2) {
            echo "makeAlert('success', 'Update Success!', 'Data kategori berita telah berhasil diubah.')";
        }
        ?>
    });
</script>