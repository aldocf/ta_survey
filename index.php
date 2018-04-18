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
include_once './model/Kategori.php';
include_once './model/Berita.php';
include_once './model/Baris.php';
include_once './model/Kolom.php';
include_once './model/Survey.php';
include_once './model/Jawaban.php';
include_once './model/Feedback.php';

include_once './dao/UserDao.php';
include_once './dao/RespondenDao.php';
include_once './dao/KategoriDao.php';
include_once './dao/BeritaDao.php';
include_once './dao/PertanyaanDao.php';
include_once './dao/PilihanDao.php';
include_once './dao/BarisDao.php';
include_once './dao/KolomDao.php';
include_once './dao/SurveyDao.php';
include_once './dao/JawabanDao.php';
include_once './dao/FeedbackDao.php';

include_once './controller/AuthController.php';
include_once './controller/SurveyController.php';
include_once './controller/UserController.php';
include_once './controller/RespondenController.php';
include_once './controller/BeritaController.php';
include_once './controller/KategoriBeritaController.php';
include_once './controller/FeedbackController.php';
include_once './controller/LaporanController.php';


$authController = new AuthController();
$surveyController = new SurveyController();
$userController = new UserController();
$respondenController = new RespondenController();
$beritaController = new BeritaController();
$kategoriBeritaController = new KategoriBeritaController();
$feedbackController = new FeedbackController();
$laporanController = new LaporanController();
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
    case 'surveyMember' :
        $surveyController->indexMember();
        break;
    case 'insertSurvey' :
        $surveyController->insert();
        break;
    case 'isiSurvey' :
        $surveyController->isiSurvey();
        break;
    case 'jawabanSurvey' :
        $surveyController->jawabanSurvey();
        break;
    case 'detailJawaban' :
        $surveyController->detailJawaban();
        break;
    case 'insertPertanyaan' :
        $surveyController->insertPertanyaan();
        break;
    case 'userAdmin' :
        $userController->indexAdmin();
        break;
    case 'userMember' :
        $userController->indexMember();
        break;
    case 'insertAdmin' :
        $userController->insertAdmin();
        break;
    case  'insertUser':
        $userController->register();
        break;
    case 'isiResponden' :
        $respondenController->isiDataResponden();
        break;
    case 'profile' :
        $authController->profile();
        break;
    case 'insertResponden' :
        $respondenController->insertResponden();
        break;
    case 'berita' :
        $beritaController->berita();
        break;
    case 'berita_s' :
        $beritaController->singleBerita();
        break;
    case 'insertBerita' :
        $beritaController->insertBerita();
        break;
    case 'dataBerita' :
        $beritaController->index();
        break;
    case 'updateBerita' :
        $beritaController->updateBerita();
        break;
    case 'activation' :
        $userController->activation();
        break;
    case 'dataKategoriBerita' :
        $kategoriBeritaController->index();
        break;
    case 'insertKategoriBerita' :
        $kategoriBeritaController->insertKategoriBerita();
        break;
    case 'updateKategoriBerita' :
        $kategoriBeritaController->updateKategoriBerita();
        break;
    case 'insertFeedback' :
        $feedbackController->insert();
        break;
    case 'dataFeedback' :
        $feedbackController->index();
        break;
    case 'indexLaporanBerita' :
        $laporanController->indexBerita();
        break;
    case 'laporanBeritaKategori' :
        $laporanController->beritaByKategori();
        break;
    default:
        $authController->index();
        break;
}

?>

</html>