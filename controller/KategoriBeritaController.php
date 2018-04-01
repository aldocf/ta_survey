<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 4/1/2018
 * Time: 3:49 PM
 */

class KategoriBeritaController
{

    private $kategoriDao;

    public function __construct()
    {
        $this->kategoriDao = new KategoriDao();
    }

    public function index(){

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        $data = $this->kategoriDao->getAllKategori()->getIterator();
        require_once './view/kategori_berita/data.php';
    }

    public function insertKategoriBerita()
    {

        if (isset($_POST['btnSubmit'])) {

            $kategori = new Kategori();
            $kategori->setNamaKategori($_POST['kategori']);

            if ($this->kategoriDao->insertKategori($kategori)) {
                header("location:index.php?menu=dataKategoriBerita&msg=1");
            }
        }

        $kategori = $this->kategoriDao->getAllKategori()->getIterator();
        require_once './view/kategori_berita/insert.php';
    }

    public function updateKategoriBerita()
    {
        $data = $this->kategoriDao->getKategori($_GET['id']);

        if (isset($_POST['btnUpdate'])) {

            $kategori = new Kategori();
            $kategori->setIdKategori($_GET['id']);
            $kategori->setNamaKategori($_POST['kategori']);

            if ($this->kategoriDao->updateKategori($kategori)) {
                header("location:index.php?menu=dataKategoriBerita&msg=2");
            }
        }

        require_once './view/kategori_berita/update.php';
    }
}