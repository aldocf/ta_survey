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

    public function __construct()
    {
        $this->kategoriDao = new KategoriDao();
        $this->beritaDao = new BeritaDao();
    }

    public function indexBerita()
    {

        require_once './view/laporan/berita.php';
    }

    public function beritaByKategori()
    {

        if (isset($_POST['btnFilter'])) {
            header("location:index.php?menu=laporanBeritaKategori&id=" . $_POST['kategori']);
        }

        if(isset($_GET['id'])){
            $data = $this->beritaDao->getAllBeritaFilterKategori($_GET['id'])->getIterator();
        }

        $kategori = $this->kategoriDao->getAllKategori()->getIterator();

        require_once './view/laporan/berita/kategori.php';
    }
}