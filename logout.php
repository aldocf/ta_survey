<?php

session_start();

$_SESSION['is_logged_admin'] = FALSE;
$_SESSION['nama_user'] = '';
$_SESSION['id_user'] = '';
$_SESSION['email'] = '';
$_SESSION['role'] = '';

session_unset(); //menghapus session
session_destroy(); //menghapus session yg berjalan

header('location:index.php');
?>