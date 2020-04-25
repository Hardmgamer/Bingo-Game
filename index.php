<?php 
require_once('./include/DB.php');
require_once('./include/GetGame.php');
if(isset($_GET['invite'])){
	$gameID = $_GET['invite'];
	$codes= GetGame::GetGameData($gameID);
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
				<?php if($_GET['invite']): ?>
				<div class="content">
					<p>$Player Turn!</p>
				</div>
				<div class="container">
					<?php foreach($codes as $code):?>
					<div class="box">
						<p><?php echo $code['code'] ?></p>
					</div>
					<?php endforeach?>
				</div>	
			</div>
			<?php else: ?>
			<div class="content">
				<p>No invitation code!</p>
			</div>
			<?php endif ?>
		</div>
	</body>
</html>