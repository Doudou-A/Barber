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
        $('html,body').animate({ scrollTop: $("#presentation").offset().top - 70 }, 'slow');
    })
});

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

//Formulaire Réservation
$(function () {
    $(".formReservation").submit(function (event) {
        event.preventDefault(); // Empêcher le rechargement de la page.
        if (confirm("Confirmer ce rendez-vous ?")) {
            var post_url = $(this).attr("action"); // get form action url
            var request_method = $(this).attr("method"); // get form GET/POST method
            var form_data = $(this).serialize(); // Encode form elements for submission

            $.ajax({
                url: post_url, type: request_method, data: form_data, //
                success: function (data) {
                    console.log(data);
                    /* $(this).trigger('click'); */
                }
            });
        } else {
            // Code à éxécuter si l'utilisateur clique sur "Annuler" 
        }

    });
});

//Hover Coiffeur
$(function () {
    $(".hoverWB").hover(function () {
        $(this).addClass("p-4 border-0 btn bg-ligth");
    }, function () {
        $(this).removeClass("p-4 border-0 btn bg-ligth");
    });
});

//Flash disparition
setTimeout(function () {
    $('.flash').addClass('d-none');
}, 5000);

//zoomPresentation
$(function () {
    $(".zoomPresentation").click(function () {
        $(this).removeClass('col-3').removeClass('hoverWB').removeClass('hiddenPresentation').removeClass('zoomPresentation').addClass('col-10').addClass('offset-1').addClass('position-absolute').addClass('zoomPresentationSnd');
        $('.hiddenPresentation').addClass('d-none').removeClass('d-flex');
    })
});
$(function () {
    $(".zoomPresentationSnd").click(function () {
        $(this).removeClass('col-10').removeClass('offset-1').removeClass('position-absolute').removeClass('zoomPresentationSnd').addClass('col-3').addClass('hoverWB').addClass('hiddenPresentation').addClass('zoomPresentation');
        $('.hiddenPresentation').removeClass('d-none').addClass('d-flex');
    })
});
