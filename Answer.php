<?php
require_once('./include/DB.php');
require_once('./include/GetGame.php'); 
require_once('./include/StartingGame.php');
require_once('./include/CreateGame.php');
require_once('./include/Manager.php');

?>
<?php if(GameManager::TurnOperator($_GET['invite']) == $_COOKIE['username']): ?>
	<div class="GetData">
				<form method="POST" action="submitanswer.php">
					<input type="text" name="code" placeholder="Your Answer"> 
					<input name="id" type="hidden" value="<?php echo $_GET['invite']; ?>">
              	    <input type="submit" value="Submit">
				</form>
	</div>
<?php endif ?>
