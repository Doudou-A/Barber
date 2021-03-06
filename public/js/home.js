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

$(function () {
    $("#ciseaux").click(function () {
        $('html,body').animate({ scrollTop: $("#presentation").offset().top - 100 }, 'slow');
    })
});

$(function () {
    $(".presentationNavBar").click(function () {
            $('html,body').animate({ scrollTop: $("#presentation").offset().top - 100 }, 'slow');
    })
});

$(function () {
    $(".coiffeurNavBar").click(function () {
        $('html,body').animate({ scrollTop: $("#team").offset().top - 100 }, 'slow');
    })
});
$(function () {
    $(".contactNavBar").click(function () {
        $('html,body').animate({ scrollTop: $("#contact").offset().top - 100 }, 'slow');
    })
});

//ClickHome
setTimeout(function () {
    $(".clickHome").addClass('d-none');
}, 10000);

//Apparition Snap
$(function () {
    $(".snapIcone").click(function () {
        var snapImage = $("#snapchatImage_" + this.id);
        var coiffeur = $("#coiffeurImage_" + this.id);
        var cross = $("#coiffeurCross_" + this.id);
        /* $("#snapchatImage").removeClass('d-none').addClass('d-block');
        $("#iheb").removeClass('d-block').addClass('d-none');
        $("#snapchatImage").addClass('animation-app'); */
        snapImage.removeClass('d-none').addClass('d-block');
        coiffeur.removeClass('d-block').addClass('d-none');
        snapImage.removeClass('animation-disp').addClass('animation-app');
        setTimeout(function () {
            // $("#ihebCross").removeClass('d-none').addClass('d-block'); 
            cross.removeClass('d-none').addClass('d-block');
        }, 1500);
    })
});

//Disparition Snap
$(function () {
    $(".coiffeurCross").click(function () {
        var idComplet = this.id;
        var cross = idComplet.split('_');
        var id = cross[1];
        var snapImage = $("#snapchatImage_" + id);
        var coiffeur = $("#coiffeurImage_" + id);
        snapImage.removeClass('animation-app').addClass('animation-disp');
        $(this).removeClass('d-block').addClass('d-none');
        setTimeout(function () {
            coiffeur.removeClass('d-none').addClass('d-block');
            snapImage.removeClass('d-block').addClass('d-none');
        }, 1500);
    })
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
}, 5000);
/* getDateTime(); */