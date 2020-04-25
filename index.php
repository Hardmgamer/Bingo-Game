<?php 
require_once('./include/DB.php');
require_once('./include/random.php');
$numbers = gen::randomGen(1,50,25);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Play Bingo</title>
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="bingocss.css">
	</head>
	<body>
		<div class="root">
			<div class="Alpha">
				<?php if($_GET['invite']): ?>
				<div class="content">
					<p>realMoSalah Turn!</p>
				</div>
				<div class="container">
					<?php foreach($numbers as $number):?>
					<div class="box">
						<p><?php echo $number ?></p>
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