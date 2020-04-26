<?php
require_once('./include/DB.php');
require_once('./include/GetGame.php'); 
require_once('./include/StartingGame.php');
require_once('./include/CreateGame.php');
require_once('./include/Manager.php');
?>
<?php 
if(GameManager::TurnOperator($_GET['invite']) == $_COOKIE['username']):
?>
<div class="dontreload"></div>
<?php else: ?>
<div class="reload"></div>
<?php endif; ?>
