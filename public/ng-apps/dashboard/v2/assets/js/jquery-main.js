$(document).ready(function() {
    $('.addPro-type:first').trigger('change');
    $('.registration-form').find('.role-listing').hide();

    if (screen.width < 1024){
        $('body').removeClass('sideBar-active');
        $(document).on('click', '.sideBar-links li', function(){
            $('body').removeClass('sideBar-active');
        });
    }

});

// page init
jQuery(function(){
    initLightbox();
    initCarousel();
});
function initCarousel() {
    jQuery('.propertyImage-slider').scrollGallery({
        mask: '.mask',
        slider: '.slideset',
        slides: '.slide',
        btnPrev: '.propertyImage-slider-btn-prev',
        btnNext: '.propertyImage-slider-btn-next',
        pagerLinks: '.propertyImage-pagination .propertyImage-slide',
        autoRotation: false,
        circularRotation: true,
        switchTime: 3000,
        animSpeed: 500,
        swipeGap: true
    });

    jQuery('.propertyImage-pagination').scrollGallery({
        mask: '.propertyImage-mask',
        slider: '.propertyImage-slideset',
        slides: '.propertyImage-slide',
        btnPrev: '.propertyImage-pagination-btn-prev-1',
        btnNext: '.propertyImage-pagination-btn-next-1',
        pagerLinks: '.pagination li',
        autoRotation: false,
        circularRotation: true,
        switchTime: 3000,
        animSpeed: 500,
        currentNumber: '.paginationCurrent-num-1',
        totalNumber: '.total-num-1',
        swipeGap: true
    });
}

$(document).on('change keyup', 'input, textarea, select', function(){
    $(this).closest('.input-holder').removeClass('error');
});

$(document).on('click', '.propertyImage-slider-btn-next, .propertyImage-slider-btn-prev', function(){
    var windowSize = 5;
    var currentSlideNumber = parseInt($('#propertyImageCurrentSlide').text());
    var currentSlideRemainder = currentSlideNumber/ windowSize;
    var currentSlideRemainderCeil = Math.ceil(currentSlideRemainder);
    var currentSlideRemainderFloor = Math.floor(currentSlideNumber);
    var currentWindowNumber = parseInt($('.paginationCurrent-num-1').text());

    if(currentSlideRemainderCeil > currentWindowNumber)
    {
        var stepsToMove = currentSlideRemainderCeil - currentWindowNumber;
        for(var i = 0; i< stepsToMove; i++){
            $('.propertyImage-pagination-btn-next-1').click();
        }
    }
    else if(currentSlideRemainderCeil < currentWindowNumber)
    {
        var stepsToMove = currentWindowNumber - currentSlideRemainderCeil;
        for(var i = 0; i< stepsToMove; i++){
            $('.propertyImage-pagination-btn-prev-1').click();
        }
    }
});

$(document).on('click', 'a.lightbox', function(){
    $('#wrapper').addClass('fancy-overlay');
});

$(document).mouseup(function (e)
{
    var container = $(".fancybox-opened");

    if (!container.is(e.target)
        && container.has(e.target).length === 0)
    {
        $('#wrapper').removeClass('fancy-overlay');
    }
});

$(document).on('click', '.generic-lightbox>.close, .fancybox-close', function(){
    $('#wrapper').removeClass('fancy-overlay');
});

$(document).keyup(function(e) {
    if (e.keyCode === 27){
        $('.fancybox-overlay-fixed').hide();
        $('#wrapper').removeClass('fancy-overlay');
    }   // esc
});

$(document).on('change', '.addPro-type', function(){
    $(this).closest('ul').find('li').removeClass('active');

    $('.addPro-type').each(function(){
        if($(this).is(':checked')){
            $(this).closest('li').addClass('active');
            $('.subtype-links').removeClass('hidden');
        }
    });
});

$(document).on('click', '.propertyImage-slider-btn-next, .propertyImage-slider-btn-prev', function(){
    var windowSize = 5;
    var currentSlideNumber = parseInt($('#propertyImageCurrentSlide').text());
    var currentSlideRemainder = currentSlideNumber/ windowSize;
    var currentSlideRemainderCeil = Math.ceil(currentSlideRemainder);
    var currentSlideRemainderFloor = Math.floor(currentSlideNumber);
    var currentWindowNumber = parseInt($('.paginationCurrent-num-1').text());

    if(currentSlideRemainderCeil > currentWindowNumber)
    {
        var stepsToMove = currentSlideRemainderCeil - currentWindowNumber;
        for(var i = 0; i< stepsToMove; i++){
            $('.propertyImage-pagination-btn-next-1').click();
        }
    }
    else if(currentSlideRemainderCeil < currentWindowNumber)
    {
        var stepsToMove = currentWindowNumber - currentSlideRemainderCeil;
        for(var i = 0; i< stepsToMove; i++){
            $('.propertyImage-pagination-btn-prev-1').click();
        }
    }
});


$(document).on('focusin', '.PriceField', function(){
    $('.calculatedPrice').removeClass('priceShow');
    $('.calculatedPrice').addClass('priceShow');
});
$(document).on('focusout', '.PriceField', function(){
    $('.calculatedPrice').removeClass('priceShow');
});


