/**
 * Created by jrpro_000 on 8/1/2016.
 */

$(document).on('click','.got-it',function(cname, cvalue){
    localStorage.setItem("gotIt", "true");
});

$(document).ready(function(){
   if((localStorage.getItem("gotIt")) =="true"){
       $('.weAreWorking').addClass('hide');
   }

});

$(document).on('click','.add-to-favorite',function(){
    var addedClass = $(this).hasClass( "added" );
    if(addedClass == true)
    {
        var property_id = $(this).attr('property_id');
        var user_id = $(this).attr('user_id');
        var favId= $(this).attr('id');
        var key = $(this).attr('key');
        $.ajax({
            type: "POST",
            url: apiPath.concat("favourite/property/delete"),
            data:{
                propertyId:property_id,userId:user_id
            },
            headers: {
                Authorization: key
            },
            success: function(response) {
         $('#'+favId).closest('a').removeClass('added');
      },
            error: function () {
         $('.popup-opener').closest('li').addClass('popup-holder');
      }

        });
    }
    else {
        var property_id = $(this).attr('property_id');
        var key = $(this).attr('key');
        var favId= $(this).attr('id');
        $.ajax({
            type: "POST",
            url: apiPath.concat("favourite/property"),
            data: {
                propertyId: property_id
            },
            headers: {
                Authorization: key
            },
            success: function(response) {
                $('#'+favId).closest('a').addClass('added');
            }
        })

    }
});


$(document).on('change', '#society', function(){
    var society_id = $(this).val();
    if(society_id !="")
    {
        $('#blocks').closest('li').addClass('loading');
        $.ajax({
            url: apiPath.concat("society/blocks"),
            data:
            {
                society_id: society_id
            },
            success: function (response)
            {
                $('#blocks').empty();
                $('#blocks').append($('<option>').text('select a block').attr('value', ''));
                $.each(response.data.blocks, function (i, block)
                {
                    $('#blocks').append($('<option>').text(block.name).attr('value', block.id));
                });
                $('#blocks').closest('li').removeClass('loading');
                $('#blocks').trigger('loaded');
            }
        })
    }
    else
    {
        $('#blocks').empty();
        $('#blocks').append($('<option>').text('All block').attr('value',''));
        $('#blocks').closest('li').removeClass('loading');
    }
});
$(document).on('change, keyup','#convertFrom',function(){
    var priceFrom = $(this).val();
    showDetailedPriceAt(digitsToWords(priceFrom),'.calculatedPrice')
});
$(document).on('change, keyup','#convertTo',function(){
    var priceFrom = $(this).val();
    showDetailedPriceAt(digitsToWords(priceFrom),'.calculatedPrice')
});
$(document).on('change', '#cityId', function(){
    var city_id = $(this).val();
    if(city_id !="")
    {
        $('#societies').closest('span').addClass('loading');
        $.ajax({
           url: apiPath.concat("city/location"),
            data:{
                city_id: city_id
            },
            success: function (response)
            {
                $('#societies').empty();
                $('#societies').append($('<option>').text('select a location').attr('value', ''));
                $.each(response.data.location, function (i, location) {
                    $('#societies').append($('<option>').text(location.location).attr('value', location.id));
                });
                $('#societies').closest('span').removeClass('loading');
            }

        })
    }
    else
    {
        $('#societies').empty();
        $('#societies').append($('<option>').text('All Societies').attr('value',''));

    }
});

$(document).on('change', '#sort', function(){
    var sort_by = $(this).val();
    url = window.location.href;
    var items = sort_by.split('_');
    var tech = getUrlParameter('order');
    if(tech == 'order')
    {
        var newUrl = removeURLParameter(url ,'order');
        var latestUrl = removeURLParameter(newUrl ,'sort_by');
        window.location.replace(latestUrl+'?sort_by='+items[0]+"&order="+items[1]);
    }
    else{
        var params = replaceUrlParam(url,'sort_by',items[0]);
        window.location.replace(params+"&order="+items[1]);
    }
});

function replaceUrlParam(url, paramName, paramValue){
    if(paramValue == null)
        paramValue = '';
    var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)')
    if(url.search(pattern)>=0){
        return url.replace(pattern,'$1' + paramValue + '$2');
    }
    return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[0];
        }
    }
};

function removeURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts= url.split('?');
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }

        url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
        return url;
    } else {
        return url;
    }
}

