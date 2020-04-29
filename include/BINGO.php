<?php 
class BINGO{
    public static function GameBingo($gameID){
        $card = DB::query('SELECT code,checked FROM codesrepo WHERE game=:game AND username=:user',array(':game'=>$gameID,':username'=>$_COOKIE['username']));
        if(GameManager::TurnOperator($gameID)){ // turnoperator will check if the game is available too
            if(self::CalcRow($card)+self::CalcColumn($card)+self::CalcTendon($card) >= 5){
                DB::query('UPDATE games SET status=1 WHERE $gameID=:game',array(':game'=>$gameID));
            }
         }
    }
    private function CalcRow($Code,$verified=0,$row=0,$N=5){ // N Is the Number of rows/Columns When Row = Columns (in case of 4*4 game or 3*3 game) Default is 5*5
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
    private function CalcColumn($Code,$verified=0,$column=0,$N=5){ // N Is the Number of rows/Columns When Row = Columns (in case of 4*4 game or 3*3 game) Default is 5*5
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
    private function CalcTendon($Code,$verified=0,$tendon=0,$N=5){ // N Is the Number of rows/Columns When Row = Columns (in case of 4*4 game or 3*3 game) Default is 5*5
        for($i=0; $i<=($N*($N-1));$i+=($N*($N-1))){
            if($i==0){
                for($j=$i;$j<=(($N*$N)-1);$j+=$N+1){
                    if($Code[$j]['checked']==1){
                        $tendon++;
                    }
                }  
            } 
            else{
                for($j=$i;$j>=($N-1);$j-=($N-1)){
                    if($Code[$j]['checked']==1){
                        $tendon++;
                    }
                }   
            }
            if($tendon==$N){
                $verified++;
            }
            $tendon=0;
        }
        return $verified;
    }
}
?>