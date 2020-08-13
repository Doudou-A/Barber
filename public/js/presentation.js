
//zoomPresentation
$(function () {
    $('body').on('click', '.zoomPresentation', function () {
        $(this).removeClass('col-lg-3').removeClass('hoverWB').removeClass('hiddenPresentation').removeClass('zoomPresentation').addClass('col-10').addClass('offset-1').addClass('position-absolute').addClass('zoomPresentationSnd');
        $('.hiddenPresentation').addClass('d-none').removeClass('d-flex');
    })
});
$(function () {
    $('body').on('click', '.zoomPresentationSnd', function () {
        $(this).removeClass('col-10').removeClass('offset-1').removeClass('position-absolute').removeClass('zoomPresentationSnd').addClass('col-lg-3').addClass('hoverWB').addClass('hiddenPresentation').addClass('zoomPresentation');
        $('.hiddenPresentation').removeClass('d-none').addClass('d-flex');
    })
});
