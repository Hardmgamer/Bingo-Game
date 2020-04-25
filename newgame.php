<?php
require_once('./include/DB.php');
require_once('./include/CreateGame.php');
$Player1 = $_GET['username'];
$codes= CreateGame::creator($Player1);
?>