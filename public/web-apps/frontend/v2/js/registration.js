
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
		addValidationsOnAgentInfo();
		$('.agent-brokerCheckbox').each(function(){
			$(this).prop('checked', true);
		});
		$('.registration-form').addClass('agent-info')
		$('.agent-information').slideDown();
	}
	else {
		removeValidationsOnAgentInfo();
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
	$('.packetData-list').html('');
	$('.societiesBlock-listing input:checked').each(function () {
		var targetId = $(this).attr('id');
		var targetSociety = $(this).closest('li').find('.fake-label').text();
		var selectedSocietyPacket = '<li><strong class="packetData">'+targetSociety+'<a class="delete" data-target="'+targetId+'"><span class="icon-cross"></span></a></strong></li>'
		$('.packetData-list').append(selectedSocietyPacket);
	});
});

$(document).on('click', '.packetData>.delete', function(){
	var targetId = $(this).attr('data-target');
	$("#"+targetId).prop("checked", false);
	$(this).closest('li').remove();
});

function addValidationsOnAgentInfo()
{
	$('#agency-name').attr('required','required');
	$('#compny-mobile').attr('required','required');
	$('#compny-email').attr('required','required');
}
function removeValidationsOnAgentInfo()
{
	$('#agency-name').removeAttr('required');
	$('#compny-mobile').removeAttr('required');
	$('#compny-email').removeAttr('required');
}
