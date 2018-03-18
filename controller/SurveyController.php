<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 12/28/2017
 * Time: 6:30 PM
 */

class SurveyController
{

    private $surveyDao;
    private $pertanyaanDao;
    private $pilihanDao;
    private $barisDao;
    private $kolomDao;

    public function __construct()
    {
        $this->surveyDao = new SurveyDao();
        $this->pertanyaanDao = new PertanyaanDao();
        $this->pilihanDao = new PilihanDao();
        $this->barisDao = new BarisDao();
        $this->kolomDao = new KolomDao();
    }

    public function index()
    {

        require_once './view/survey/survey.php';
    }

    public function insert()
    {

        if (isset($_POST['btnBuatSurvey'])) {
            $namaSurvey = $_POST['nama_survey'];
            $deskripsi = $_POST['deskripsi'];
            $targetResponden = $_POST['target_responden'];
            $awal = $_POST['awal'];
            $akhir = $_POST['akhir'];
            header('location:index.php?menu=insertPertanyaan&namaSurvey=' . $namaSurvey . '&deskripsi=' . $deskripsi . '&targetResponden=' . $targetResponden . '&awal=' . $awal . '&akhir=' . $akhir);
        }

        require_once './view/survey/insert.php';
    }

    public function insertPertanyaan()
    {
        //region GA DIPAKE TAPI JANGAN DIHAPUS
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
        //endregion

        if (isset($_POST['btnSimpan'])) {

            $survey = new Survey();
            $survey->setNamaSurvey($_GET['namaSurvey']);
            $survey->setDeskripsiSurvey($_GET['deskripsi']);
            $survey->setTargetResponden($_GET['targetResponden']);
            $survey->setPeriodeSurvey($_GET['awal']);
            $survey->setPeriodeSurveyAkhir($_GET['akhir']);
            $this->surveyDao->insertSurvey($survey);

            $lastSurvey = $this->surveyDao->getLastIdSurvey($survey);

            $countChoice = 0;
            $countLainnya = 0;
            $countBaris = 0;
            $countKolom = 0;
            $soalMultipleAnswer = 0;
            $soalMultipleChoice = 0;
            $soalBaris = 0;
            $soalKolom = 0;
            for ($i = 0; $i < sizeof($_POST['type']); $i++) {
                if ($_POST['type'][$i] == "SingleTextBox") {
                    $pertanyaan = new Pertanyaan();
                    $pertanyaan->setPertanyaan($_POST['soal'][$i]);
                    $pertanyaan->setPenjelasan($_POST['penjelasan'][$i]);
                    $pertanyaan->setTipeSoal($_POST['type'][$i]);
                    $pertanyaan->setNomorPertanyaan($i + 1);
                    $pertanyaan->setSurvey($lastSurvey->getIdSurvey());
                    $this->pertanyaanDao->insertPertanyaan($pertanyaan);
                } else if ($_POST['type'][$i] == "CommentBox") {
                    $pertanyaan = new Pertanyaan();
                    $pertanyaan->setPertanyaan($_POST['soal'][$i]);
                    $pertanyaan->setPenjelasan($_POST['penjelasan'][$i]);
                    $pertanyaan->setTipeSoal($_POST['type'][$i]);
                    $pertanyaan->setNomorPertanyaan($i + 1);
                    $pertanyaan->setSurvey($lastSurvey->getIdSurvey());
                    $this->pertanyaanDao->insertPertanyaan($pertanyaan);
                } else if ($_POST['type'][$i] == "MultipleAnswer") {
                    $pertanyaan = new Pertanyaan();
                    $pertanyaan->setPertanyaan($_POST['soal'][$i]);
                    $pertanyaan->setPenjelasan($_POST['penjelasan'][$i]);
                    $pertanyaan->setTipeSoal($_POST['type'][$i]);
                    $pertanyaan->setNomorPertanyaan($i + 1);
                    $pertanyaan->setSurvey($lastSurvey->getIdSurvey());
                    $this->pertanyaanDao->insertPertanyaan($pertanyaan);

                    $lastPertanyaan = $this->pertanyaanDao->getLastIdPertanyaan($pertanyaan);

                    $k = 0;
                    while ($k < $_POST['multiple_answer'][$soalMultipleAnswer]) {
                        $pilihan = new Pilihan();
                        $pilihan->setPertanyaan($lastPertanyaan->getIdPertanyaan());
                        $pilihan->setPilihan($_POST['pilihan'][$countChoice]);
                        $pilihan->setIsLainnya(0);
                        $this->pilihanDao->insertPilihan($pilihan);
                        $countChoice = $countChoice + 1;
                        $k++;
                    }

                    if ($_POST['lainnya'][$countLainnya] == 1) {
                        $pilihan = new Pilihan();
                        $pilihan->setPertanyaan($lastPertanyaan->getIdPertanyaan());
                        $pilihan->setPilihan("Lainnya");
                        $pilihan->setIsLainnya(1);
                        $this->pilihanDao->insertPilihan($pilihan);
                    }
                    $countLainnya = $countLainnya + 1;
                    $soalMultipleAnswer = $soalMultipleAnswer + 1;
                } else if ($_POST['type'][$i] == "MultipleChoice") {
                    $pertanyaan = new Pertanyaan();
                    $pertanyaan->setPertanyaan($_POST['soal'][$i]);
                    $pertanyaan->setPenjelasan($_POST['penjelasan'][$i]);
                    $pertanyaan->setTipeSoal($_POST['type'][$i]);
                    $pertanyaan->setNomorPertanyaan($i + 1);
                    $pertanyaan->setSurvey($lastSurvey->getIdSurvey());
                    $this->pertanyaanDao->insertPertanyaan($pertanyaan);

                    $lastPertanyaan = $this->pertanyaanDao->getLastIdPertanyaan($pertanyaan);

                    $k = 0;
                    while ($k < $_POST['multiple_choice'][$soalMultipleChoice]) {
                        $pilihan = new Pilihan();
                        $pilihan->setPertanyaan($lastPertanyaan->getIdPertanyaan());
                        $pilihan->setPilihan($_POST['pilihan'][$countChoice]);
                        $pilihan->setIsLainnya(0);
                        $this->pilihanDao->insertPilihan($pilihan);
                        $countChoice = $countChoice + 1;
                        $k++;
                    }

                    if ($_POST['lainnya'][$countLainnya] == 1) {
                        $pilihan = new Pilihan();
                        $pilihan->setPertanyaan($lastPertanyaan->getIdPertanyaan());
                        $pilihan->setPilihan("Lainnya");
                        $pilihan->setIsLainnya(1);
                        $this->pilihanDao->insertPilihan($pilihan);
                    }
                    $countLainnya = $countLainnya + 1;
                    $soalMultipleChoice = $soalMultipleChoice + 1;
                } else if ($_POST['type'][$i] == "Matrix") {
                    $pertanyaan = new Pertanyaan();
                    $pertanyaan->setPertanyaan($_POST['soal'][$i]);
                    $pertanyaan->setPenjelasan($_POST['penjelasan'][$i]);
                    $pertanyaan->setTipeSoal($_POST['type'][$i]);
                    $pertanyaan->setNomorPertanyaan($i + 1);
                    $pertanyaan->setSurvey($lastSurvey->getIdSurvey());
                    $this->pertanyaanDao->insertPertanyaan($pertanyaan);

                    $lastPertanyaan = $this->pertanyaanDao->getLastIdPertanyaan($pertanyaan);

                    $k = 0;
                    while ($k < $_POST['total_baris'][$soalBaris]) {
                        $baris = new Baris();
                        $baris->setPertanyaan($lastPertanyaan->getIdPertanyaan());
                        $baris->setIsiBaris($_POST['baris'][$countBaris]);
                        $this->barisDao->insertBaris($baris);
                        $countBaris = $countBaris + 1;
                        $k++;
                    }

                    $k = 0;
                    while ($k < $_POST['total_kolom'][$soalKolom]) {
                        $kolom = new Kolom();
                        $kolom->setPertanyaan($lastPertanyaan->getIdPertanyaan());
                        $kolom->setIsiKolom($_POST['kolom'][$countKolom]);
                        $this->kolomDao->insertKolom($kolom);
                        $countKolom = $countKolom + 1;
                        $k++;
                    }

                    $soalBaris = $soalBaris + 1;
                    $soalKolom = $soalKolom + 1;
                }
            }

        }

        require_once './view/survey/pertanyaan.php';
    }

    //region GA DIPAKE TAPI JANGAN DIHAPUS
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
    //endregion
}