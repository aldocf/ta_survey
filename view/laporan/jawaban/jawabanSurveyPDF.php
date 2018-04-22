<?php

session_start();

include_once "../../../utility/koneksi.php";
include_once '../../../dao/SurveyDao.php';
include_once '../../../dao/JawabanDao.php';
include_once '../../../model/Survey.php';
include_once '../../../model/Pertanyaan.php';
include_once '../../../model/Jawaban.php';
include_once '../../../model/User.php';
include_once '../../../model/Responden.php';

$surveyDao = new SurveyDao();
$jawabanDao = new JawabanDao();

$survey = $surveyDao->getSurvey($_GET['id']);
$pertanyaan = $surveyDao->getSurveyAllPertanyaan($_GET['id'])->getIterator();

$soal = "";
while ($pertanyaan->valid()) {

    if ($pertanyaan->current()->getTipeSoal() == "SingleTextBox") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Single Text Box</td></tr></table><table class="table table-hover table-dynamic" style="width: 100% !important; margin-bottom: 40px !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }

        $soal = $soal . '</tbody></table></div></div></div>';
    } else if ($pertanyaan->current()->getTipeSoal() == "CommentBox") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Comment Box</td></tr></table><table class="table table-hover table-dynamic" style="width: 100% !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }

        $soal = $soal . '</tbody></table></div></div></div>';
    } else if ($pertanyaan->current()->getTipeSoal() == "MultipleAnswer") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Multiple Answer</td></tr></table><table class="table table-hover table-dynamic" style="width: 100% !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }
        $soal = $soal . '</tbody></table></div></div></div>';

    } else if ($pertanyaan->current()->getTipeSoal() == "MultipleChoice") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Multiple Choice</td></tr></table><table class="table table-hover table-dynamic" style="width: 100% !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }
        $soal = $soal . '</tbody></table></div></div></div>';
    } else if ($pertanyaan->current()->getTipeSoal() == "Matrix") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Matrix</td></tr></table><table class="table table-hover table-dynamic" style="width: 100% !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }
        $soal = $soal . '</tbody></table></div></div></div>';
    }

    $pertanyaan->next();
}
?>
<head>
    <title>Jawaban PDF</title>
    <link href="../../../assets/global/css/style.css" rel="stylesheet">
    <link href="../../../assets/global/css/theme.css" rel="stylesheet">
    <link href="../../../assets/global/css/ui.css" rel="stylesheet">
    <link href="../../../assets/admin/layout4/css/layout.css" rel="stylesheet">
</head>

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

<div class="col-md-12" style="border-bottom: 1px solid black; padding-bottom: 80px">
    <div style="float: left">
        <img src="../../../assets/global/images/logo/logo_new.png" alt="" width="100px">
    </div>
    <div style="float: left; margin-left: 160px">
        <h2 style="font-weight: 700; font-size: 35px; margin-top: 5px">Laporan Jawaban</h2>
    </div>
</div>
<div class="col-md-12" style="margin-top: 5px;  margin-left: -12px">
    <span>Tanggal Laporan : <?php echo date("l, d F Y");?></span>
</div>

<div class="panel-content" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 40px; margin-left: 30px">
            <h2><b><?php echo $survey->getNamaSurvey(); ?></b></h2>
            <h3><?php echo $survey->getDeskripsiSurvey(); ?></h3>
        </div>
        <div class="col-md-12">
            <div id="form-js">
                <?php echo $soal; ?>
            </div>
        </div>
    </div>
</div>

</body>

<script>
    window.print();
</script>
