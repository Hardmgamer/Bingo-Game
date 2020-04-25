<?php
class GetGame{
    public static function GetGameData($gameID){
        if(DB::query('SELECT id FROM games WHERE id=:id AND status=0',array(':id'=>$gameID))){
            $codes = DB::query('SELECT code, checked FROM codesrepo WHERE game=:gameID',array(':gameID'=>$gameID));
            return $codes;
        }
        else{
            return false;
        }
    }
}
?>