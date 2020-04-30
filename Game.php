<?php
require_once("./include/header.php");
$codes= GetGame::GetGameData($_GET['invite']);
?>
				<div class="content">
					<p> <?php echo GameManager::TurnOperator($_GET['invite']); ?> Turn!🤯</p>
				</div>
				<div class="container">
					<?php foreach($codes as $code){?>
					<div class="box">
						<p><?php if($code['checked'] == 1):
								echo "💣";
						else:
							echo $code['code'];
						endif;
							?></p>
					</div>
					<?php } ?>
				</div>

