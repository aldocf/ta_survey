<?php

session_start();

require_once('tcpdf_include.php');

include_once "../../_utility/koneksi.php";
include_once '../../_dao/PembelianMasterInterface.php';
include_once '../../_dao/PembelianMasterDao.php';
include_once '../../_dao/PembelianMaster.php';
include_once '../../_dao/BahanBaku.php';
include_once '../../_dao/PembelianDetil.php';


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($_SESSION['nama_pegawai']);
$pdf->SetTitle('Laporan Pembelian');
$pdf->SetSubject('Laporan Pembelian');
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

$pembelianMasterDao = new PembelianMasterDao();
$pembelian = $pembelianMasterDao->getAllPembelianMasterByDate($tgl1, $tgl2)->getIterator();

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
                . "<th>    No.</th>"
                . "<th>    ID Pembelian</th>"
                . "<th>    PIC</th>"
                . "<th>    Nama Bahan Baku</th>"
                . "<th>    Tanggal Pembelian</th>"
                . "<th>    Kuantitas</th>"
                . "<th>    Harga</th>"
                . "<th>    Sub Total</th>"
            . "</tr>";
            $total = 0;
            while ($pembelian->valid()){
                $html = $html ."<tr>";
                $html = $html ."<td>  ".$i."</td>";
                
                $date = date_create($pembelian->current()->getPembelianMaster()->getTanggalPembelian());
                $id = "PM - " . date_format($date, "dmY") . " - " . $pembelian->current()->getPembelianMaster()->getIdPembelianMaster();
                $html = $html ."<td>  ".$id."</td>";
                
                $html = $html ."<td>  ".$pembelian->current()->getPembelianMaster()->getPegawai()."</td>";
                $html = $html ."<td>  ".$pembelian->current()->getBahanBaku()->getNamaBahanBaku(). " - " . $pembelian->current()->getBahanBaku()->getWarnaBahanBaku() ."</td>";
                $html = $html ."<td>  ".date("d - F - Y", strtotime($pembelian->current()->getPembelianMaster()->getTanggalPembelian()))."</td>";
                $html = $html ."<td>  ".$pembelian->current()->getKuantitasPembelianDetil()." ".$pembelian->current()->getBahanBaku()->getSatuanBahanBaku()."</td>";
                $html = $html ."<td>  Rp. ".number_format((float) $pembelian->current()->getHargaPembelianDetil(), "2", ",", ".")."</td>";
                $html = $html ."<td>  Rp. ".number_format((float) $pembelian->current()->getSubTotalPembelian(), "2", ",", ".")."</td>";
                $total = $total + $pembelian->current()->getSubTotalPembelian();
                $html = $html ."</tr>";
                $i++;
                $pembelian->next();
            }
            $html = $html ."<tr>";
            $html = $html ."<td class=bg></td>";
            $html = $html ."<td></td>";
            $html = $html ."<td></td>";
            $html = $html ."<td><b>Total Pembelian</b></td>";
            $html = $html ."<td></td>";
            $html = $html ."<td></td>";
            $html = $html ."<td></td>";
            $html = $html ."<td><b>   Rp. ".number_format((float) $total, "2", ",", ".")."</b></td>";
            $html = $html ."</tr>";
            
            $html = $html ."</table>";

$pdf->writeHTML($html, true, false, true, false, '');

$tgl1 = $_GET['tanggalAwal'];
$tgl2 = $_GET['tanggalAkhir'];

$tgl1 = date("dFY", strtotime($tgl1));
$tgl2 = date("dFY", strtotime($tgl2));

$pdf->Output('Laporan_Pembelian_'.$tgl1.'-'.$tgl2.'.pdf', 'I');