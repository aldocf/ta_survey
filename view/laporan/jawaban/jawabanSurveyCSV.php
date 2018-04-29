<?php

session_start();

include "simple_html_dom.php";
include_once "../../../utility/koneksi.php";
include_once '../../../dao/SurveyDao.php';
include_once '../../../dao/JawabanDao.php';
include_once '../../../model/Survey.php';
include_once '../../../model/Pertanyaan.php';
include_once '../../../model/Jawaban.php';
include_once '../../../model/User.php';
include_once '../../../model/Responden.php';
include_once '../../../model/Baris.php';

$surveyDao = new SurveyDao();
$jawabanDao = new JawabanDao();

$responden = $surveyDao->getAllRespondenFromSurvey($_GET['id'])->getIterator();

$table = '<table>';
$count = 0;
while ($responden->valid()) {
    if ($count == 0) {

        //region HEADER TABLE
        $jawaban = $surveyDao->getAllJawabanByResponden($_GET['id'], $responden->current()->getIdResponden())->getIterator();
        $table = $table . '<tr>';
        $temp = "";
        $countJawabanHeader = 0;
        while ($jawaban->valid()) {
            if ($jawaban->current()->getIdBaris()->getIsiBaris() == null) {
                if ($countJawabanHeader == 0) {
                    $table = $table . '<th>';
                    $temp = $jawaban->current()->getPertanyaan()->getPertanyaan();
                    $table = $table . $jawaban->current()->getPertanyaan()->getPertanyaan();
                    $table = $table . '</th>';
                } else {
                    if ($temp != $jawaban->current()->getPertanyaan()->getPertanyaan()) {
                        $table = $table . '<th>';
                        $table = $table . $jawaban->current()->getPertanyaan()->getPertanyaan();
                        $table = $table . '</th>';
                    }
                    $temp = $jawaban->current()->getPertanyaan()->getPertanyaan();
                }
            } else {
                $table = $table . '<th>';
                $table = $table . $jawaban->current()->getPertanyaan()->getPertanyaan() . "[" . $jawaban->current()->getIdBaris()->getIsiBaris() . "]";
                $table = $table . '</th>';
            }
            $countJawabanHeader++;
            $jawaban->next();
        }
        $table = $table . '</tr>';
        //endregion

        //region CONTENT BODY

        $jawaban = $surveyDao->getAllJawabanByResponden($_GET['id'], $responden->current()->getIdResponden())->getIterator();
        $table = $table . '<tr>';
        $temp = "";
        $countJawaban = 0;
        $jawabanSama = 0;
        while ($jawaban->valid()) {
            $table = $table . '<td>';
            if ($jawaban->current()->getIdBaris()->getIsiBaris() == null) {
                if ($countJawaban == 0) {
                    $temp = $jawaban->current()->getPertanyaan()->getPertanyaan();
                    $table = $table . $jawaban->current()->getIsiJawaban();
                    $table = $table . '</td>';
                } else {
                    if ($temp != $jawaban->current()->getPertanyaan()->getPertanyaan()) {
                        $table = $table . $jawaban->current()->getIsiJawaban();
                        $table = $table . '</td>';
                        $jawabanSama++;
                    } else {
                        $table = substr($table, 0, strlen($table) - 9);
                        $table = $table . ';' . $jawaban->current()->getIsiJawaban();
                        $table = $table . '</td>';
                    }
                    $temp = $jawaban->current()->getPertanyaan()->getPertanyaan();
                }
            } else {
                $table = $table . $jawaban->current()->getIsiJawaban();
                $table = $table . '</td>';
            }
            $countJawaban++;
            $jawaban->next();
        }
        $table = $table . '</tr>';
        //endregion

    } else {
        //region CONTENT BODY

        $jawaban = $surveyDao->getAllJawabanByResponden($_GET['id'], $responden->current()->getIdResponden())->getIterator();
        $table = $table . '<tr>';
        $temp = "";
        $countJawaban = 0;
        $jawabanSama = 0;
        while ($jawaban->valid()) {
            $table = $table . '<td>';
            if ($jawaban->current()->getIdBaris()->getIsiBaris() == null) {
                if ($countJawaban == 0) {
                    $temp = $jawaban->current()->getPertanyaan()->getPertanyaan();
                    $table = $table . $jawaban->current()->getIsiJawaban();
                    $table = $table . '</td>';
                } else {
                    if ($temp != $jawaban->current()->getPertanyaan()->getPertanyaan()) {
                        $table = $table . $jawaban->current()->getIsiJawaban();
                        $table = $table . '</td>';
                        $jawabanSama++;
                    } else {
                        $table = substr($table, 0, strlen($table) - 9);
                        $table = $table . ';' . $jawaban->current()->getIsiJawaban();
                        $table = $table . '</td>';
                    }
                    $temp = $jawaban->current()->getPertanyaan()->getPertanyaan();
                }
            } else {
                $table = $table . $jawaban->current()->getIsiJawaban();
                $table = $table . '</td>';
            }
            $countJawaban++;
            $jawaban->next();
        }
        $table = $table . '</tr>';
        //endregion
    }
    $count++;
    $responden->next();
}

$table = $table . '</table>';

$html = str_get_html($table);

header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=jawaban_survey.csv');

$fp = fopen("php://output", "w");

foreach($html->find('tr') as $element)
{
    $td = array();
    foreach( $element->find('th') as $row)
    {
        $td [] = $row->plaintext;
    }
    fputcsv($fp, $td);

    $td = array();
    foreach( $element->find('td') as $row)
    {
        $td [] = $row->plaintext;
    }
    fputcsv($fp, $td);
}
fclose($fp);