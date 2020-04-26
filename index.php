<?php 
require_once('./include/DB.php');
require_once('./include/GetGame.php'); 
require_once('./include/StartingGame.php');
require_once('./include/CreateGame.php');
require_once('./include/Manager.php');
if(isset($_GET['invite'])){
	if(StartGame::CheckAvailability($_GET['invite'])){
		if(StartGame::CheckGame($_GET['invite'],$_COOKIE['username'])){
			if(!DB::query('SELECT * FROM codesrepo WHERE username=:username AND game=:game',array(':username'=>$_COOKIE['username'],':game'=>$_GET['invite']))){
				if(!isset($_COOKIE['username'])){
					setcookie('username','Guest', time() + (86400 * 30), "/");
				}
				CreateGame::Guest($_GET['invite']);
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Play Bingo</title>
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./layout/css/bingocss.css">
	</head>
	<body>
		<div class="root">
			<div class="Alpha">
			<?php if(isset($_GET['invite'])): // condition zero
				$gameID = $_GET['invite'];
				$codes= GetGame::GetGameData($gameID);
				if(StartGame::CheckAvailability($gameID)):
				if(StartGame::CheckGame($gameID,$_COOKIE['username'])):
				if(GameManager::TurnOperator($_GET['invite']) == $_COOKIE['username']): ?>
				<div class="GetData">
				<form method="POST" action="submitanswer.php">
					<input type="text" name="code" placeholder="Your Answer"> 
					<input name="id" type="hidden" value="<?php echo $_GET['invite']; ?>">
              	    <input type="submit" value="Submit">
				</form>
				</div>
			 	<?php endif ?>
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
			</div>
			<?php elseif(!StartGame::CheckGame($gameID,$_COOKIE['username'])): ?>
				<div class="content">
				<p style="color:green;">Wait For your friend to join the game!</p>
			<?php endif; else: ?>
				<div class="content">
					<p style="color:Red;">Wrong Code!</p>
					<p>Join again</p>
					<form method="GET" action="JoinGame.php"> 
                   		<input type="text" name="code" placeholder="Enter your invitation code"> 
                    	<input type="submit" value="Join Game!">
					</form>    	
			</div>
				<?php endif; else:?>
				<div class="content">
				<p style="color:green;">Have a game?</p>
				<p>Join it now</p>
				<form method="GET" action="JoinGame.php"> 
                    <input type="text" name="code" placeholder="Enter your invitation code"> 
                    <input type="submit" value="Join Game!">
				</form>  
			<?php endif; //ending condition zero ?>  
		</div>
	</body>
</html>