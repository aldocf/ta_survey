<?php

session_start();

require_once('tcpdf_include_1.php');

include_once "../../_utility/koneksi.php";
include_once '../../_dao/PemesananMasterInterface.php';
include_once '../../_dao/PemesananMasterDao.php';
include_once '../../_dao/PemesananMaster.php';
include_once '../../_dao/PemesananDetil.php';
include_once '../../_dao/Pegawai.php';


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($_SESSION['nama_pegawai']);
$pdf->SetTitle('Laporan Pemesanan');
$pdf->SetSubject('Laporan Pemesanan');
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
$pdf->SetFont('helvetica', '', 8);

$tgl1 = $_GET['tanggalAwal'];
$tgl2 = $_GET['tanggalAkhir'];

$pemesananMasterDao = new PemesananMasterDao();
$pemesanan = $pemesananMasterDao->getAllPemesananMasterByDate($tgl1, $tgl2)->getIterator();

$i = 1;
$tgl1 = date("l, d F Y", strtotime($tgl1));
$tgl2 = date("l, d F Y", strtotime($tgl2));

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
        . ""
        . "<div>"
            . "<br><span style='text-align:center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $tgl1 . " - " . $tgl2 . " </span>"
        . "</div>"
        . "<br>"
        . "<table class='first'>"
            . "<tr>"
                . "<th><b>    No.</b></th>"
                . "<th><b>    ID Pemesanan</b></th>"
                . "<th><b>    PIC</b></th>"
                . "<th><b>    Nama Proyek</b></th>"
                . "<th><b>    Nama Pelanggan</b></th>"
                . "<th><b>    Qty</b></th>"
                . "<th><b>    Tanggal Pesanan</b></th>"
                . "<th><b>    Tanggal Mulai</b></th>"
                . "<th><b>    Tanggal Selesai</b></th>"
                . "<th><b>    Status Proyek</b></th>"
            . "</tr>";
            while ($pemesanan->valid()){
                $html = $html ."<tr>";
                $html = $html ."<td>  ".$i."</td>";
                
                $date = date_create($pemesanan->current()->getPemesananMaster()->getTanggalPesanan());
                $id = "ORD - " . date_format($date, "dmY") . " - " . $pemesanan->current()->getPemesananMaster()->getIdPemesananMaster();
                $html = $html ."<td>  ".$id."</td>";
                
                $html = $html ."<td>  ".$pemesanan->current()->getPemesananMaster()->getPegawai()."</td>";
                $html = $html ."<td>  ".$pemesanan->current()->getNamaProyek()."</td>";
                $html = $html ."<td>  ".$pemesanan->current()->getPemesananMaster()->getPelanggan()."</td>";
                $html = $html ."<td>  ".$pemesanan->current()->getQty()." Pcs</td>";
                $html = $html ."<td>  ".date("d - F - Y", strtotime($pemesanan->current()->getPemesananMaster()->getTanggalPesanan()))."</td>";
                
                if ($pemesanan->current()->getPemesananMaster()->getTanggalMulaiProyek() != "") {
                    $date = date_create($pemesanan->current()->getPemesananMaster()->getTanggalMulaiProyek());
                    $html = $html ."<td>  ".date("d - F - Y", strtotime($pemesanan->current()->getPemesananMaster()->getTanggalMulaiProyek()))."</td>";
                } else {
                    $html = $html ."<td> - </td>";
                }
                
                if ($pemesanan->current()->getTanggalSelesai() != "") {
                    $date = date_create($pemesanan->current()->getTanggalSelesai());
                    $html = $html ."<td>  ".date("d - F - Y", strtotime($pemesanan->current()->getTanggalSelesai()))."</td>";
                } else {
                    $html = $html ."<td> - </td>";
                }
                
                $html = $html ."<td>  ".$pemesanan->current()->getStatus()."</td>";
                $html = $html ."</tr>";
                $i++;
                $pemesanan->next();
            }
            
            $html = $html ."</table>";

$pdf->writeHTML($html, true, false, true, false, '');

$tgl1 = $_GET['tanggalAwal'];
$tgl2 = $_GET['tanggalAkhir'];

$tgl1 = date("dFY", strtotime($tgl1));
$tgl2 = date("dFY", strtotime($tgl2));

$pdf->Output('Laporan_Pemesanan_'.$tgl1.' - '.$tgl2.'.pdf', 'I');
