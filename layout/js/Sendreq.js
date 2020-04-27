$(document).ready(function(){
    var link = $('.game').attr("gameid");
    $('.Answer').on('click', '.btn', function (){
        var value = $(this).attr('code').trim();
        console.log('test');
        $('.Answer').load('submitanswer.php',
        {
            gameid: link,
            Answer:value
        },
        )
    })
}
)