<?php
require_once("./include/header.php");
$codes = DB::query('SELECT code FROM codesrepo WHERE game=:gameID AND username =:username AND checked != 1 ORDER BY code ASC',array(':gameID'=>$_GET['invite'],':username'=>$_COOKIE['username']));
sort($codes);
$clength = count($codes);
?>
	<?php if(GameManager::TurnOperator($_GET['invite'])==$_COOKIE['username']){ ?>
	<div class="GetData">
	<?php for($x = 0; $x < $clength; $x++):?>
		<div class="btn" code="<?php echo $codes[$x]['code']?>"><?php echo $codes[$x]['code'] ?></div>
	<?php endfor; ?>
	<?php }?>
	</div>
