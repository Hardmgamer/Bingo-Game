<?php
require_once('./include/DB.php');
require_once('./include/Manager.php');
$url=$_POST['gameid'];
GameManager::VerifyCode($url,$_POST['Answer']);
?>