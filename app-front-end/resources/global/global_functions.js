// JavaScript Document
    
    
//remote

var _SERVER_FRONT_END_ = 'http://mioficina.co/app-front-end/';
var _SERVER_MIDDLE_END_ = 'http://mioficina.co/app-middle-end/';


    //load scripts
    function loadScript( path ){
        var flagSuccess = false;
        jQuery.ajax({
            async: false,
            type: 'GET',
            cache: true,
            url: path,
            success: function(){
                flagSuccess = true;
            },
            dataType: 'script'
        });
        return (flagSuccess);
    }

    function loadPage( path, beforeSend_cb ){
        var page = '';
        jQuery.ajax({
            async: false,
            type: 'GET',
            cache: true,
            url: path,
            success: function(data){
                page = data;
            },
            timeout: 6000,
            error: function(){
                page = '404';
            },
            beforeSend: eval(beforeSend_cb),
            dataType: 'html'
        });
        return (page);
    }

    function redirect(url){
        $(location).attr('href',url);  
    }
