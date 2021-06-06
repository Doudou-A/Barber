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

//NavBar d-none
$(function () {
    var presentation = $('#presentation');
    if (!presentation.length) {
        $('.presentationNavBar').addClass('d-none');
    }
});

$(function () {
    var coiffeur = $('#team');
    if (!coiffeur.length) {
        $('.coiffeurNavBar').addClass('d-none');
    }
});

$(function () {
    var contact = $('#contact');
    if (!contact.length) {
        $('.contactNavBar').addClass('d-none');
    }
});

//bg loading
$(function () {
    $('#loading-bg').hide();
});
