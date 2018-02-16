<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 1/3/2018
 * Time: 5:55 PM
 */

class UserController
{

    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function indexAdmin()
    {

        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
        } else {
            $msg = 0;
        }

        $data = $this->userDao->getAllAdmin()->getIterator();
        require_once './view/user/admin/data.php';
    }

    public function insertAdmin()
    {
        $msg = 0;
        $nama = "";
        $email = "";
        $telepon = "";

        if (isset($_POST['btnInsert'])) {

            $nama = $_POST['nama'];
            $telepon = $_POST['telepon'];
            $email = $_POST['email'];

            if ($_POST['password'] != $_POST['re-password']) {
                $msg = 1;
            } else {
                if (!$this->userDao->checkEmail($email)) {
                    $msg = 2;
                } else {
                    $user = new User();
                    $user->setNama($nama);
                    $user->setNomorTelepon($telepon);
                    $user->setEmail($email);
                    $user->setPassword($_POST['password']);

                    if ($this->userDao->insertAdmin($user)) {
                        header('location:index.php?menu=userAdmin&msg=1');
                    } else {
                        $msg = 3;
                    }
                }

            }
        }

        require_once './view/user/admin/insert.php';
    }
}