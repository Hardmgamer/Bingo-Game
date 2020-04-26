<?php
require_once('./include/DB.php');
require_once('./include/GetGame.php'); 
require_once('./include/StartingGame.php');
require_once('./include/CreateGame.php');
require_once('./include/Manager.php');
$codes= GetGame::GetGameData($_GET['invite']);
?>
				<div class="content">
					<p> <?php echo GameManager::TurnOperator($_GET['invite']); ?> Turn!</p>
				</div>
				<div class="container">
					<?php foreach($codes as $code){?>
					<div class="box">
						<p><?php echo $code['code']; ?></p>
					</div>
					<?php } ?>
				</div>
				<?php 
if(GameManager::TurnOperator($_GET['invite']) == $_COOKIE['username']):
?>
<div class="dontreload"></div>
<?php else: ?>
<div class="reload"></div>
<?php endif; ?>
