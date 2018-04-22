<?php

session_start();

require_once('tcpdf_include_survey.php');

include_once "../../utility/koneksi.php";
include_once '../../dao/SurveyDao.php';
include_once '../../dao/JawabanDao.php';
include_once '../../model/Survey.php';
include_once '../../model/Pertanyaan.php';
include_once '../../model/Jawaban.php';
include_once '../../model/User.php';
include_once '../../model/Responden.php';


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("Admin");
$pdf->SetTitle('Laporan Jawaban');
$pdf->SetSubject('Laporan Jawaban');
$pdf->SetKeywords('PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);

$surveyDao = new SurveyDao();
$jawabanDao = new JawabanDao();

$i = 1;


$survey = $surveyDao->getSurvey($_GET['id']);
$pertanyaan = $surveyDao->getSurveyAllPertanyaan($_GET['id'])->getIterator();

//region CREATE SOAL
$soal = "";
while ($pertanyaan->valid()) {

    if ($pertanyaan->current()->getTipeSoal() == "SingleTextBox") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Single Text Box</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }

        $soal = $soal . '</tbody></table></div></div></div>';
    } else if ($pertanyaan->current()->getTipeSoal() == "CommentBox") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Comment Box</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }

        $soal = $soal . '</tbody></table></div></div></div>';
    } else if ($pertanyaan->current()->getTipeSoal() == "MultipleAnswer") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Multiple Answer</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }
        $soal = $soal . '</tbody></table></div></div></div>';

    } else if ($pertanyaan->current()->getTipeSoal() == "MultipleChoice") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Multiple Choice</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }
        $soal = $soal . '</tbody></table></div></div></div>';
    } else if ($pertanyaan->current()->getTipeSoal() == "Matrix") {
        $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Matrix</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
        $jawaban = $jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

        while ($jawaban->valid()) {
            $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
            $jawaban->next();
        }
        $soal = $soal . '</tbody></table></div></div></div>';
    }

    $pertanyaan->next();
}


$pdf->writeHTML($soal, true, false, true, false, '');

//$tgl1 = $_GET['tanggalAwal'];
//$tgl2 = $_GET['tanggalAkhir'];
//
//$tgl1 = date("dFY", strtotime($tgl1));
//$tgl2 = date("dFY", strtotime($tgl2));

$pdf->Output('Laporan_Survey.pdf', 'I');