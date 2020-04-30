<?php
// working on (Decreasing Queries From 100 Per game to 4 queries By exploding and Imploding them)
require_once('./include/CreateGame.php');
class DataManager extends CreateGame{
    public function changeCodeType(){
        $codesInArray = CreateGame::CreateCodes(1,50,25); //generated Code
        $CodeInComma = implode(",",$codesInArray);
        return $CodeInComma;
    }
    public function getDataInArray(){
        //Fetching Game codes From Source source
        $ImplodedCode = implode(",",$codesArray);
        $CodeInArray = explode(",",$ImplodedCode);
        return $CodeInArray;
    }
}
?>