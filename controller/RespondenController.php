<?php
/**
 * Created by PhpStorm.
 * User: ACF
 * Date: 2/11/2018
 * Time: 8:20 PM
 */

class RespondenController
{

    private $respondenDao;
    private $userDao;

    public function __construct()
    {
        $this->respondenDao = new RespondenDao();
        $this->userDao = new UserDao();
    }

    public function insertResponden()
    {
        $id = $_SESSION['id_user'];
        $result = $this->userDao->getUser($id);
        $resp = $this->respondenDao->getResponden($id);
        $cekId = $resp->getIdUser();
        $msg = 0;
        $nama = $result->getNama();
        $email = $result->getEmail();
        $telepon = $result->getNomorTelepon();
        $jabatan = $_POST["jabatan"];
        $nmPerusahaan = $_POST["nmPerusahaan"];

        if (isset($_POST['btnUpdate'])) {
            if ($jabatan == "" || $nmPerusahaan == ""  ) {

                $msg = "3";
            }else {

                $responden_new = new Responden();
                $responden_new->setJabatan($jabatan);
                $responden_new->setNamaPerusahaan($nmPerusahaan);
                $responden_new->setIdUser($id);

                $hasil = $this->respondenDao->insert_responden($responden_new);
            }
            header("location:index.php?menu=insertResponden");

        }
        elseif (isset($_POST['btnDelete'])) {

            $id = $_SESSION['id_user'];
            $hasil = $this->respondenDao->delete_responden($id);

            header("location:index.php?menu=insertResponden");

        }
        require_once './view/user/member/insertResponden.php';
    }


}