
//Onclick sur notif iphone
$(function () {
    $('#phoneNumber').click(function () {
        var Number = '#phoneNumber';
        $(Number).html('<div class="text-center text-barber-blue font-weight-bold" style="font-size:16px">06 22 39 13 20</div>');

    });
});

//Date dans le téléphone
/* function getDateTime() {
    var d = new Date();
    var hours = d.getHours() + ":" + (
        d.getMinutes() < 10 ? '0' : ''
    ) + d.getMinutes();

    document.getElementById("dateTime").innerHTML = hours;
}  */
setInterval(function () {
    var d = new Date();
    var hours = d.getHours() + ":" + (
        d.getMinutes() < 10 ? '0' : ''
    ) + d.getMinutes();

    document.getElementById("dateTime").innerHTML = hours;
}, 1000);
/* getDateTime(); */

//Animation ciseaux
setInterval(function () {
    $("#ciseaux").animate({
        bottom: '5px',
        height: '90px',
        width: 'auto'
    }, "slow");
}, 2000);

setTimeout(function () {
    setInterval(function () {
        $("#ciseaux").animate({
            bottom: '40px',
            height: '80px',
            width: 'auto'
        }, "slow");
    }, 2000);
}, 1000);

$(function() {
    $("#ciseaux").click(function(){
        $('html,body').animate({scrollTop: $("#presentation").offset().top - 70}, 'slow');
    })
});

//Apparition Snap
$(function() {
    $("#snapchatIcone").click(function(){
        $("#snapchatImage").removeClass('d-none').addClass('d-block');
        $("#iheb").removeClass('d-block').addClass('d-none');
        $("#snapchatImage").addClass('animation-app');
        setTimeout( function() {
            $("#ihebCross").removeClass('d-none').addClass('d-block'); 
        }, 1500);
    })
});

//Disparition Snap
$(function() {
    $("#ihebCross").click(function(){
        $("#snapchatImage").addClass('animation-disp');
        $("#ihebCross").removeClass('d-block').addClass('d-none'); 
        setTimeout( function() {
            $("#iheb").removeClass('d-none').addClass('d-block');
            $("#snapchatImage").removeClass('d-block').addClass('d-none');
        }, 1500);
    })
});
