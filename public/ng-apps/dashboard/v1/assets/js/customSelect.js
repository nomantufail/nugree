$(window).click(function() {
	$('.searchAbleCustom-select').removeClass('active');
});

$(document).on('change', '.custom_select_radio', function(){
	$(this).closest('.searchAbleCustom-select').removeClass('active');
 });
 $(document).on('click', '.searchValue', function(event){
	event.stopPropagation();
    
	$('.searchAbleCustom-select').removeClass('active');
	$(this).closest('.searchAbleCustom-select').toggleClass('active');
 });
  $(document).on('click', '.searchAbleCustom-select', function(event){
	event.stopPropagation();
 });