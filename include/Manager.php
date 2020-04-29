<?php
require_once('./include/StartingGame.php');
class GameManager{
    public static function RoundCreator($gameID,$CurrentPlayer){
        $Player1=DB::query('SELECT player1 FROM games WHERE id=:id',array(':id'=>$gameID))[0]['player1'];
        $Player2=DB::query('SELECT player2 FROM games WHERE id=:id',array(':id'=>$gameID))[0]['player2'];
        if($CurrentPlayer==$Player1 || $CurrentPlayer == $Player2 ){
            if(!DB::query('SELECT id FROM turnlog WHERE gameid=:game',array(':game'=>$gameID))){
                return DB::query('INSERT INTO turnlog VALUES(\'\',:id,:player,\'\',0)',array(':id'=>$gameID,':player'=>$Player1));
            }
            elseif(DB::query('SELECT MAX(id) as id FROM turnlog WHERE gameid=:game AND player=:player',array(':game'=>$gameID,':player'=>$CurrentPlayer))){
                DB::query('UPDATE turnlog SET STATUS=1 WHERE gameid=:game AND player=:player',array(':game'=>$gameID,':player'=>$CurrentPlayer));
                if($CurrentPlayer == $Player1){
                    return DB::query('INSERT INTO turnlog VALUES(\'\',:id,:player,\'\',0)',array(':id'=>$gameID,':player'=>$Player2));
                }
                else{
                    return DB::query('INSERT INTO turnlog VALUES(\'\',:id,:player,\'\',0)',array(':id'=>$gameID,':player'=>$Player1));
                }
            }
            else{
                return die("cannot excute");
            }
        }
    }
    public static function TurnOperator($gameID){
        if(StartGame::CheckAvailability($gameID)){
            if(DB::query('SELECT status FROM turnlog WHERE gameid=:game',array(':game'=>$gameID))){
                $MaxID=DB::query('SELECT MAX(id) FROM turnlog WHERE gameid=:game',array(':game'=>$gameID))[0]['MAX(id)'];
                return DB::query('SELECT player FROM turnlog WHERE gameid=:game AND id=:alt',array(':game'=>$gameID,':alt'=>$MaxID))[0]['player'];
            }
        }
        else{
            return false;
        }
    }
    public static function VerifyCode($gameID,$enterd){
        if(DB::query('SELECT code FROM codesrepo WHERE game=:game AND code=:code',array(':game'=>$gameID,':code'=>$enterd))){
            if(self::TurnOperator($gameID)==$_COOKIE['username']){
            DB::query('UPDATE codesrepo SET checked=1 WHERE game=:game AND code=:code',array(':game'=>$gameID,':code'=>$enterd));
            return self::RoundCreator($gameID,$_COOKIE['username']);
            }
        }
        else{
            return self::RoundCreator($gameID,$_COOKIE['username']);
        }
    }
    public static function VerifyExistance($gameID){
        if(DB::query('SELECT status FROM games WHERE id=:id',array(':id'=>$gameID)) == 0){
            return true;
        }
        else{
            return false;
        }
    }
}
?>