<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 2/16/2018
 * Time: 2:57 PM
 */

class BeritaController
{
    private $kategoriDao;
    private $beritaDao;

    public function __construct()
    {
        $this->kategoriDao = new KategoriDao();
        $this->beritaDao = new BeritaDao();
    }

    public function berita()
    {

        $data = $this->beritaDao->getAllBerita()->getIterator();
        $kategori = $this->kategoriDao->getAllKategori()->getIterator();
        require_once './view/berita/berita.php';
    }

    public function singleBerita()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $data = $this->beritaDao->getBerita($id);
        require_once './view/berita/single_berita.php';
    }

    public function index()
    {

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        if(isset($_GET['delete'])){
            $this->beritaDao->deleteBerita($_GET['delete']);
            header("location:index.php?menu=dataBerita&msg=3");
        }

        if(isset($_GET['restored'])){
            $this->beritaDao->restoreBerita($_GET['restored']);
            header("location:index.php?menu=dataBerita&msg=4");
        }

        $data = $this->beritaDao->getAllBeritaData()->getIterator();
        require_once './view/berita/data.php';
    }

    public function updateBerita()
    {

        $data = $this->beritaDao->getBerita($_GET['id']);
        $id = $_GET['id'];

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        if (isset($_POST['btnUpdate'])) {

            if ($_POST['kategori'] == 0) {
                header("location:index.php?menu=updateBerita&id=" . $id . "&msg=1");
            } else if (trim($_POST['deskripsi']) == "") {
                header("location:index.php?menu=updateBerita&id=" . $id . "&msg=2");
            } else {
                $berita = new Berita();
                $berita->setIdBerita($data->getIdBerita());
                $berita->setUser($_SESSION['id_user']);
                $berita->setJudul($_POST['judul']);
                $berita->setKategori($_POST['kategori']);
                $berita->setDeskripsi(htmlentities($_POST['deskripsi']));

                $lokasi_file = $_FILES['cover']['tmp_name'];
                $nama_file = $_FILES['cover']['name'];
                $ukuran_file = $_FILES['cover']['size'];
                $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);

                if ($nama_file == "") {
                    $nama_file = $data->getCover();
                } else {
                    $new_location = "./assets/img_berita/" . $nama_file;
                    $nama_file = $_FILES['cover']['name'];
                    move_uploaded_file($lokasi_file, $new_location);
                }

                $berita->setCover($nama_file);

                if ($this->beritaDao->updateBerita($berita)) {
                    $data = $this->beritaDao->getBerita($_GET['id']);
                    header("location:index.php?menu=dataBerita&msg=2");
                }
            }

        }

        $kategori = $this->kategoriDao->getAllKategori()->getIterator();
        require_once './view/berita/update.php';
    }

    public function insertBerita()
    {

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        if (isset($_POST['btnSubmit'])) {

            if ($_POST['kategori'] == 0) {
                header("location:index.php?menu=insertBerita&msg=1");
            } else if ($_POST['deskripsi'] == "") {
                header("location:index.php?menu=insertBerita&msg=2");
            } else {
                $berita = new Berita();
                $berita->setUser($_SESSION['id_user']);
                $berita->setJudul($_POST['judul']);
                $berita->setKategori($_POST['kategori']);
                $berita->setDeskripsi(htmlentities($_POST['deskripsi']));

                $lokasi_file = $_FILES['cover']['tmp_name'];
                $nama_file = $_FILES['cover']['name'];
                $ukuran_file = $_FILES['cover']['size'];
                $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);

                $berita->setCover($nama_file);

                $new_location = "./assets/img_berita/" . $nama_file;
                move_uploaded_file($lokasi_file, $new_location);

                if ($this->beritaDao->insertBerita($berita)) {
                    header("location:index.php?menu=dataBerita&msg=1");
                }
            }

        }

        $kategori = $this->kategoriDao->getAllKategori()->getIterator();
        require_once './view/berita/insert.php';
    }
}