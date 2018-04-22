<?php

session_start();

require_once('tcpdf_include_responden.php');

include_once "../../utility/koneksi.php";
include_once '../../dao/RespondenDao.php';
include_once '../../model/User.php';
include_once '../../model/Responden.php';


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("Admin");
$pdf->SetTitle('Laporan Responden');
$pdf->SetSubject('Laporan Responden');
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

$respondenDao = new RespondenDao();
$user = $respondenDao->getAllRespondenFilterPerusahaan($_GET['id'])->getIterator();

$i = 1;
$tgl = date("l, d F Y");

$html = "<style>"
    . "table.first {"
    . "color: BLACK;"
    . "font-family: helvetica;"
    . "font-size: 10pt;"
    . "border-left: 3px solid black;"
    . "border-right: 3px solid #black;"
    . "border-top: 3px solid black;"
    . "border-bottom: 3px solid black;"
    . "background-color: #red;"
    . "padding:5px 5px 5px 5px;"
    . "}"
    . ""
    . "td {"
    . "background-color: #f6f6f6;"
//                . "border-left: 1px solid black;"
//                . "border-right: 1px solid black;"
    . "border-top: 1px solid #7e7e7e;"
    . "border-bottom: 1px solid #7e7e7e;"
    . "}"
    . ""
    . "th{"
    . "background-color: #D3D3D3;"
    . "padding-left:100px;"
    . "border-top: 1px solid #7e7e7e;"
    . "border-bottom: 1px solid #7e7e7e;"
    . "}"
    . ""
    . ".bg{"
    . "background-color: #D3D3D3;"
    . "}"
    . "</style>"
    . "<div>"
    . "<span style='text-align:center'>Tanggal Laporan : " . $tgl . " </span>"
    . "<br>"
    . "</div>"
    . "<table class='first'>"
    . "<tr>"
    . "<th>    No.</th>"
    . "<th>    Nama Responden</th>"
    . "<th>    Jabatan</th>"
    . "<th>    Nama Perusahaan</th>"
    . "<th>    No Telepon</th>"
    . "<th>    Email</th>"
    . "</tr>";
while ($user->valid()) {
    $html = $html . "<tr>";
    $html = $html . "<td>  " . $i . "</td>";
    $html = $html . "<td>  " . $user->current()->getIdUser()->getNama() . "</td>";
    $html = $html . "<td>  " . $user->current()->getJabatan() . "</td>";
    $html = $html . "<td>  " . $user->current()->getNamaPerusahaan() . "</td>";
    $html = $html . "<td>  " . $user->current()->getIdUser()->getNomorTelepon() . "</td>";
    $html = $html . "<td>  " . $user->current()->getIdUser()->getEmail() . "</td>";
    $html = $html . "</tr>";
    $i++;
    $user->next();
}

$html = $html . "</table>";

$pdf->writeHTML($html, true, false, true, false, '');

//$tgl1 = $_GET['tanggalAwal'];
//$tgl2 = $_GET['tanggalAkhir'];
//
//$tgl1 = date("dFY", strtotime($tgl1));
//$tgl2 = date("dFY", strtotime($tgl2));

$pdf->Output('Laporan_Responden.pdf', 'I');