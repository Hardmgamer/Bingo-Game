<?php
class CreateGame {
    public static function Creator($Player1,$min=1,$max=50){
        session_start();
        $_SESSION['Player']=$Player1;
        DB::query('INSERT INTO games VALUES(\'\',:player,\'\',0)',array(':player'=>$Player1));
        $gameID = DB::query('SELECT id FROM games ORDER BY id DESC LIMIT 1')[0];
        $codes = CreateGame::CreateCodes($min,$max,25);
        foreach($codes as $code){
            DB::query('INSERT INTO codesrepo VALUES(\'\',:game,:code,0)',array(':game'=>$gameID[0],':code'=>$code));
        }
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?invite='.$gameID[0];
        header('Location:'.$home_url);
    }
    private function CreateCodes($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
    }
}
?>
