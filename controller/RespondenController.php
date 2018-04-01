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

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        if (isset($_POST['btnInsert'])) {

            if ($_POST['password'] != $_POST['re-password']) {
                header("location:index.php?menu=insertResponden&msg=1");
            } else {
                if (!$this->userDao->checkEmail($_POST['email'])) {
                    header("location:index.php?menu=insertResponden&msg=2");
                } else {
                    $user = new User();
                    $user->setNama($_POST['nama']);
                    $user->setNomorTelepon($_POST['telepon']);
                    $user->setEmail($_POST['email']);
                    $user->setPassword($_POST['password']);

                    if ($this->userDao->insertMember($user)) {
                        $newUser = $this->userDao->getUserResponden($user);
                        $responden_new = new Responden();
                        $responden_new->setJabatan($_POST['jabatan']);
                        $responden_new->setNamaPerusahaan($_POST['nmPerusahaan']);
                        $responden_new->setIdUser($newUser->getIdUser());
                        $this->respondenDao->insert_responden($responden_new);
                        header("location:index.php?menu=insertResponden&msg=4");

                    } else {
                        header("location:index.php?menu=insertResponden&msg=3");
                    }
                }

            }
        }
        require_once './view/user/member/insertResponden.php';
    }

    public function isiDataResponden()
    {

        $check = $this->respondenDao->checkResponden($_SESSION['id_user']);

        $result = $this->userDao->getUser($_SESSION['id_user']);

        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        $nama = $result->getNama();
        $email = $result->getEmail();
        $telepon = $result->getNomorTelepon();

        if ($check) {
            $resp = $this->respondenDao->getResponden($_SESSION['id_user']);
            $jabatan = $resp->getJabatan();
            $nmPerusahaan = $resp->getNamaPerusahaan();
        } else {
            if (!isset($_POST['jabatan'])) {
                $jabatan = "";
            } else {
                $jabatan = $_POST['jabatan'];
            }

            if (!isset($_POST['nmPerusahaan'])) {
                $nmPerusahaan = "";
            } else {
                $nmPerusahaan = $_POST['nmPerusahaan'];
            }
        }


        if (isset($_POST['btnInsert'])) {

            $user = new User();
            $user->setIdUser($_SESSION['id_user']);
            $user->setEmail($_POST['email']);
            $user->setNomorTelepon($_POST['telepon']);
            $user->setNama($_POST['nama']);

            $responden_new = new Responden();
            $responden_new->setJabatan($jabatan);
            $responden_new->setNamaPerusahaan($nmPerusahaan);
            $responden_new->setIdUser($_SESSION['id_user']);

            $this->userDao->updateMember($user);
            $this->respondenDao->insert_responden($responden_new);
            header("location:index.php?menu=isiResponden&msg=1");
        }

        if (isset($_POST['btnUpdate'])) {

            $user = new User();
            $user->setIdUser($_SESSION['id_user']);
            $user->setEmail($_POST['email']);
            $user->setNomorTelepon($_POST['telepon']);
            $user->setNama($_POST['nama']);

            $responden_new = new Responden();
            $responden_new->setJabatan($_POST['jabatan']);
            $responden_new->setNamaPerusahaan($_POST['nmPerusahaan']);
            $responden_new->setIdUser($_SESSION['id_user']);

            $this->userDao->updateMember($user);
            $this->respondenDao->updateResponden($responden_new);
            header("location:index.php?menu=isiResponden&msg=2");
        }

        if (isset($_POST['btnChange'])) {
            if ($_POST['password'] == $_POST['re-password']) {
                if (!$this->userDao->checkPassword($_SESSION['id_user'], $_POST['oldPassword'])) {
                    $this->userDao->updatePassword($_SESSION['id_user'], $_POST['password']);
                    header("location:index.php?menu=isiResponden&msg=5");
                } else {
                    header("location:index.php?menu=isiResponden&msg=4");
                }
            } else {
                header("location:index.php?menu=isiResponden&msg=3");
            }
        }

        require_once './view/user/isiDataResponden.php';
    }
}