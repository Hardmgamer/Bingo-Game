<?php
class CreateGame {
    public static function Creator($player,$min=1,$max=50,$create=0){
        setcookie('username',$player, time() + (86400 * 30), "/");
        DB::query('INSERT INTO games VALUES(\'\',:player,\'\',0)',array(':player'=>$player));
        $gameID = DB::query('SELECT id FROM games ORDER BY id DESC LIMIT 1')[0];
        $codes = CreateGame::CreateCodes($min,$max,25);
        foreach($codes as $code){
            DB::query('INSERT INTO codesrepo VALUES(\'\',:game,:code,:player,0)',array(':game'=>$gameID[0],':code'=>$code,':player'=>$player));
        }
        shuffle($codes);
        foreach($codes as $code){
            DB::query('INSERT INTO codesrepo VALUES(\'\',:game,:code,\'\',0)',array(':game'=>$gameID[0],':code'=>$code));
        }
        if($create==1){
            GameManager::RoundCreator($gameID[0],$player);
        }
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?invite='.$gameID[0];
        header('Location:'.$home_url);
    }
    private function CreateCodes($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
    public static function Guest($gameID){
            DB::query('UPDATE codesrepo SET username=:username WHERE game=:game AND username=""',array(':username'=>$_COOKIE['username'],':game'=>$gameID));
    }
}
?>
