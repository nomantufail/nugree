$(document).ready(function() {
    checkWidth();
});

$(document).on('click', '.sideBar-opener', function(){
    $('body').toggleClass('sideBar-active');
});

$(document).on('click', '.slide-onMobile-opener', function(){
    $('.property-listing-holder').toggleClass('slide-onMobile-active');
});

$(document).on('click', '.slide-onMobile > li > a', function(){
    $('.property-listing-holder').removeClass('slide-onMobile-active');
    $('.slide-onMobile-opener').html($(this).html());
});

$(document).on('click', '.form-openerMobile', function(){
    $('.searhForm-holder').toggleClass('searh-dashboard-active');
});

function checkWidth() {
    var $window = $(window);
    var windowsize = $window.width();
    if (windowsize < 768) {
        $('body').removeClass('sideBar-active');
    }
    else{
        $('body').addClass('sideBar-active');
    }
}

$(document).on('click', '.sideBar-links li a', function(){
    var $window = $(window);
    var windowsize = $window.width();
    if (windowsize < 768) {
        $('body').removeClass('sideBar-active');
    }
});
