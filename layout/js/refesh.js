$(document).ready(function(){  
    checker();
    loadstation();
});

function loadstation(){
    var link = $('.game').attr("gameid");
    $('.game').load("Game.php?invite="+link);
    setTimeout(loadstation, 2000);
}
function checker(){
var link = $('.game').attr("gameid");
if($(".Answer > div").length==0){
    $('.Answer').load("Answer.php?invite="+link);
}
setTimeout(checker, 2000);
}