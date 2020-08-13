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

//PhoneOpenHour
$(function () {
    $('body').on('click', '.dayPhoneRdv', function () {
        var divHourPhone = $(this).find(".hourPhoneRdv");
        var divdatePhone = $(this).find(".dataPhone");
        $(this).removeClass('col-6').addClass('col-10').addClass('offset-1');
        divdatePhone.addClass('dayPhoneRdvDisappear');
        divHourPhone.removeClass('d-none').addClass('d-block');
    });
});
$(function () {
    $('body').on('click', '.dayPhoneRdvDisappear', function () {
        var divDayPhone = "#dayPhone_"+this.id;
        var divHourPhone = $(this).find(".hourPhoneRdv");
        console.log(divDayPhone);
        divDayPhone.addClass('col-6').removeClass('col-10').removeClass('offset-1');
        divHourPhone.removeClass('d-block').addClass('d-none');
    });
});
