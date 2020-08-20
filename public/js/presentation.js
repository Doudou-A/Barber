
//zoomPresentation
$(function () {
    $('body').on('click', '.zoomPresentation', function () {
        $(this).removeClass('col-lg-3').removeClass('col-5').removeClass('hoverWB').removeClass('hiddenPresentation').removeClass('zoomPresentation').addClass('col-12').addClass('position-absolute').addClass('zoomPresentationSnd').addClass('h-75');
        $('.hiddenPresentation').addClass('d-none').removeClass('d-flex');
    })
});
$(function () {
    $('body').on('click', '.zoomPresentationSnd', function () {
        $(this).removeClass('col-12').removeClass('position-absolute').removeClass('zoomPresentationSnd').removeClass('h-75').addClass('col-lg-3').addClass('col-lg-5').addClass('hoverWB').addClass('hiddenPresentation').addClass('zoomPresentation');
        $('.hiddenPresentation').removeClass('d-none').addClass('d-flex');
    })
});
