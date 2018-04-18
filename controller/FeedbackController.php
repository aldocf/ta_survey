<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 4/18/2018
 * Time: 7:36 PM
 */

class FeedbackController
{
    private $feedbackDao;

    public function __construct()
    {
        $this->feedbackDao = new FeedbackDao();
    }

    public function index(){

        $data = $this->feedbackDao->getAllFeedback()->getIterator();

        require_once './view/feedback/data.php';
    }

    public function insert(){

        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
        } else {
            $msg = "";
        }

        if(isset($_POST['btnSubmit'])){
            $feedback = new Feedback();
            $feedback->setFeedback($_POST['feedback']);
            $feedback->setUser($_SESSION['id_user']);

            if($this->feedbackDao->insertFeedback($feedback)){
                header("location:index.php?menu=insertFeedback&msg=1");
            }
        }

        require_once './view/feedback/insert.php';
    }
}