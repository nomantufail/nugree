$(document).ready(function() {

});

$(document).on('change', '.filter-form-input', function () {
	//$("#properties-filter-form").submit();
});


$(document).on('change keyup','.priceInputFrom',function(){
	showDetailedPriceAt(digitsToWords($(this).val()), '.calculatedPrice');
})
;
$(document).on('change keyup','.priceInputTo',function(){
	showDetailedPriceAt(digitsToWords($(this).val()), '.calculatedPrice');
});

