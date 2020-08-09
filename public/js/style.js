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

//Delete Reservation
$(function () {
    $('body').on('click', '.adminDeleteReservation', function () {
        if (confirm("Confirmer cette annulation ?")) {
            var dateId = this.id;
            $.ajax({
                type: 'POST',
                url: '/admin/reservation/delete/one/'+dateId,
                timeout: 3000,
                success: function (data) {
                    location.reload();
                },
                error: function () {
                    alert('La requête n\'a pas abouti');
                }
            });
        } else {
            // Code à éxécuter si l'utilisateur clique sur "Annuler" 
        }
    });
});

//Indispo Coiffeur
$(function () {
    $('body').on('click', '.adminIndisponibleCoiffeur', function () {
        if (confirm("Confirmer cette indisponibilité ?")) {
            var dateId = this.id;
            $.ajax({
                type: 'POST',
                url: '/coiffeur/indispo/'+dateId,
                timeout: 3000,
                success: function (data) {
                    location.reload();
                },
                error: function () {
                    alert('La requête n\'a pas abouti');
                }
            });
        } else {
            // Code à éxécuter si l'utilisateur clique sur "Annuler" 
        }
    });
});

//Dispo Coiffeur
$(function () {
    $('body').on('click', '.adminDisponibleCoiffeur', function () {
        if (confirm("Rendre disponible ?")) {
            var dateId = this.id;
            $.ajax({
                type: 'POST',
                url: '/coiffeur/dispo/'+dateId,
                timeout: 3000,
                success: function (data) {
                    location.reload();
                },
                error: function () {
                    alert('La requête n\'a pas abouti');
                }
            });
        } else {
            // Code à éxécuter si l'utilisateur clique sur "Annuler" 
        }
    });
});
/* $(function () {
    $(".formAdminUser").submit(function (event) {
        event.preventDefault(); // Empêcher le rechargement de la page.
        var post_url = $(this).attr("action"); // get form action url
        var request_method = $(this).attr("method"); // get form GET/POST method
        var form_data = $(this).serialize(); // Encode form elements for submission
        var divRequest = "#user_request";
        $.ajax({
            url: post_url, type: request_method, data: form_data, //
            success: function (data) {
                console.log(data);
                $(divRequest).html(data.html);
                /* $(this).trigger('click'); 
            }
        });
    });
}); */

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
    $('body').on('click', '.zoomPresentation', function () {
        $(this).removeClass('col-3').removeClass('hoverWB').removeClass('hiddenPresentation').removeClass('zoomPresentation').addClass('col-10').addClass('offset-1').addClass('position-absolute').addClass('zoomPresentationSnd');
        $('.hiddenPresentation').addClass('d-none').removeClass('d-flex');
    })
});
$(function () {
    $('body').on('click', '.zoomPresentationSnd', function () {
        $(this).removeClass('col-10').removeClass('offset-1').removeClass('position-absolute').removeClass('zoomPresentationSnd').addClass('col-3').addClass('hoverWB').addClass('hiddenPresentation').addClass('zoomPresentation');
        $('.hiddenPresentation').removeClass('d-none').addClass('d-flex');
    })
});

//request reservation
$(function () {
    $('body').on('click', '.coiffeurReservation', function () {
        var coiffeurId = this.id;
        var divRequest = "#coiffeur_request";
        var titre = "#titreReservation";
        $.ajax({
            type: 'GET',
            url: '/Reservation-Show/' + coiffeurId,
            timeout: 3000,
            success: function (data) {
                console.log(divRequest);
                $(divRequest).html(data.html);
                $(titre).html("Choisir la date de réservation");
            },
            error: function () {
                alert('La requête n\'a pas abouti');
            }
        });
    });
});

// AdminReservation
$(function () {
    $('body').on('click', '.adminReservation', function () {
        var dataUrl = this.id;
        var divRequest = $(this).find("#user_request");
        $(this).removeClass('col-6').removeClass('offset-3').removeClass('adminReservation').addClass('adminReservationOpen');
        $.ajax({
            type: 'GET',
            url: '/admin/reservation/user/' + dataUrl,
            timeout: 3000,
            success: function (data) {
                console.log(data);
                console.log(divRequest);
                $(divRequest).html(data.html);
            },
            error: function () {
                alert('La requête n\'a pas abouti' + url);
            }
        });
    });
});
$(function () {
    $('body').on('click', '.adminReservationOpen', function () {
        var divRequest = $(this).find("#user_request");
        $(this).addClass('col-6').addClass('offset-3').addClass('adminReservation').removeClass('adminReservationOpen');
        $(divRequest).html('');
    });
});

//Fleche déplacement 
$(function () {
    $('body').on('click', '#right', function () {
        event.preventDefault();
        var width = $("#block").width();
        $("#block").animate({ scrollLeft: "+=" + width }, "slow");

    });
});

$(function () {
    $('body').on('click', '#left', function () {
        event.preventDefault();
        var width = $("#block").width();
        $("#block").animate({ scrollLeft: "-=" + width }, "slow");
    });
});