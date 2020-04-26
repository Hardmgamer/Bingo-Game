$(document).ready(function(){  
    loadreload()
    loadstation();
});

function loadstation(){
    var link = $('.game').attr("gameid");
    $('.game').load("Game.php?invite="+link);
        $('.Answer').load("Answer.php?invite="+link);
    setTimeout(loadstation, 2000);
}
function loadreload(){
    var link = $('.game').attr("gameid");
    $('.verify').load("reload.php?invite="+link);
    setTimeout(loadreload, 2000);
}