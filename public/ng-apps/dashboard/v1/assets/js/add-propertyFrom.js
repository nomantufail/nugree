$(document).ready(function() {
	$('.feature-block').find('.holder').hide();
	$('.feature-block').find('.form-heading').hide();
});

$(document).on('click', '.feature-blockOpener', function(){
	$(this).toggleClass('active');
	$('.feature-block').find('.holder').slideToggle();
	$('.feature-block').find('.form-heading').slideToggle();
});

function previewAddPropertyImg(file, target)
{
	previewFile(file, target);
	$(file).closest('li').addClass('image-loaded');
	$(file).closest('li').find('.picture-name').focus();
}

$(document).on('click', '.propertyDocumentCloseBtn', function(){
	$(this).closest('li').find('.picture-name').val('');
	$(this).closest('li').find('img').attr('src', '#');
	$(this).closest('li').removeClass('image-loaded');
});

$(document).on('click', '.listing-opener', function(){
	$('.addPropertyFormContainer').toggleClass('sectionListingActive');
});

function onScroll(event){
	var scrollPos = $(document).scrollTop();
	$('.scrollAddPropertyNavLink').each(function () {
		var currLink = $(this);
		var refElement = $(currLink.attr("href"));
		if (refElement.position().top <= scrollPos+50 && refElement.position().top + refElement.height() > scrollPos) {
			$(currLink).closest('li').siblings().removeClass('activeAddPropertyNavLink');
			$(currLink).closest('li').addClass('activeAddPropertyNavLink');
		}
		else{
			currLink.closest('li').removeClass('activeAddPropertyNavLink');
		}
	});
}

function handleAddPropertyFormScrolling()
{
	$('.scrollAddPropertyNavLink').click(function() {
		$('.addPropertyFormContainer').removeClass('sectionListingActive');
		$(this).closest('li').siblings().removeClass('activeAddPropertyNavLink');
		$(this).closest('li').addClass('activeAddPropertyNavLink');
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			console.log(target.offset());
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top
				}, 500);
				return false;
			}
		}
	});
}



$(document).on('focusin', '.PriceField', function(){
	$('.calculatedPrice').removeClass('priceShow');
	$('.calculatedPrice').addClass('priceShow');
});
$(document).on('focusout', '.PriceField', function(){
	$('.calculatedPrice').removeClass('priceShow');
});

$(document).on('change keyup','.PriceField',function(){
	showDetailedPriceAt(digitsToWords($(this).val()), '.calculatedPrice');
});