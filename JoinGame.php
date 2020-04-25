<?php
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?invite='.$_GET['code'];
header('Location:'.$home_url);
?>