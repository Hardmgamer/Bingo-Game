<?php 
require_once('./include/DB.php');
require_once('./include/GetGame.php'); 
require_once('./include/StartingGame.php');
require_once('./include/CreateGame.php');
require_once('./include/Manager.php');
if(isset($_GET['invite'])){
	$gameID = $_GET['invite'];
	if(StartGame::CheckAvailability($_GET['invite'])){
		if(!isset($_COOKIE['username'])){
			setcookie('username','Guest', time() + (86400 * 30), "/");
		}
		if(StartGame::CheckGame($_GET['invite'],$_COOKIE['username'])){
			if(!DB::query('SELECT * FROM codesrepo WHERE username=:username AND game=:game',array(':username'=>$_COOKIE['username'],':game'=>$_GET['invite']))){
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
		<?php 
		if(isset($_GET['invite'])):
			if(StartGame::CheckAvailability($_GET['invite'])):
		?>
		<script
 			src="https://code.jquery.com/jquery-3.4.1.min.js"
  			integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  			crossorigin="anonymous">
		</script>
		<script src="./layout/js/refesh.js"></script>
		<?php 
		endif; endif;
		?>
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./layout/css/bingocss.css">
	</head>
	<body>
			<div class="root" CurrentPlayer="2" PlayerPlaying="2">
				<div class="verify">
					<!-- Loading Verifications-->
				</div>
			<div class="Alpha">
			<?php if(isset($_GET['invite'])): // condition zero
				if(StartGame::CheckAvailability($gameID)):
				if(StartGame::CheckGame($gameID,$_COOKIE['username'])):
				?>
				<div class="Answer">
				<!-- Loading From SumbittionLoader -->
				</div>
				<div class="game" id="gameid" gameid="<?php echo $_GET['invite'] ?>">
				 <!-- Loading game content from GameLoader-->
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