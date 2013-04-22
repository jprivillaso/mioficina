    // JavaScript Document


    function callService(isAsync, urlService, nameService, params, method, beforeSend_cb, callback, error_cb){
        $.ajax({
            async: isAsync ,
            url: urlService,
            type: method,
            contentType: 'application/x-www-form-urlencoded',
            data: 'nameservice='+nameService+'&'+params, //id del de arriba
            beforeSend: eval(beforeSend_cb),
            dataType: 'json',
            success: eval(callback),
            timeout: 6000,
            error: eval(error_cb)
        });
        return false;	
    }
    
    function r_callService(isAsync, urlService, nameService, params, method, beforeSend_cb){
        var response = '';
        $.ajax({
            async: isAsync ,
            url: urlService,
            type: method,
            contentType: 'application/x-www-form-urlencoded',
            data: 'nameservice='+nameService+'&'+params,
            beforeSend: eval(beforeSend_cb),
            dataType: 'json',
            success: function(data){
                response = data;
            },
            timeout: 6000,
            error: function(){
                response = 'error';
            }
        });
        return response;
    }
