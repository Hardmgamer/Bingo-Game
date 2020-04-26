<?php
class GetGame{
    public static function GetGameData($gameID){
        if(DB::query('SELECT id FROM games WHERE id=:id AND status=0',array(':id'=>$gameID))){
            $codes = DB::query('SELECT code,checked FROM codesrepo WHERE game=:gameID AND username=:username',array(':gameID'=>$gameID,':username'=>GameManager::TurnOperator($gameID)));
            return $codes;
        }
        else{
            return false;
        }
    }
}
?>