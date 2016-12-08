jQuery(window).load(function(){
	$('.page-loader').fadeOut();
	$('#wrapper').removeClass('hidden');
});

$(document).ready(function() {
	$(".js-example-basic-single").select2();
	if (screen.width < 768){
		$('.call-agent-btn').each(function(){
			var mobileNumber = $(this).attr('data-tel');
			$(this).attr('href', 'tel:'+mobileNumber)
		});
	}
	if($('.publicProperty-post, .publicAgent-post').length == 0){
		$('.propertyNotFound').removeClass('hidden');
		$('.pager').remove();
	}
	$('.addPro-type:first').trigger('change');
	$('.registration-form').find('.role-listing').hide();

	if($('.Ads li').length == 0){
		$('.page-holder').addClass('no-ads');
	}

	if($('.index-page').length){
		if (screen.width < 1024){ $('#wrapper').addClass('fancy-overlay'); }
	}
	$('.news-slideshow .slide').each(function(){
		if($(this).find('.news-slide').length == 1){
			$(this).find('.news-pagination').remove();
		}
	});
	$(window).trigger('scroll');
	imageAdjustment();
});
function imageAdjustment(){
	$('.propertyImage-slider .slide').find('img').each(function(){
		var imgWdht = $(this).width();
		var imghght = $(this).height();
		if (imgWdht > imghght){
			$(this).addClass('landscape');
		}
		else {
			$(this).addClass('portrait');
		}
	});
}
$( window ).resize(function() {
	if (screen.width > 1024){
		searchBtnFix();
	}
});
$(window).scroll(function() {
	activateBackToTop();
	if (screen.width > 1024){ handleSearchBtnPosition(); }
});
// page init
jQuery(function(){
	initLightbox();
	initCarousel();
	initAnchors();
	initSlideShow();
	if(screen.width >= 768){
		initFixedScrollBlock();
	}
});

// slideshow init
function initSlideShow() {

	jQuery('.news-slideshow').fadeGallery({
		useSwipe: true,
		slides: '.slide',
		currentNumber: 'span.cur-num',
		totalNumber: 'span.all-num',
		switchSimultaneously: true,
		disableWhileAnimating: false,
		generatePagination: '.pagination',
		autoRotation: true,
		autoHeight: true,
		pauseOnHover: true,
		circularRotation: false,
		switchTime: 5000,
		animSpeed: 600
	});
	jQuery('.projects-slideshow').fadeGallery({
		useSwipe: true,
		slides: '.slide',
		currentNumber: 'span.cur-num',
		totalNumber: 'span.all-num',
		switchSimultaneously: true,
		disableWhileAnimating: false,
		generatePagination: '.pagination',
		autoRotation: true,
		autoHeight: true,
		pauseOnHover: true,
		circularRotation: false,
		switchTime: 5000,
		animSpeed: 600
	});

	jQuery('.ads-slideshow').fadeGallery({
		useSwipe: true,
		slides: '.slide',
		currentNumber: 'span.cur-num',
		totalNumber: 'span.all-num',
		switchSimultaneously: true,
		disableWhileAnimating: false,
		generatePagination: '.pagination',
		autoRotation: true,
		autoHeight: true,
		pauseOnHover: true,
		switchTime: 5000,
		animSpeed: 600
	});
}
// scroll gallery init
function initCarousel() {
	jQuery('.news-carousel').scrollGallery({
		mask: '.news-mask',
		slider: '.news-slideset',
		slides: '.news-slide',
		currentNumber: 'span.cur-num',
		totalNumber: 'span.all-num',
		disableWhileAnimating: true,
		generatePagination: '.news-pagination',
		circularRotation: true,
		pauseOnHover: true,
		autoRotation: true,
		maskAutoSize: true,
		stretchSlideToMask: true,
		btnPrev: '.news-btn-prev',
		btnNext: '.news-btn-next',
		switchTime: 4000,
		animSpeed: 600
	});
	jQuery('.projects-carousel').scrollGallery({
		mask: '.projects-mask',
		slider: '.projects-slideset',
		slides: '.projects-slide',
		currentNumber: 'span.cur-num',
		totalNumber: 'span.all-num',
		disableWhileAnimating: true,
		generatePagination: '.projects-pagination',
		circularRotation: true,
		pauseOnHover: true,
		autoRotation: true,
		maskAutoSize: true,
		stretchSlideToMask: true,
		btnPrev: '.projects-btn-prev',
		btnNext: '.projects-btn-next',
		switchTime: 4000,
		animSpeed: 600
	});

	jQuery('.agent-slider').scrollGallery({
		mask: '.mask',
		slider: '.slideset',
		slides: '.slide',
		currentNumber: 'span.cur-num',
		totalNumber: 'span.all-num',
		disableWhileAnimating: true,
		circularRotation: true,
		pauseOnHover: true,
		autoRotation: false,
		maskAutoSize: false,
		stretchSlideToMask: true,
		generatePagination: '.pagination',
		switchTime: 2000,
		animSpeed: 600
	});

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

	jQuery('.agent-societies').scrollGallery({
		mask: '.agent-mask',
		slider: '.agent-slideset',
		slides: '.agent-slide',
		currentNumber: 'span.cur-num',
		totalNumber: 'span.all-num',
		disableWhileAnimating: true,
		circularRotation: true,
		pauseOnHover: true,
		autoRotation: false,
		maskAutoSize: false,
		stretchSlideToMask: true,
		switchTime: 2000,
		step:1,
		animSpeed: 600
	});

	jQuery('.agent-logos').scrollGallery({
		mask: '.mask',
		slider: '.slideset',
		slides: '.slide',
		currentNumber: 'span.cur-num',
		totalNumber: 'span.all-num',
		disableWhileAnimating: true,
		circularRotation: true,
		pauseOnHover: true,
		autoRotation: true,
		maskAutoSize: false,
		stretchSlideToMask: true,
		switchTime: 2000,
		step:1,
		animSpeed: 600
	});
}

