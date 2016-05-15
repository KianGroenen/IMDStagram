/**
 * Created by fabiovandooren on 22/03/16.
 */
$(document).ready(function(){


    // jQuery methods go here...
    $("#registratieHere").click(function(){
        window.location.href='registratie.php';
    });

    $("#Username").on("keyup", function(e) {
        "use strict";
        // username ophalen uit tekstveld
        var username = $("#Username").val();
        $(".usernameFeedback").show();

        // Ajax call: verzenden naar php bestand om query uit te voeren
        $.post("ajax/check_username.php", {username: username})
            .done(function( response ){
                $("#loadingImage").hide();
                $('.usernameFeedback span').text(response.message);

                if(response.status === 'error') {
                    $('#submit').prop('disabled', true);
                } else {
                    $('#submit').prop('disabled', false);
                }
            });
        e.preventDefault();
    });

});
