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
                url: '/index.php/admin/reservation/delete/one/' + dateId,
                timeout: 5000,
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
                url: '/index.php/coiffeur/indispo/' + dateId,
                timeout: 5000,
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
                url: '/index.php/coiffeur/dispo/' + dateId,
                timeout: 5000,
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

//request reservation
$(function () {
    $('#ajax-loading').hide();
    $('body').on('click', '.coiffeurReservation', function () {
        $('#loading-bg').show();
        $('#ajax-loading').show();
        var coiffeurId = this.id;
        var divRequest = "#coiffeur_request";
        var titre = "#titreReservation";
        $.ajax({
            type: 'GET',
            url: '/index.php/Reservation-Show/' + coiffeurId,
            timeout: 15000,
            success: function (data) {
                $(divRequest).html(data.html);
                $(titre).html("Choisir la date de réservation");
                $('#ajax-loading').hide();
                $('#loading-bg').hide();
                $('html,body').animate({ scrollTop: $("#coiffeur_request").offset().top - 150 }, 'slow');
            },
            error: function () {
                alert('La requête n\'a pas abouti');
            }
        });
    });
});

//request reservation Dashboard
$(function () {
    $('#ajax-loading').hide();
    $('body').on('click', '.coiffeurReservationAdmin', function () {
        $('#loading-bg').show();
        $('#ajax-loading').show();
        var coiffeurId = this.id;
        var divRequest = "#coiffeur_request";
        var titre = "#titreReservation";
        $.ajax({
            type: 'GET',
            url: '/index.php/Admin/Reservation-Show/' + coiffeurId,
            timeout: 15000,
            success: function (data) {
                $(divRequest).html(data.html);
                $(titre).html("Choisir la date de réservation");
                $('#ajax-loading').hide();
                $('#loading-bg').hide();
                $('html,body').animate({ scrollTop: $("#coiffeur_request").offset().top - 150 }, 'slow');
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
        var divSuppr = $(this).find(".adminDeleteReservation");
        $(this).removeClass('col-6').removeClass('offset-3').removeClass('adminReservation').addClass('adminReservationOpen').addClass('col-12');
        divSuppr.removeClass('d-none').addClass('d-block');
        $.ajax({
            type: 'GET',
            url: '/index.php/admin/reservation/user/' + dataUrl,
            timeout: 5000,
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
        var divSuppr = $(this).find(".adminDeleteReservation");
        $(this).removeClass('adminReservationOpen').removeClass('col-12').addClass('col-6').addClass('offset-3').addClass('adminReservation');
        divSuppr.removeClass('d-block').addClass('d-none');
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
        $(this).removeClass('col-6').removeClass('dayPhoneRdv').addClass('col-10').addClass('offset-1');
        divdatePhone.addClass('dayPhoneRdvDisappear').addClass('btn').addClass('btn-primary').addClass('font-weight-bold');
        divHourPhone.removeClass('d-none').addClass('d-block');
    });
});
$(function () {
    $('body').on('click', '.dayPhoneRdvDisappear', function () {
        var divDayPhone = "#dayPhone_" + this.id;
        var divHourPhone = $(divDayPhone).find(".hourPhoneRdv");
        console.log(divDayPhone);
        $(divDayPhone).removeClass('col-10').removeClass('offset-1').addClass('col-2').addClass('dayPhoneRdv');
        $(this).removeClass('dayPhoneRdvDisappear').removeClass('btn').removeClass('btn-primary').removeClass('font-weight-bold');
        divHourPhone.removeClass('d-block').addClass('d-none');
    });
});

//Admin Create reservation
$(function () {
    $('body').on('click', '.adminCreateReservation', function () {
        event.preventDefault();
        var formAdminReser = $(this).find(".adminFormCreateDisplay");
        console.log(formAdminReser);
        $(this).removeClass("adminCreateReservation").addClass('col-12');
        $(formAdminReser).removeClass("d-none");
    });
});

// Btn calendar 
$(function () {
    $('body').on('click', '.calendarBtn', function () {
        $('#loading-bg').show();
        $('#ajax-loading').show();
        var dataUrl = this.id;
        var divRequest = $("#coiffeur_request");
        $.ajax({
            type: 'GET',
            url: '/index.php/admin/Calendar-Show/' + dataUrl,
            timeout: 5000,
            success: function (data) {
                console.log(data);
                console.log(divRequest);
                $(divRequest).html(data.html);
                $('#ajax-loading').hide();
                $('#loading-bg').hide();
                $('html,body').animate({ scrollTop: $("#coiffeur_request").offset().top - 150 }, 'slow');
            },
            error: function () {
                alert('La requête n\'a pas abouti' + url);
            }
        });
    });
});