$(document).on('change keyup', 'input, textarea, select', function(){
	$(this).closest('.error').removeClass('error');
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
	} else {
		$('.registration-form').removeClass("agent-info");
		$('.company-logo').removeClass('hover');
		$('.picture-holder').css({
			'display':'none'
		});
	}
});
$(document).on('click', '.nav-opener', function(){
	$('body').toggleClass('nav-active');
});

$(document).on('tap, click', '#main', function(){
	$('body').removeClass('nav-active');
});
$(document).ready(function(){
	$('.registration-form').find('.role-listing').hide();
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

function countSelectedSocieties(){
	var totalSelectedSocieties = 0;
	$('.selectSociety-checkbox').each( function(){
		if($(this).is(':checked')){
			totalSelectedSocieties++;
		}
		if(totalSelectedSocieties > 1){
			$('.calculatedSocieties').text(totalSelectedSocieties+' Societies Selected');
		}
		else {
			if(totalSelectedSocieties == 1){
				$('.calculatedSocieties').text(totalSelectedSocieties+' Society Selected');
			}
			else{
				$('.calculatedSocieties').text('');
			}
		}
	})
}

$(document).on('change', '.selectSociety-checkbox', function(){
	countSelectedSocieties();
});

$(document).on('change', '.agent-brokerCheckbox', function(){
	if($(this).is(':checked')){
		addValidationsOnAgentInfo();
		$('.agent-brokerCheckbox').each(function(){
			$(this).prop('checked', true);
		});
		$('.registration-form').addClass('agent-info')
	}
	else {
		removeValidationsOnAgentInfo();
		$('.agent-brokerCheckbox').each(function(){
			$(this).prop('checked', false);
			$('.registration-form').removeClass('agent-info')
		});
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

$(document).on('click', '.delete', function(){
	$(this).closest('.company-logo').find('.company-profileP').attr('src', '');
	$(this).closest('.company-logo').find('.company-profileP').attr('alt', '');
	$(this).closest('.company-logo').removeClass('hover');
	$(this).closest('.company-logo').find('.picture-holder').css({
		'display':'none'
	});
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
