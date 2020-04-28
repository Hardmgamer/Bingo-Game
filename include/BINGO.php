<?php 
//working on this code for ending the game.
require_once('./DB.php');
class BINGO{
    public static function GameBingo(){
        $card = DB::query('SELECT code,checked FROM codesrepo WHERE game=109 AND username="realMoSalah"');
        echo self::CalcColumn($card).'<br>';
       // echo self::Calctendon($card).'<br>';
    }
    private function CalcRow($Code,$verified=0,$row=0,$N=5){ // N Is the Number of rows
        for($i=0;$i<=($N*($N-1));$i+=$N){
            for($j=$i; $j<$i+$N;$j++){
                if($Code[$j]['checked']==1){
                    $row++;
                }
            }
            if($row==5){
                $verified++;
            }
            $row=0;
        }
        return $verified;
    }
    private function CalcColumn($Code,$verified=0,$column=0,$N=5){ // N Is the Number of rows
        for($i=0;$i<$N;$i++){
            for($j=$i;$j<=$i+($N*($N-1));$j+=$N){
                if($Code[$j]['checked']==1){
                    $column++;
                }
            }
            if($column==$N){
                $verified++;
            }
            $column=0;
        }
        return $verified;
    }
    private function CalcTendon($Code,$verified=0,$tendon=0){
        for($i=0; $i<=1;$i++){
            
        }
    }
}

BINGO::GameBingo();
?>