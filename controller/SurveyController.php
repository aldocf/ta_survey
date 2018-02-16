<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 12/28/2017
 * Time: 6:30 PM
 */

class SurveyController
{
    public function index()
    {

        require_once './view/survey/survey.php';
    }

    public function insert()
    {

        $_SESSION['survey'] = array();
        $_SESSION['nomor'] = 0;
        $_SESSION['soal'] = array();

        if (isset($_POST['btnBuatSurvey'])) {
            header('location:index.php?menu=insertPertanyaan');
        }

        require_once './view/survey/insert.php';
    }

    public function insertPertanyaan()
    {

//        if (isset($_GET['p'])) {
//            $_SESSION['nomor'] = $_GET['p'];
//        }
//
//        if (isset($_GET['del'])) {
//            array_splice($_SESSION['survey'], $_GET['del'] - 1, 1);
//            $_SESSION['nomor'] = count($_SESSION['survey']);
//            header('location:index.php?menu=insertPertanyaan');
//        }
//
//        if (isset($_POST['btnSingleTextBox'])) {
//            $_SESSION['nomor'] = count($_SESSION['survey']) + 1;
//            array_push($_SESSION['survey'], $this->addSingleTextBox());
//        }
//
//        if (isset($_POST['btnCommentBox'])) {
//            $_SESSION['nomor'] = count($_SESSION['survey']) + 1;
//            array_push($_SESSION['survey'], $this->addCommentBox());
//        }
//
//        if (isset($_POST['btnMultipleAnswer'])) {
//            $totalPilihan = $_POST['totalMultipleAnswer'];
//
//            if (isset($_POST['lainnyaMultipleAnswer'])) {
//                $lainnya = TRUE;
//            } else {
//                $lainnya = FALSE;
//            }
//
//            $_SESSION['nomor'] = count($_SESSION['survey']) + 1;
//            array_push($_SESSION['survey'], $this->addMultipleAnswer($totalPilihan, $lainnya));
//        }
//
//        if (isset($_POST['btnMultipleChoice'])) {
//            $totalPilihan = $_POST['totalMultipleChoice'];
//
//            if (isset($_POST['lainnyaMultipleChoice'])) {
//                $lainnya = TRUE;
//            } else {
//                $lainnya = FALSE;
//            }
//
//            $_SESSION['nomor'] = count($_SESSION['survey']) + 1;
//            array_push($_SESSION['survey'], $this->addMultipleChoice($totalPilihan, $lainnya));
//        }
//
//        if (isset($_POST['btnMatrix'])) {
//            $baris = $_POST['totalBaris'];
//            $kolom = $_POST['totalKolom'];
//
//            $_SESSION['nomor'] = $_SESSION['nomor'] + 1;
//            array_push($_SESSION['survey'], $this->addMatrix($baris, $kolom));
//        }

        if(isset($_POST['btnSimpan'])){
            print_r($_POST);
        }

        require_once './view/survey/pertanyaan.php';
    }

    public function addSingleTextBox()
    {
        $line = '<div class="form-group"><div class="col-md-12"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control" value="SingleTextBox" readonly></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white"placeholder="Soal" name=""></div><div class="col-md-12 m-b-10"><label for="">Penjelasan</label><input type="text" class="form-control form-white"placeholder="Penjelasan"></div><div class="col-md-12 m-b-10"><label for="">Jawaban</label><input type="text" class="form-control" placeholder="Jawaban"disabled></div></div></div></div>';
        return $line;
    }

    public function addCommentBox()
    {
        $line = '<div class="form-group"><div class="col-md-12"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control" value="SingleTextBox" readonly></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white"placeholder="Soal"></div><div class="col-md-12 m-b-10"><label for="">Penjelasan</label><input type="text" class="form-control form-white"placeholder="Penjelasan"></div><div class="col-md-12 m-b-10"><label for="">Jawaban</label><textarea class="form-control" placeholder="Jawaban"disabled></textarea></div></div></div></div>';
        return $line;
    }

    public function addMultipleAnswer($totalPilihan, $lainnya)
    {
        $line = '<div class="form-group"><div class="col-md-12"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control"value="MultipleAnswer" readonly></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white"placeholder="Soal"></div><div class="col-md-12 m-b-20"><label for="">Penjelasan</label><input type="text" class="form-control form-white"placeholder="Penjelasan"></div>';

        for ($i = 1; $i <= $totalPilihan; $i++) {
            $line .= '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 6px; padding-left: 30px;"><input type="checkbox" class="form-control"disabled></div><div class="col-md-11"><input type="text" class="form-control form-white"placeholder="Jawaban ' . $i . '"></div></div>';
        }

        if ($lainnya) {
            $line .= '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 30px; padding-left: 30px;"><input type="checkbox" class="form-control"disabled></div><div class="col-md-11"><label for="">Lainnya</label><input type="text" class="form-control"placeholder="Jawaban Mereka" disabled></div></div>';
        }

        $line .= '</div></div></div>';

        return $line;
    }

    public function addMultipleChoice($totalPilihan, $lainnya)
    {
        $line = '<div class="form-group"><div class="col-md-12"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control"value="MultipleAnswer" readonly></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white"placeholder="Soal"></div><div class="col-md-12 m-b-20"><label for="">Penjelasan</label><input type="text" class="form-control form-white"placeholder="Penjelasan"></div>';

        for ($i = 1; $i <= $totalPilihan; $i++) {
            $line .= '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 6px; padding-left: 30px;"><input type="radio" class="form-control"disabled></div><div class="col-md-11"><input type="text" class="form-control form-white"placeholder="Jawaban ' . $i . '"></div></div>';
        }

        if ($lainnya) {
            $line .= '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 30px; padding-left: 30px;"><input type="radio" class="form-control"disabled></div><div class="col-md-11"><label for="">Lainnya</label><input type="text" class="form-control"placeholder="Jawaban Mereka" disabled></div></div>';
        }

        $line .= '</div></div></div>';

        return $line;
    }

    public function addMatrix($baris, $kolom)
    {
        $line = '<div class="form-group"><div class="col-md-12"><div class="form-group"><div class="col-md-12 m-b-10 hidden"><label for="">Tipe Soal</label><input type="text" class="form-control"value="SingleTextBox" readonly></div><div class="col-md-12 m-b-10"><label for="">Soal</label><input type="text" class="form-control form-white"placeholder="Soal"></div><div class="col-md-12 m-b-10"><label for="">Penjelasan</label><input type="text" class="form-control form-white"placeholder="Penjelasan"></div><div class="col-md-12 m-b-10"><label for="">Baris</label>';

        for ($i = 1; $i <= $baris; $i++) {
            $line .= '<input type="text" class="form-control m-b-10 form-white"placeholder="Baris ' . $i . '">';
        }

        $line .= '</div><div class="col-md-12 m-b-10"><label for="">Kolom</label>';

        for ($i = 1; $i <= $kolom; $i++) {
            $line .= '<input type="text" class="form-control m-b-10 form-white"placeholder="Kolom ' . $i . '">';
        }

        $line .= '</div></div></div></div>';

        return $line;
    }

    public function initSoal($tipeSoal)
    {
        if ($tipeSoal == 1) {
            $pertanyaan = new Pertanyaan();
            array_push($_SESSION['soal'], $pertanyaan);
        }
    }
}