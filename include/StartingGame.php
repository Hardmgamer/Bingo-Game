<?php
class StartGame{
    public static function CheckGame($GameID,$Player){
        if(DB::query('SELECT id FROM games WHERE id=:id',array(':id'=>$GameID))){ // Checking if game exists
            if(DB::query('SELECT player1 FROM games WHERE id=:id AND player1=:player or id=:id AND player2=:player ',array(':id'=>$GameID,':player'=>$Player))){ //Checking if the entery is either from the host or his friend
                if(DB::query('SELECT player1 FROM games WHERE id=:id AND player2=:player',array(':id'=>$GameID,':player'=>$Player))){ //Checking if entery is player2
                    return true;
                } 
                elseif(DB::query('SELECT player1 FROM games WHERE id=:id AND player1=:player AND player2=""',array(':id'=>$GameID,':player'=>$Player))){
                    return false;
                }
                else{
                    return true;
                }
            }
            elseif(DB::query('SELECT player1 FROM games WHERE id=:id AND  player2 != :player',array(':id'=>$GameID,':player'=>$Player))){
                StartGame::AddPlayer($GameID);
                return true;
            }
        }
        else{ // game does not exist
            return "NotFound";
        }
    }
    private function AddPlayer($GameID){
        DB::query('UPDATE games SET player2=:player WHERE id=:id',array(':id'=>$GameID,':player'=>$_COOKIE['username']));
    }
}
?>