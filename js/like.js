/**
 * Created by fabiovandooren on 28/04/16.
 */
$(document).ready(function(){
    $('#hartje').click(function(){
        var clickHartje = $(this).attr("id");
        var ajaxurl = 'ajax/ajaxLike.php',
            data =  {'action': clickHartje};
        $.post('ajax/ajaxLike.php', {id : id})
            .done(function( response ){
                if(response.status === 'like') {
                    //hartje veranderen naar liked
                    clickHartje.attr('src','/images/like.png');
                    //saveLike?


                }
                else{
                    clickHartje.attr('src','/images/unlike.png');
                }
            })

    });
    //e.preventDefault();

});
