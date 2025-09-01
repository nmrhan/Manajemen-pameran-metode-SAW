<?php
session_start();

$_SESSION['id']='';
$_SESSION["npk"]='';
$_SESSION['name']='';
$_SESSION['username']='';
$_SESSION['password']='';
$_SESSION["departemen"]='';
$_SESSION["jabatan"]='';
$_SESSION["alamat"]='';

$_SESSION['level']='';

unset($_SESSION['id']);
unset($_SESSION["npk"]);
unset($_SESSION['name']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION["departemen"]);
unset($_SESSION["jabatan"]);
unset($_SESSION["alamat"]);
unset($_SESSION['level']);


session_unset();
session_destroy();
header('Location:login');

?>