function previewAddPropertyImg(file, target)
{
    previewFile(file, target);
    $(file).closest('li').addClass('image-loaded');
    $(file).closest('li').find('.picture-name').focus();
}


function previewFile(file, target) {
    var preview = document.querySelector(target);
    var file    = file.files[0];
    var reader  = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}

$(document).on('click', '.propertyDocumentCloseBtn', function(){
    $(this).closest('li').find('.picture-name').val('');
    $(this).closest('li').find('img').attr('src', '#');
    $(this).closest('li').removeClass('image-loaded');
});

$(document).on('click', '.extra-features', function(){
    $(this).toggleClass('active');
    $('.list-extraFeatures').slideToggle();
});

$(document).on('keyup', '#search-society', function(){
    var searchValue = $(this).val();
    $('.societiesBlock-listing').find('li').each( function(){
        var re = new RegExp(searchValue, 'gi');
        if($(this).text().match(re) == null){
            $(this).hide();
        }else{
            $(this).show();
        }
    });
});

$('.hidden-checkfield').change(function(){
    if($(this).is(":checked")) {
        $('.registration-form').addClass("agent-info");
        $('.agent-information').slideDown();

    } else {
        $('.registration-form').removeClass("agent-info");
        $('.agent-information').slideUp();
        $('.picture-holder').css({
            'display':'none'
        });
    }
});

$(document).on('click', '.role-opener', function(){
    $('.registration-form').find('.role-listing').slideToggle();
    $(this).toggleClass('active');
});

function countCheckedRoles(){
    var totalCheckedRoles = 0;
    $('.userRole-checkbox').each(function() {
        if($(this).is(':checked'))
            totalCheckedRoles++;
    });
    if(totalCheckedRoles == 0)
        $('.role-opener').html('Other Roles');
    else
        $('.role-opener').html('Other Roles ( '+totalCheckedRoles+' Selected )');
}

$(document).on('change', '.userRole-checkbox', function(){
    countCheckedRoles();
});

$(document).on('change', '.agent-brokerCheckbox', function(){
    if($(this).is(':checked')){
        $('.agent-brokerCheckbox').each(function(){
            $(this).prop('checked', true);
        });
        $('.registration-form').addClass('agent-info')
        $('.agent-information').slideDown();
    }
    else {
        $('.agent-brokerCheckbox').each(function(){
            $(this).prop('checked', false);
            $('.registration-form').removeClass('agent-info')
        });
        $('.agent-information').slideUp();
    }
    countCheckedRoles();
});

function companyLogoUploader(file, target)
{
    previewFile(file, target);
    $(file).closest('.company-logo').find('.picture-holder, .image-loaded').css({
        'display':'block'
    });
    $(file).closest('.company-logo').addClass('hover');
}

$(document).on('click', '.company-logo-delete', function(){
    $(this).closest('.company-logo').find('.company-profileP').attr('src', '');
    $(this).closest('.company-logo').find('.company-profileP').attr('alt', '');
    $(this).closest('.company-logo').removeClass('hover');
    $(this).closest('.company-logo').find('.picture-holder, .image-loaded').css({
        'display':'none'
    });
});

$(document).on('change', '.selectSociety-checkbox', function(){
    var targetId = $(this).attr('id');
    if($(this).is(':checked')){
        if($('.packetData>a[data-target="'+targetId+'"]').length == 0){
            var targetSociety = $(this).closest('li').find('.fake-label').text();
            var selectedSocietyPacket = '<li><strong class="packetData">'+targetSociety+'<a class="delete" data-target="'+targetId+'"><span class="icon-cross"></span></a></strong></li>'
            $('.packetData-list').append(selectedSocietyPacket);
        }
    }
    else{
        $('.packetData>a[data-target="'+targetId+'"]').closest('li').remove();
    }
});
$(document).on('click', '.packetData>.delete', function(){
    var targetId = $(this).attr('data-target');
    $("#"+targetId).prop("checked", false);
    $(this).closest('li').remove();
});
$(document).on('click', '.sideBar-opener', function(){
    $('body').toggleClass('sideBar-active');
});
$(document).on('click', '.property-status-links-opener', function(){
    $(this).toggleClass('active');
    $('.property-status-links').slideToggle();
});
$(document).on('click', '.property-status-links>li>a', function(){
    if (screen.width < 1024){
        $('.property-status-links-opener>.text-container').text($(this).text());
        $('.property-status-links').slideUp();
        $('.property-status-links-opener').removeClass('active');
    }
});
$(document).on('click', '.sub-links>li>a', function(){
    $('.property-for').text($(this).text());
});
$(document).on('click', '.searchOpener-Mobile', function(){
    if (screen.width < 1024){
        $('.searchByID').slideToggle();
    }
});
$(document).on('change','#add-prop-wanted',function() {
    if ($(this).is(":checked")) {
        $('.hidden-for-wanted').addClass('hidden');
        $('.addProperty-form').find('h1').text('Wanted');
        $('.addProperty-form').find('h1').append(' <span>Property</span>');
    }
    else {
        $('.hidden-for-wanted').removeClass('hidden');
        $('.addProperty-form').find('h1').text('Add');
        $('.addProperty-form').find('h1').append(' <span>Property</span>');
    }
});