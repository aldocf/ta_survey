<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 4/18/2018
 * Time: 8:40 PM
 */

class LaporanController
{

    private $kategoriDao;
    private $beritaDao;
    private $userDao;
    private $respondenDao;
    private $surveyDao;

    public function __construct()
    {
        $this->kategoriDao = new KategoriDao();
        $this->beritaDao = new BeritaDao();
        $this->userDao = new UserDao();
        $this->respondenDao = new RespondenDao();
        $this->surveyDao = new SurveyDao();
    }

    //region BERITA
    public function indexBerita()
    {

        require_once './view/laporan/berita.php';
    }

    public function beritaByKategori()
    {

        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanBeritaKategori&id=" . $_POST['kategori']);
        }

        if (isset($_GET['id'])) {
            $data = $this->beritaDao->getAllBeritaFilterKategori($_GET['id'])->getIterator();
        }

        $kategori = $this->kategoriDao->getAllKategori()->getIterator();

        require_once './view/laporan/berita/kategori.php';
    }

    public function beritaByUser()
    {

        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanBeritaUser&id=" . $_POST['user']);
        }

        if (isset($_GET['id'])) {
            $data = $this->beritaDao->getAllBeritaFilterUser($_GET['id'])->getIterator();
        }

        $user = $this->userDao->getAllAdmin()->getIterator();

        require_once './view/laporan/berita/user.php';
    }

    public function beritaByTanggal()
    {

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = "";
        }

        if (isset($_POST['btnFilter'])) {
            if (strtotime($_POST['awal']) > strtotime($_POST['akhir'])) {
                header("location:index.php?menu=laporanBeritaTanggal&msg=1");
            } else {
                header("location:index.php?menu=laporanBeritaTanggal&awal=" . $_POST['awal'] . "&akhir=" . $_POST['akhir']);
            }
        }

        if (isset($_GET['awal']) && isset($_GET['akhir'])) {
            $data = $this->beritaDao->getAllBeritaFilterTanggal($_GET['awal'], $_GET['akhir'])->getIterator();
        }

        require_once './view/laporan/berita/tanggal.php';
    }

    public function beritaAll()
    {

        $data = $this->beritaDao->getAllBeritaActive()->getIterator();

        require_once './view/laporan/berita/all.php';
    }
    //endregion

    //region PENGGUNA
    public function indexPengguna()
    {

        require_once './view/laporan/pengguna.php';
    }

    public function penggunaByRole()
    {

        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanPenggunaRole&id=" . $_POST['role']);
        }

        if (isset($_GET['id'])) {
            if ($_GET['id'] == 0) {
                $data = $this->userDao->getAllMember()->getIterator();
            } else {
                $data = $this->userDao->getAllAdmin()->getIterator();
            }
        }

        require_once './view/laporan/pengguna/role.php';
    }

    public function penggunaByStatus()
    {

        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanPenggunaStatus&id=" . $_POST['status']);
        }

        if (isset($_GET['id'])) {
            if ($_GET['id'] == 0) {
                $data = $this->userDao->getAllMemberTidakDiDaftarkan()->getIterator();
            } else {
                $data = $this->userDao->getAllMemberDiDaftarkan()->getIterator();
            }
        }

        require_once './view/laporan/pengguna/status.php';
    }
    //endregion

    //region RESPONDEN
    public function indexResponden()
    {

        require_once './view/laporan/responden.php';
    }

    public function respondenByJabatan()
    {

        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanRespondenJabatan&jabatan=" . $_POST['jabatan']);
        }

        if (isset($_GET['jabatan'])) {
            $data = $this->respondenDao->getAllRespondenFilterJabatan($_GET['jabatan'])->getIterator();
        }

        $jabatan = $this->respondenDao->getAllRespondenJabatanFilter()->getIterator();

        require_once './view/laporan/responden/jabatan.php';
    }

    public function respondenByPerusahaan()
    {

        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanRespondenPerusahaan&perusahaan=" . $_POST['perusahaan']);
        }

        if (isset($_GET['perusahaan'])) {
            $data = $this->respondenDao->getAllRespondenFilterPerusahaan($_GET['perusahaan'])->getIterator();
        }

        $perusahaan = $this->respondenDao->getAllPerusahaan()->getIterator();

        require_once './view/laporan/responden/perusahaan.php';
    }

    public function respondenByAll()
    {
        $data = $this->respondenDao->getAllResponden()->getIterator();

        require_once './view/laporan/responden/all.php';
    }
    //endregion

    //region SURVEY
    public function indexSurvey()
    {

        require_once './view/laporan/survey.php';
    }

    public function surveyByStatus()
    {
        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanSurveyStatus&id=" . $_POST['status']);
        }

        if (isset($_GET['id'])) {
            $data = $this->surveyDao->getAllSurveyFilterByStatus($_GET['id'])->getIterator();
        }

        require_once './view/laporan/survey/status.php';
    }

    public function surveyByPeriode()
    {

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = "";
        }

        if (isset($_POST['btnFilter'])) {
            if (strtotime($_POST['awal']) > strtotime($_POST['akhir'])) {
                header("location:index.php?menu=laporanSurveyPeriode&msg=1");
            } else {
                header("location:index.php?menu=laporanSurveyPeriode&awal=" . $_POST['awal'] . "&akhir=" . $_POST['akhir']);
            }
        }

        if (isset($_GET['awal']) && isset($_GET['akhir'])) {
            $data = $this->surveyDao->getAllSurveyFilterByPeriode($_GET['awal'], $_GET['akhir'])->getIterator();
        }

        require_once './view/laporan/survey/periode.php';
    }

    public function surveyByJumlahResponden()
    {

        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanSurveyResponden&jumlah=" . $_POST['jumlah']);
        }

        if (isset($_GET['jumlah'])) {
            $data = $this->surveyDao->getAllSurveyFilterByJumlahResponden($_GET['jumlah'])->getIterator();
        }

        require_once './view/laporan/survey/jumlah.php';
    }

    public function surveyByAll()
    {
        $data = $this->surveyDao->getAllSurvey()->getIterator();
        require_once './view/laporan/survey/all.php';
    }

    //endregion

    //region JAWABAN
    public function indexJawaban()
    {
        require_once './view/laporan/jawaban.php';
    }

    public function jawabanPDF()
    {
        $data = $this->surveyDao->getAllSurvey()->getIterator();
        require_once './view/laporan/jawaban/jawabanPDF.php';
    }
    //endregion
}