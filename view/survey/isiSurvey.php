<script>

    var countGlobal = 0;
    var countElement = 0;

    // function selectPage() {
    //     var p = document.getElementById("pages").value;
    //
    //     window.location = "index.php?menu=insertPertanyaan&p=" + p;
    // }
    //
    // function deletePage() {
    //     var p = document.getElementById("pages").value;
    //
    //     window.location = "index.php?menu=insertPertanyaan&del=" + p;
    // }

    function addFormSingleTextBox() {
        var c = countGlobal
        c = c + 1;
        var txt1 = '<div class="form-group" id="form' + c + '"><div class="col-md-12"><div class="col-md-1"><label><div id="number' + c + '"></div></label></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control" value="SingleTextBox" readonly name="type[]"></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white" placeholder="Soal" name="soal[]" required></div><div class="col-md-12 m-b-10"><label for="">Penjelasan</label><input type="text" class="form-control form-white" placeholder="Penjelasan" name="penjelasan[]" required></div><div class="col-md-12 m-b-10"><label for="">Jawaban</label><input type="text" class="form-control" placeholder="Jawaban" disabled></div><div class="col-md-12 m-b-10"><a class="btn btn-danger" onclick="deleteRow(' + c + ')">Hapus Soal</a></div></div></div></div></div>';
        $("#form-js").append(txt1);

        var number = "number" + c;
        document.getElementById(number).innerHTML = parseInt(countElement + 1) + ".";

        countGlobal = countGlobal + 1;
        countElement = countElement + 1;
    }

    function addFormCommentBox() {
        var c = countGlobal;
        c = c + 1;
        var txt1 = '<div class="form-group" id="form' + c + '"><div class="col-md-12"><div class="col-md-1"><label><div id="number' + c + '"></div></label></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control" value="CommentBox" readonly name="type[]"></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white" placeholder="Soal" name="soal[]" required></div><div class="col-md-12 m-b-10"><label for="">Penjelasan</label><input type="text" class="form-control form-white" placeholder="Penjelasan" name="penjelasan[]" required></div><div class="col-md-12 m-b-10"><label for="">Jawaban</label><textarea class="form-control" placeholder="Jawaban" disabled rows="5"></textarea></div><div class="col-md-12 m-b-10"><a class="btn btn-danger" onclick="deleteRow(' + c + ')">Hapus Soal</a></div></div></div></div></div>';
        $("#form-js").append(txt1);

        var number = "number" + c;
        document.getElementById(number).innerHTML = parseInt(countElement + 1) + ".";

        countGlobal = countGlobal + 1;
        countElement = countElement + 1;
    }

    function addFormMultipleAnswer() {
        var multipleAnswer = document.getElementsByName("totalMultipleAnswer")[0].value;
        var lainnya = document.getElementsByName("lainnyaMultipleAnswer")[0].checked;

        var c = countGlobal;
        c = c + 1;

        var txt1 = '<div class="form-group" id="form' + c + '"><div class="col-md-12"><div class="col-md-1"><label><div id="number' + c + '"></div></label></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control" value="MultipleAnswer" readonly name="type[]"><input type="text" class="form-control" value="' + multipleAnswer + '" readonly name="multiple_answer[]"></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white" placeholder="Soal" name="soal[]" required></div><div class="col-md-12 m-b-10"><label for="">Penjelasan</label><input type="text" class="form-control form-white" placeholder="Penjelasan" name="penjelasan[]" required></div>';

        for (var i = 1; i <= multipleAnswer; i++) {
            txt1 = txt1 + '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 6px; padding-left: 30px;"><input type="checkbox" class="form-control" disabled></div><div class="col-md-11"><input type="text" class="form-control form-white" placeholder="Jawaban ' + i + '" name="pilihan[]" required></div></div>';
        }

        if (lainnya) {
            txt1 = txt1 + '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 30px; padding-left: 30px;"><input type="checkbox" class="form-control" disabled></div><div class="col-md-11"><label for="">Lainnya</label><input type="text" class="form-control" placeholder="Jawaban Mereka" disabled></div></div>';
            txt1 = txt1 + '<div class="col-md-12 m-b-10 hidden"><label for="">Lainnya</label><input type="text" class="form-control" value="1" name="lainnya[]"></div>';
        } else {
            txt1 = txt1 + '<div class="col-md-12 m-b-10 hidden"><label for="">Lainnya</label><input type="text" class="form-control" value="0" name="lainnya[]"></div>';
        }

        txt1 = txt1 + '<div class="col-md-12 m-b-10"><a class="btn btn-danger" onclick="deleteRow(' + c + ')">Hapus Soal</a></div></div></div></div></div>';

        $("#form-js").append(txt1);

        var number = "number" + c;
        document.getElementById(number).innerHTML = parseInt(countElement + 1) + ".";

        countGlobal = countGlobal + 1;
        countElement = countElement + 1;
    }

    function addFormMultipleChoice() {
        var multipleChoice = document.getElementsByName("totalMultipleChoice")[0].value;
        var lainnya = document.getElementsByName("lainnyaMultipleChoice")[0].checked;

        var c = countGlobal;
        c = c + 1;

        var txt1 = '<div class="form-group" id="form' + c + '"><div class="col-md-12"><div class="col-md-1"><label><div id="number' + c + '"></div></label></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control" value="MultipleChoice" readonly name="type[]"><input type="text" class="form-control" value="' + multipleChoice + '" readonly name="multiple_choice[]"></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white" placeholder="Soal" name="soal[]" required></div><div class="col-md-12 m-b-10"><label for="">Penjelasan</label><input type="text" class="form-control form-white"placeholder="Penjelasan" name="penjelasan[]" required></div>';

        for (var i = 1; i <= multipleChoice; i++) {
            txt1 = txt1 + '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 6px; padding-left: 30px;"><input type="radio" class="form-control" disabled></div><div class="col-md-11"><input type="text" class="form-control form-white" placeholder="Jawaban ' + i + '" name="pilihan[]" required></div></div>';
        }

        if (lainnya) {
            txt1 = txt1 + '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 30px; padding-left: 30px;"><input type="radio" class="form-control" disabled></div><div class="col-md-11"><label for="">Lainnya</label><input type="text" class="form-control" placeholder="Jawaban Mereka" disabled ></div></div>';
            txt1 = txt1 + '<div class="col-md-12 m-b-10 hidden"><label for="">Lainnya</label><input type="text" class="form-control" value="1" name="lainnya[]"></div>';
        } else {
            txt1 = txt1 + '<div class="col-md-12 m-b-10 hidden"><label for="">Lainnya</label><input type="text" class="form-control" value="0" name="lainnya[]"></div>';
        }

        txt1 = txt1 + '<div class="col-md-12 m-b-10"><a class="btn btn-danger" onclick="deleteRow(' + c + ')">Hapus Soal</a></div></div></div></div></div>';

        $("#form-js").append(txt1);

        var number = "number" + c;
        document.getElementById(number).innerHTML = parseInt(countElement + 1) + ".";

        countGlobal = countGlobal + 1;
        countElement = countElement + 1;
    }

    function addFormMatrix() {
        var totalBaris = document.getElementsByName("totalBaris")[0].value;
        var totalKolom = document.getElementsByName("totalKolom")[0].value;

        var c = countGlobal;
        c = c + 1;

        var txt1 = '<div class="form-group" id="form' + c + '"><div class="col-md-12"><div class="col-md-1"><label><div id="number' + c + '"></div></label></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control" value="Matrix" readonly name="type[]"><input type="text" class="form-control" value="' + totalBaris + '" readonly name="total_baris[]"><input type="text" class="form-control" value="' + totalKolom + '" readonly name="total_kolom[]"></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white" placeholder="Soal" name="soal[]" required></div><div class="col-md-12 m-b-10"><label for="">Penjelasan</label><input type="text" class="form-control form-white" placeholder="Penjelasan" name="penjelasan[]" required></div><div class="col-md-12 m-b-10"><label for="">Baris</label>';

        for (var i = 1; i <= totalBaris; i++) {
            txt1 = txt1 + '<input type="text" class="form-control m-b-10 form-white" placeholder="Baris ' + i + '" name="baris[]" required>';
        }

        txt1 = txt1 + '</div><div class="col-md-12 m-b-10"><label for="">Kolom</label>';

        for (var i = 1; i <= totalKolom; i++) {
            txt1 = txt1 + '<input type="text" class="form-control m-b-10 form-white" placeholder="Kolom ' + i + '" name="kolom[]" required>';
        }


        txt1 = txt1 + '<div class="col-md-12 m-b-10"><a class="btn btn-danger" onclick="deleteRow(' + c + ')">Hapus Soal</a></div></div></div></div></div></div>';

        $("#form-js").append(txt1);

        var number = "number" + c;
        document.getElementById(number).innerHTML = parseInt(countElement + 1) + ".";

        countGlobal = countGlobal + 1;
        countElement = countElement + 1;
    }

    function deleteRow(c) {
        var variable = "form" + c;
        var parent = document.getElementById("form-js");
        var child = document.getElementById(variable);
        parent.removeChild(child);

        countElement = countElement - 1;

        var count = 1;
        for (var i = 1; i <= countGlobal; i++) {
            var number = "number" + parseInt(i);
            var obj = document.getElementById(number);
            if (obj != null) {
                document.getElementById("number" + parseInt(i)).innerHTML = parseInt(count) + ".";
                count = count + 1;
            }

        }
    }

</script>

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
                                <div class="col-md-12" style="margin-bottom: 50px">
                                    <h2><b><?php echo $survey->getNamaSurvey(); ?></b></h2>
                                    <h3><?php echo $survey->getDeskripsiSurvey(); ?></h3>
                                </div>
                                <form class="form-horizontal" method="post">
                                    <div class="col-md-12">
                                        <div id="form-js">
                                            <?php echo $soal; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-20">
                                        <button class="btn btn-success" name="btnSimpan">Simpan</button>
                                    </div>
                                </form>
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