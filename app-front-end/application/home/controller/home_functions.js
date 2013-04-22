// JavaScript Document

$(document).ready(function() {
        
    $(function(){
        initMainApplication();
    });
    
    $(window).load(function () {
        $("#loading").animate({
            "opacity":"0"
        },1000,function(){
            $("#loading").css("display","none");
        });
    });
});


var classMainApplication = function(idUserProfile, idBuilding, idTypeUser){
    this.id_user = idUserProfile;
    this.id_building = idBuilding;
    this.id_type_user = idTypeUser;
}

classMainApplication.prototype = {
    
    init: function(){
        instanceMainApplication.initialEvents();
        instanceMainApplication.initLoadProfileAccount();
    },
    
    initialEvents: function(){
        $("#btn_login").colorbox({inline:true, width:"45%"});
    },
    
    initEventsServicesDialog: function(){
        $(".eachItemServiceIframe").colorbox({iframe:true, width:"80%", height:"90%"});
    },
    
    initLoadProfileAccount: function (){
        //load modules application
        instanceMainApplication.loadModules();
    },
    
    loadModules: function(){
        callService(false, _SERVER_MIDDLE_END_+'services/ServiceConfigProfile.php', 'getModules', '', 'post', 'instanceMainApplication.bs_getModules', 'instanceMainApplication.callbackGetModules', 'instanceMainApplication.errCallService');
    },
    
    bs_getModules: function (){ 
        //
    },
    
    callbackGetModules: function (data){
        var modulesStr = '';
        var navServiceStr = '';
        for(var i = 0; i < data.length; i++ ){
            modulesStr += '<section class="module" id="'+ data[i].module_link +'" id-module="'+ data[i].id_module +'"><p>M&oacute;dulo <br /> '+ data[i].module_name +'</p><img src="'+ data[i].module_image +'" /></section>';
            navServiceStr += '<ul id-nav-mod="'+ data[i].id_module +'" name="'+ data[i].module_link +'"  ></ul>';
        }
        $('#main-menu-modules').html(modulesStr);
        $('#services-modules').html(navServiceStr);
        instanceMainApplication.initEfectsModules();
        instanceMainApplication.getNavServices();
    },
    
    initEfectsModules: function (){
        /*$('#main-menu-modules section.module').hover(
        function() {
            $(this).effect('bounce', {
                times: 1, 
                distance:5
            }, 500);
        },
        function() {
            $(this).effect('none', { }, 500);
        });*/
    },
    
    getNavServices: function(){
        callService(false, _SERVER_MIDDLE_END_+'services/ServiceConfigProfile.php', 'getServices', 'idBuilding=' + instanceMainApplication.id_building + '&idUserType=' + instanceMainApplication.id_type_user , 'post', 'instanceMainApplication.bs_getNavServices', 'instanceMainApplication.callbackGetNavServices', 'instanceMainApplication.errCallService');
    },
    
    bs_getNavServices: function(){
        //
    },
    
    callbackGetNavServices: function (data){
        for(var i = 0; i < data.length ; i++){
            instanceMainApplication.addItemService(data[i]);
        }
        instanceMainApplication.initEventModules();
        instanceMainApplication.initEventServices();
    },
    
    addItemService: function (itemService){
        var x = $('#services-modules ul');
        x.each(function (){
            if($(this).attr('id-nav-mod') == itemService.id_module){
                var serviceStr = '';
                //
                if(itemService.isDialog == "1"){
                    serviceStr += '<li><a class="eachItemServiceIframe" href="'+ itemService.path_default +'" style="cursor:pointer;" isDialog="'+ itemService.isDialog +'" link="'+ itemService.path_default +'">'+ itemService.service_name +'</a>';
                }else{
                    serviceStr += '<li><a style="cursor:pointer;" isDialog="'+ itemService.isDialog +'" link="'+ itemService.path_default +'">'+ itemService.service_name +'</a>';
                }
                if(itemService.is_new == 1){serviceStr += '<img src="http://mioficina.co/app-front-end/resources/multimedia/images/new.png" /></li>';}else{serviceStr += '</li>';}
                $(this).append(serviceStr);
                $(this).hide();
                return;
            }
        });
        instanceMainApplication.initEventsServicesDialog();
    },
    
    initEventModules: function (){
        $('#main-menu-modules section.module').bind('click',function(){
            $('#services-modules').css({visibility:'visible'});
            instanceMainApplication.hideAllNavService();
            var idModule = $(this).attr('id-module');
            var nav = $('#services-modules ul[id-nav-mod='+ idModule +']');
            nav.show('slow');
        });
    },
    
    initEventServices: function (){
        $('#services-modules ul li a').bind('click', function(){
            var pathService = $(this).attr('link');
            var isDialog = $(this).attr('isDialog');
            if(isDialog != "1"){
                instanceMainApplication.loadPageService(pathService);
            }
        });
    },
    
    hideAllNavService: function(){
        var x = $('#services-modules ul');
        x.each(function (){
            $(this).hide();
        });
    },
    
    loadPageService: function (pathService){
        var page = loadPage( pathService, 'bs_loadingPage');
        $("#main-content").empty().html(page).show('slow');
    },
    
    errCallService: function (jqXHR, textStatus, errorThrown){
        console.log("Err " + textStatus);
    }
    
}

function bs_loadingPage(){
    $('#main-content').html('<div style="top:50px; position:relative; left:40%;"><img src="http://mioficina.co/app-front-end/resources/multimedia/gifs/ajax-loader-blue.gif" /></div>');
}
    
var instanceMainApplication = null;
    
function initMainApplication(){
    loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
    loadScript(_SERVER_FRONT_END_ + 'application/home/controller/session_start.js');
    
    var idUserProfile = 0;
    var idBuilding = 0;
    var idTypeUser = 0;
    
    if(objectClassSession.validateSession()){
        idUserProfile = objectClassSession.getSessionIDUser();
        idBuilding = objectClassSession.getSessionIDBulding();
        idTypeUser = objectClassSession.getSessionIDTypeUser();
    }
    
    instanceMainApplication = new classMainApplication(idUserProfile, idBuilding, idTypeUser);
    instanceMainApplication.init();
}
    