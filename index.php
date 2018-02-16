<?php
session_start();
ob_start();
date_default_timezone_set("Asia/Bangkok");

if (!isset($_SESSION['is_logged_admin'])) {
    $_SESSION['is_logged_admin'] = FALSE;
}

include_once './utility/Koneksi.php';

include_once './model/User.php';
include_once './model/Survey.php';
include_once './model/Pertanyaan.php';
include_once './model/Pilihan.php';
include_once './model/Responden.php';

include_once './dao/UserDao.php';
include_once './dao/RespondenDao.php';

include_once './controller/AuthController.php';
include_once './controller/SurveyController.php';
include_once './controller/UserController.php';
include_once './controller/RespondenController.php';


//ASUUUUUUUUUUUUUUUUU

$authController = new AuthController();
$surveyController = new SurveyController();
$userController = new UserController();
$respondenController = new RespondenController();
?>

<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="admin-themes-lab">
    <meta name="author" content="themes-lab">
    <link rel="shortcut icon" href="./assets/global/images/favicon.png" type="image/png">
    <title>Make Admin Template &amp; Builder</title>
    <link href="./assets/global/css/style.css" rel="stylesheet">
    <link href="./assets/global/css/theme.css" rel="stylesheet">
    <link href="./assets/global/css/ui.css" rel="stylesheet">
    <link href="./assets/admin/layout4/css/layout.css" rel="stylesheet">
    <!-- BEGIN PAGE STYLE -->
    <link href="./assets/global/plugins/metrojs/metrojs.min.css" rel="stylesheet">
    <link href="./assets/global/plugins/maps-amcharts/ammap/ammap.css" rel="stylesheet">
    <!-- END PAGE STYLE -->
    <script src="./assets/global/plugins/modernizr/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<?php

if (isset($_GET["menu"])) {
    $menu = $_GET["menu"];
} else {
    $menu = "";
}

switch ($menu) {
    case  'home':
        $authController->index();
        break;
    case  'register':
        $authController->register();
        break;
    case 'login' :
        $authController->login();
        break;
    case 'logout' :
        $authController->logout();
        break;
    case 'survey' :
        $surveyController->index();
        break;
    case 'insertSurvey' :
        $surveyController->insert();
        break;
    case 'insertPertanyaan' :
        $surveyController->insertPertanyaan();
        break;
    case 'userAdmin' :
        $userController->indexAdmin();
        break;
    case 'insertAdmin' :
        $userController->insertAdmin();
        break;
    case 'profile' :
        $authController->profile();
        break;
    case 'insertResponden' :
        $respondenController->insertResponden();
        break;
    default:
        $authController->index();
        break;
}

?>
</html>