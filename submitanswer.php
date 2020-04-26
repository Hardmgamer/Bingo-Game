<?php
require_once('./include/DB.php');
require_once('./include/Manager.php');
$url=$_POST['id'];
GameManager::VerifyCode($url,$_POST['code']);
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?invite='.$url;
header('Location:'.$home_url);
?>