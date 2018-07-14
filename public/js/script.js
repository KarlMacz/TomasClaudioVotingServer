function initializeNavbar() {
    $('body').on('click', '.navbar .dropdown > .item', function(e) {
        e.stopPropagation();

        if($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }

        return false;
    });
}

$(document).ready(function() {
    initializeNavbar();

    $('body').on('click', function() {
        $('.navbar .dropdown > .item').removeClass('active');
    });

    $('body').on('click', '.logout-button', function() {
        $('#logout-form').submit();

        return false;
    });
});
