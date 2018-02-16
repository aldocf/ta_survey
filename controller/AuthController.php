<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 12/28/2017
 * Time: 3:36 PM
 */

class AuthController
{

    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function login(){

        if(isset($_POST['btnSubmit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $email = trim($email);
            $password = trim($password);

            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);

            if ($this->userDao->login($user)) {
                header("location:index.php");
            } else {
                header("location:index.php?menu=login");
            }
        }

        require_once './view/login.php';
    }

    public function register(){

        require_once './view/register.php';
    }

    public function index(){

        require_once './view/home.php';
    }

    public function logout(){

        require_once './logout.php';
    }

    public function profile(){

        $data = $this->userDao->getUser($_SESSION['id_user']);

        require_once './view/user/profile.php';
    }
}