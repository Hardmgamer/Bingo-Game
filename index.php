<?php 
require_once("./include/header.php");
if(!isset($_COOKIE['username'])){
	setcookie('username','Guest', time() + (86400 * 30), "/");
}
if(isset($_GET['invite'])){
	$gameID = $_GET['invite'];
	if(StartGame::CheckAvailability($_GET['invite'])){
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
		<script src="./layout/js/sendreq.js"></script>
		<?php 
		endif; endif;
		?>
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./layout/css/bingocss.css">
	</head>
	<body>
			<div class="root">
			<div class="Alpha">
			<?php if(isset($_GET['invite'])): // condition zero
				if(StartGame::CheckAvailability($gameID)):
				if(StartGame::CheckGame($gameID,$_COOKIE['username'])):
				?>
				<div class="Answer">
				<!-- Loading From Answer Loader -->
				</div>
				<div class="game" id="gameid" gameid="<?php echo $_GET['invite'] ?>">
				 <!-- Loading game content from Game Loader-->
				</div>
				<div class="Submit">
				<div class="button">BINGO!</div>
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