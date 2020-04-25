<?php
$GamrURL = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?invite='.$_GET['code'];
header('Location:'.$GamrURL);
?>