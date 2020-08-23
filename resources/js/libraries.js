window.ajaxRequest = function(requestType, requestUrl, requestData, toastrMessage, navigationAktiv) {
    $.ajax({
        type: requestType,
        url: requestUrl,
        data: requestData,
        success: function(response) {
            $('div#root').hide(1000, function() {
                $('div#root').html(response).show(1000);
            });
            if(toastrMessage) {
                toastr.success(toastrMessage);
            }
            if(navigationAktiv) {
                window.navigationAktiv(navigationAktiv);
            }
        },
        error: function(response) {
            for(const key in response.responseJSON.errors) {
                toastr.error(response.responseJSON.errors[key][0]);
            }
        }        
    });
} 

window.navigationAktiv = function(aktivItem) {
    let navigationHome = $('button.button-home');   
    let navigationCreate = $('button.button-create');
    if(aktivItem === 'home') {
        navigationHome.attr('disabled', true);
        navigationCreate.attr('disabled', false);
    }else if(aktivItem === 'create') {
        navigationHome.attr('disabled', false);
        navigationCreate.attr('disabled', true);
    }else if(aktivItem === 'noAktiv'){
        navigationHome.attr('disabled', false);
        navigationCreate.attr('disabled', false);
    }
}

window.prepareUrl = function(url) {
    let firstIndex = url.indexOf('contacts') + 8;
    let endIndex = url.indexOf('?page'); 
    url = url.substr(0, firstIndex) + url.substr(endIndex);
    return url;      
}
