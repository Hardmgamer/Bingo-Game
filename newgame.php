<?php
require_once('./include/DB.php');
require_once('./include/CreateGame.php');
require_once('./include/Manager.php');
$Player = $_GET['username'];
return CreateGame::Creator($Player,1,50,1);
?>