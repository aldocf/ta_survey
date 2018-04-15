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
    private $jawabanDao;
    private $respondenDao;

    public function __construct()
    {
        $this->surveyDao = new SurveyDao();
        $this->pertanyaanDao = new PertanyaanDao();
        $this->pilihanDao = new PilihanDao();
        $this->barisDao = new BarisDao();
        $this->kolomDao = new KolomDao();
        $this->jawabanDao = new JawabanDao();
        $this->respondenDao = new RespondenDao();
    }

    public function index()
    {
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        $data = $this->surveyDao->getAllSurvey()->getIterator();
        require_once './view/survey/survey.php';
    }

    public function indexMember()
    {

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        $check = $this->respondenDao->checkResponden($_SESSION['id_user']);
        $resp = $this->respondenDao->getResponden($_SESSION['id_user']);
        $data = $this->surveyDao->getAllSurveyForResponden($resp->getJabatan(), $resp->getIdResponden())->getIterator();
//        $data2 = $this->surveyDao->getAllSurveyForRespondenAnswered($resp->getJabatan(), $resp->getIdResponden())->getIterator();

        if (!$check) {
            header("location:index.php?menu=isiResponden");
        }

        require_once './view/survey/surveyResponden.php';
    }

    public function insert()
    {

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        $responden = $this->respondenDao->getAllRespondenJabatanFilter()->getIterator();

        if (isset($_POST['btnBuatSurvey'])) {
            if (!isset($_POST['target_responden'])) {
                header("location:index.php?menu=insertSurvey&msg=1");
            } else if (strtotime($_POST['awal']) > strtotime($_POST['akhir'])) {
                header("location:index.php?menu=insertSurvey&msg=2");
            } else {
                $namaSurvey = $_POST['nama_survey'];
                $deskripsi = $_POST['deskripsi'];
                $targetResponden = $_POST['target_responden'];
                $awal = $_POST['awal'];
                $akhir = $_POST['akhir'];
                header('location:index.php?menu=insertPertanyaan&namaSurvey=' . $namaSurvey . '&deskripsi=' . $deskripsi . '&targetResponden=' . $targetResponden . '&awal=' . $awal . '&akhir=' . $akhir);
            }
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
                    $this->pertanyaanDao->insertPertanyaanSingle($pertanyaan);
                } else if ($_POST['type'][$i] == "CommentBox") {
                    $pertanyaan = new Pertanyaan();
                    $pertanyaan->setPertanyaan($_POST['soal'][$i]);
                    $pertanyaan->setPenjelasan($_POST['penjelasan'][$i]);
                    $pertanyaan->setTipeSoal($_POST['type'][$i]);
                    $pertanyaan->setNomorPertanyaan($i + 1);
                    $pertanyaan->setSurvey($lastSurvey->getIdSurvey());
                    $this->pertanyaanDao->insertPertanyaanSingle($pertanyaan);
                } else if ($_POST['type'][$i] == "MultipleAnswer") {
                    $pertanyaan = new Pertanyaan();
                    $pertanyaan->setPertanyaan($_POST['soal'][$i]);
                    $pertanyaan->setPenjelasan($_POST['penjelasan'][$i]);
                    $pertanyaan->setTipeSoal($_POST['type'][$i]);
                    $pertanyaan->setNomorPertanyaan($i + 1);
                    $pertanyaan->setSurvey($lastSurvey->getIdSurvey());

                    if ($_POST['lainnya'][$countLainnya] == 1) {
                        $pertanyaan->setJumlahPilihan($_POST['multiple_answer'][$soalMultipleAnswer] + 1);
                    } else {
                        $pertanyaan->setJumlahPilihan($_POST['multiple_answer'][$soalMultipleAnswer]);
                    }

                    $this->pertanyaanDao->insertPertanyaanPilihan($pertanyaan);

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

                    if ($_POST['lainnya'][$countLainnya] == 1) {
                        $pertanyaan->setJumlahPilihan($_POST['multiple_choice'][$soalMultipleChoice] + 1);
                    } else {
                        $pertanyaan->setJumlahPilihan($_POST['multiple_choice'][$soalMultipleChoice]);
                    }

                    $this->pertanyaanDao->insertPertanyaanPilihan($pertanyaan);

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
                    $pertanyaan->setJumlahBaris($_POST['total_baris'][$soalBaris]);
                    $pertanyaan->setJumlahKolom($_POST['total_kolom'][$soalBaris]);
                    $this->pertanyaanDao->insertPertanyaanMatrix($pertanyaan);

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
            header("location:index.php?menu=survey&msg=1");
        }

        require_once './view/survey/pertanyaan.php';
    }

    public function isiSurvey()
    {
        $survey = $this->surveyDao->getSurvey($_GET['id']);
        $pertanyaan = $this->surveyDao->getSurveyAllPertanyaan($_GET['id'])->getIterator();

        //region CREATE SOAL
        $soal = "";
        while ($pertanyaan->valid()) {

            if ($pertanyaan->current()->getTipeSoal() == "SingleTextBox") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-1"><h4><div>' . $pertanyaan->current()->getNomorPertanyaan() . '.</div></h4></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10"><h4 for="">' . $pertanyaan->current()->getPertanyaan() . '</h4></div><div class="col-md-12 m-b-10"><label for="">' . $pertanyaan->current()->getPenjelasan() . '</label></div><div class="col-md-12 m-b-10"><input type="text" class="form-control form-white" placeholder="Jawaban" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . '" required></div></div></div></div></div>';
            } else if ($pertanyaan->current()->getTipeSoal() == "CommentBox") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-1"><h4><div>' . $pertanyaan->current()->getNomorPertanyaan() . '.</div></h4></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10"><h4 for="">' . $pertanyaan->current()->getPertanyaan() . '</h4></div><div class="col-md-12 m-b-10"><label for="">' . $pertanyaan->current()->getPenjelasan() . '</label></div><div class="col-md-12 m-b-10"><textarea class="form-control form-white" placeholder="Jawaban" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . '" rows="4" required></textarea></div></div></div></div></div>';
            } else if ($pertanyaan->current()->getTipeSoal() == "MultipleAnswer") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-1"><h4><div>' . $pertanyaan->current()->getNomorPertanyaan() . '.</div></h4></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10"><h4 for="">' . $pertanyaan->current()->getPertanyaan() . '</h4></div><div class="col-md-12 m-b-10"><label for="">' . $pertanyaan->current()->getPenjelasan() . '</label></div>';
                $pilihan = $this->pilihanDao->getPilihanPertanyaan($pertanyaan->current()->getIdPertanyaan())->getIterator();
                while ($pilihan->valid()) {
                    if ($pilihan->current()->getIsLainnya() == 0) {
                        $soal = $soal . '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 6px; padding-left: 30px;"><input type="checkbox" class="form-control" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . '[]" value="' . $pilihan->current()->getPilihan() . '"></div><div class="col-md-11" style="padding-top: 5px"><span for="">' . $pilihan->current()->getPilihan() . '</span></div></div>';
                    } else {
                        $soal = $soal . '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 6px; padding-left: 30px;"><input type="checkbox" class="form-control" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . '[]" value="lainnya"></div><div class="col-md-11" style="padding-top: 5px"><input type="text" class="form-control form-white" placeholder="Lainnya" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . 'lainnya"></div></div>';
                    }
                    $pilihan->next();
                }
                $soal = $soal . '</div></div></div></div>';
            } else if ($pertanyaan->current()->getTipeSoal() == "MultipleChoice") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-1"><h4><div>' . $pertanyaan->current()->getNomorPertanyaan() . '.</div></h4></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10"><h4 for="">' . $pertanyaan->current()->getPertanyaan() . '</h4></div><div class="col-md-12 m-b-10"><label for="">' . $pertanyaan->current()->getPenjelasan() . '</label></div>';
                $pilihan = $this->pilihanDao->getPilihanPertanyaan($pertanyaan->current()->getIdPertanyaan())->getIterator();
                while ($pilihan->valid()) {
                    if ($pilihan->current()->getIsLainnya() == 0) {
                        $soal = $soal . '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 6px; padding-left: 30px;"><input type="radio" class="form-control" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . '" value="' . $pilihan->current()->getPilihan() . '"></div><div class="col-md-11" style="padding-top: 5px"><span for="">' . $pilihan->current()->getPilihan() . '</span></div></div>';
                    } else {
                        $soal = $soal . '<div class="col-md-12 m-b-10"><div class="col-md-1" style="padding-top: 6px; padding-left: 30px;"><input type="radio" class="form-control" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . '" value="lainnya"></div><div class="col-md-11" style="padding-top: 5px"><input type="text" class="form-control form-white" placeholder="Lainnya" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . 'lainnya"></div></div>';
                    }
                    $pilihan->next();
                }
                $soal = $soal . '</div></div></div></div>';
            } else if ($pertanyaan->current()->getTipeSoal() == "Matrix") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-1"><h4><div>' . $pertanyaan->current()->getNomorPertanyaan() . '.</div></h4></div><div class="col-md-10"><div class="form-group"><div class="col-md-12 m-b-10"><h4 for="">' . $pertanyaan->current()->getPertanyaan() . '</h4></div><div class="col-md-12 m-b-10"><label for="">' . $pertanyaan->current()->getPenjelasan() . '</label></div><div class="col-md-12 m-b-10"><table class="matrix">';

                $kolom = $this->kolomDao->getSurveyKolom($pertanyaan->current()->getIdPertanyaan());
                $baris = $this->barisDao->getSurveyBaris($pertanyaan->current()->getIdPertanyaan());

                $countMatrix = 0;
                foreach ($baris as $b) {
                    if ($countMatrix == 0) {
                        $soal = $soal . '<tr><th></th>';

                        foreach ($kolom as $k) {
                            $soal = $soal . '<th class="matrix-center">' . $k->getIsiKolom() . '</th>';
                        }
                        $soal = $soal . '</tr>';
                    } else {
                        $soal = $soal . '<tr><td>' . $b->getIsiBaris() . '</td>';

                        foreach ($kolom as $k) {
                            $soal = $soal . '<td class="matrix-center"><input type="radio" value="' . $k->getIsiKolom() . '" name="soal' . $pertanyaan->current()->getNomorPertanyaan() . 'matrix' . $countMatrix . '"></td>';
                        }
                        $soal = $soal . '</tr>';
                    }
                    $countMatrix++;
                }
                $soal = $soal . '</table></div></div></div></div></div>';
            }

            $pertanyaan->next();
        }
        //endregion

        if (isset($_POST['btnSimpan'])) {
            $pertanyaan = $this->surveyDao->getSurveyAllPertanyaan($_GET['id'])->getIterator();
            $validasiPertanyaan = $this->surveyDao->getSurveyAllPertanyaan($_GET['id'])->getIterator();

            $result = true;
            while ($validasiPertanyaan->valid()) {

                if ($validasiPertanyaan->current()->getTipeSoal() == "MultipleAnswer") {
                    if (!isset($_POST['soal' . $validasiPertanyaan->current()->getNomorPertanyaan()])) {
                        echo '<script>alert("Soal nomor ' . $validasiPertanyaan->current()->getNomorPertanyaan() . ' harus diisi!");</script>';
                        $result = false;
                        break;
                    }
                } else if ($validasiPertanyaan->current()->getTipeSoal() == "MultipleChoice") {
                    if (!isset($_POST['soal' . $validasiPertanyaan->current()->getNomorPertanyaan()])) {
                        echo '<script>alert("Soal nomor ' . $validasiPertanyaan->current()->getNomorPertanyaan() . ' harus diisi!");</script>';
                        $result = false;
                        break;
                    }
                } else if ($validasiPertanyaan->current()->getTipeSoal() == "Matrix") {
                    $baris = $this->barisDao->getSurveyBaris($validasiPertanyaan->current()->getIdPertanyaan());

                    $countMatrix = 0;
                    foreach ($baris as $b) {
                        if ($countMatrix != 0) {
                            if (!isset($_POST['soal' . $validasiPertanyaan->current()->getNomorPertanyaan() . 'matrix' . $countMatrix])) {
                                echo '<script>alert("Soal nomor ' . $validasiPertanyaan->current()->getNomorPertanyaan() . ' harus diisi!");</script>';
                                $result = false;
                                break;
                                break;
                            }
                        }
                        $countMatrix++;
                    }
                }

                $validasiPertanyaan->next();
            }

            if ($result) {
                while ($pertanyaan->valid()) {

                    $resp = $this->respondenDao->getResponden($_SESSION['id_user']);

                    $jawaban = new Jawaban();
                    $jawaban->setResponden($resp->getIdResponden());
                    $jawaban->setPertanyaan($pertanyaan->current()->getIdPertanyaan());

                    if ($pertanyaan->current()->getTipeSoal() == "SingleTextBox") {
                        $jawaban->setIsiJawaban($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan()]);
                        $this->jawabanDao->insertJawaban($jawaban);
                    } else if ($pertanyaan->current()->getTipeSoal() == "CommentBox") {
                        $jawaban->setIsiJawaban($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan()]);
                        $this->jawabanDao->insertJawaban($jawaban);
                    } else if ($pertanyaan->current()->getTipeSoal() == "MultipleAnswer") {

                        for ($i = 0; $i < sizeof($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan()]); $i++) {
                            if ($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan()][$i] == "lainnya") {
                                $jawaban->setIsiJawaban($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan() . 'lainnya']);
                            } else {
                                $jawaban->setIsiJawaban($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan()][$i]);
                            }
                            $this->jawabanDao->insertJawaban($jawaban);
                        }

                    } else if ($pertanyaan->current()->getTipeSoal() == "MultipleChoice") {
                        if ($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan()] == "lainnya") {
                            $jawaban->setIsiJawaban($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan() . 'lainnya']);
                        } else {
                            $jawaban->setIsiJawaban($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan()]);
                        }
                        $this->jawabanDao->insertJawaban($jawaban);

                    } else if ($pertanyaan->current()->getTipeSoal() == "Matrix") {
                        $baris = $this->barisDao->getSurveyBaris($pertanyaan->current()->getIdPertanyaan());

                        $countMatrix = 0;
                        foreach ($baris as $b) {
                            if ($countMatrix != 0) {
                                $jawaban->setIsiJawaban($_POST['soal' . $pertanyaan->current()->getNomorPertanyaan() . 'matrix' . $countMatrix]);
                                $this->jawabanDao->insertJawaban($jawaban);
                            }
                            $countMatrix++;
                        }
                    }

                    $pertanyaan->next();
                }
                header("location:index.php?menu=surveyMember&msg=1");
            }
        }

        require_once './view/survey/isiSurvey.php';
    }

    public function jawabanSurvey()
    {

        $data = $this->surveyDao->getAllCountRespondenSurvey()->getIterator();
        require_once './view/survey/jawabanSurvey.php';
    }

    public function detailJawaban()
    {

        $survey = $this->surveyDao->getSurvey($_GET['id']);
        $pertanyaan = $this->surveyDao->getSurveyAllPertanyaan($_GET['id'])->getIterator();

        //region CREATE SOAL
        $soal = "";
        while ($pertanyaan->valid()) {

            if ($pertanyaan->current()->getTipeSoal() == "SingleTextBox") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Single Text Box</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
                $jawaban = $this->jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

                while ($jawaban->valid()) {
                    $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
                    $jawaban->next();
                }

                $soal = $soal . '</tbody></table></div></div></div>';
            } else if ($pertanyaan->current()->getTipeSoal() == "CommentBox") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Comment Box</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
                $jawaban = $this->jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

                while ($jawaban->valid()) {
                    $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
                    $jawaban->next();
                }

                $soal = $soal . '</tbody></table></div></div></div>';
            } else if ($pertanyaan->current()->getTipeSoal() == "MultipleAnswer") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Multiple Answer</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
                $jawaban = $this->jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

                while ($jawaban->valid()) {
                    $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
                    $jawaban->next();
                }
                $soal = $soal . '</tbody></table></div></div></div>';

            } else if ($pertanyaan->current()->getTipeSoal() == "MultipleChoice") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Multiple Choice</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
                $jawaban = $this->jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

                while ($jawaban->valid()) {
                    $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
                    $jawaban->next();
                }
                $soal = $soal . '</tbody></table></div></div></div>';
            } else if ($pertanyaan->current()->getTipeSoal() == "Matrix") {
                $soal = $soal . '<div class="form-group"><div class="col-md-12"><div class="col-md-12"><table class="soal"><tr><td>Nomor Soal</td><td>:</td><td>' . $pertanyaan->current()->getNomorPertanyaan() . '</td></tr><tr><td>Pertanyaan</td><td>:</td><td>' . $pertanyaan->current()->getPertanyaan() . '</td></tr><tr><td>Tipe Soal</td><td>:</td><td>Matrix</td></tr></table><table class="table table-hover table-dynamic" style="width: auto !important; margin-bottom: 40px; !important;"><thead><tr><th>Nama Responden</th><th>Jawaban</th></tr></thead><tbody>';
                $jawaban = $this->jawabanDao->getJawaban($pertanyaan->current()->getIdPertanyaan())->getIterator();

                while ($jawaban->valid()) {
                    $soal = $soal . '<tr><td>' . $jawaban->current()->getResponden()->getIdUser()->getNama() . '</td><td>' . $jawaban->current()->getIsiJawaban() . '</td></tr>';
                    $jawaban->next();
                }
                $soal = $soal . '</tbody></table></div></div></div>';
            }

            $pertanyaan->next();
        }
        //endregion

        require_once './view/survey/detailJawaban.php';
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