// initialize fixed blocks on scroll
function initFixedScrollBlock() {
	jQuery('#wrapper').fixedScrollBlock({
		slideBlock: '#header'
	});
	jQuery('#main').fixedScrollBlock({
		slideBlock: '#fixed-block',
		extraTop: 100
	});
}

// accordion init
function initAccordion() {
	jQuery('.accordion').slideAccordion({
		opener:'>a.opener',
		slider:'>.slide',
		collapsible:false,
		animSpeed: 300
	});
}
// smooth anchor links
function initAnchors() {
	new SmoothScroll({
		anchorLinks: '.back-to-top'
	});
	// common case:
	new SmoothScroll({
		extraOffset: $('#header').height() || 20,
		anchorLinks: '.scroll',
		activeClasses: 'link',
		wheelBehavior: 'ignore',
		animDuration: 800
	});
}
function searchBtnFix()
{
	var asideFromLeft = $('#aside').position().left;
	$('.filter-btn').css({
		'left':asideFromLeft+15,
		'width':$('#aside').width()
	});
}
function searchBtnUnFix()
{
	var asideFromLeft = $('#aside').position().left;
	$('.filter-btn').css({
		'left':0,
		'width':'auto'
	});
}
function handleSearchBtnPosition(){
	if(!$('.listing-page').length){
		return;
	}

	if($(window).scrollTop()+$(window).height()-50 >= $('#aside').height()+$('#aside').offset().top){
		$('.filter-btn').removeClass('srchBtnFxd');
		searchBtnUnFix();
	}else{
		$('.filter-btn').addClass('srchBtnFxd');
		searchBtnFix();
	}
}
function activateBackToTop(){
	var scroll = $(window).scrollTop();

	if (scroll >= 200) {
		$('.back-to-top').addClass('active')
	}
	else {
		$('.back-to-top').removeClass('active')
	}
}


$(document).on('change keyup', 'input, textarea, select', function(){
	$(this).closest('.input-holder').removeClass('error');
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

$(document).on('click', '.generic-lightbox>.close, .fancybox-close, .got-it, .btn-close-working .close', function(){
	$('#wrapper').removeClass('fancy-overlay');
});

$(document).keyup(function(e) {
	if (e.keyCode === 27){
		$('.fancybox-overlay-fixed').hide();
		$('#wrapper').removeClass('fancy-overlay');
		$('html').removeClass('nav-active');
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

$(document).on('click', '.navigation-toggler', function(){
	$('html').toggleClass('nav-active');
});

$(document).on('click', '.togglerSearchButton', function(){
	$('html').toggleClass('filters-active');
});

$(document).on('click', '.filters-links-opener', function(){
	$(this).closest('li').toggleClass('active');

	if($(this).closest('li').hasClass('active')){
		$(this).closest('li').find('.slide').slideDown();
	}
	else {
		$(this).closest('li').find('.slide').slideUp();
	}
});

$(document).on('focusin', '.PriceField', function(){
	$('.calculatedPrice').removeClass('priceShow');
	$('.calculatedPrice').addClass('priceShow');
});
$(document).on('focusout', '.PriceField', function(){
	$('.calculatedPrice').removeClass('priceShow');
});

$(document).on('click', '.call-agent-btn', function(){
	var phoneNumber = $(this).attr('data-tel');
	var placeToGo = $('.call-agent').find('p').text(phoneNumber);

	if (screen.width < 768){
		$('#wrapper').removeClass('fancy-overlay');
	}
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
		$('.company-logo').removeClass('hover');
		$('.agent-information').slideUp();
		$('.picture-holder').css({
			'display':'none'
		});
	}
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
	$(file).closest('.company-logo').find('.picture-holder').css({
		'display':'block'
	});
	$(file).closest('.company-logo').addClass('hover');
}

$(document).on('click', '.company-logo-delete', function(){
	$(this).closest('.company-logo').find('.company-profileP').attr('src', '');
	$(this).closest('.company-logo').find('.company-profileP').attr('alt', '');
	$(this).closest('.company-logo').removeClass('hover');
	$(this).closest('.company-logo').find('.picture-holder').css({
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

$(document).on('click', '.btn-close-working', function(){
	$('.weAreWorking').addClass('hide');
});

$(document).on('click', '.main-navigation li a', function(){
	$('html').removeClass('nav-active');
});