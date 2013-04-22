
//vars
var arrayData = null;
var nickBuilding = null;
var idBuilding = null;
var idProfile = null;
var type_user = null;

var classManagerLogin = function(){     }

classManagerLogin.prototype = {
    
    init: function(){
        instanceManagerLogin.LoadResources();
        instanceManagerLogin.initEventsForm();
        instanceManagerLogin.initEvents();
    },
    
    LoadResources: function (){
        loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
    },
    
    initEvents: function (){
        $('#btn-closeDialogBulding').bind('click', function(){
            instanceManagerLogin.hideDialog('dlg-chooseBuilding');
        });
        
        $('#btn-closeDialogProfile').bind('click', function(){
            instanceManagerLogin.hideDialog('dlg-chooseProfile');
        });
        
        $("#userUserLogin").keypress(function(event) {
            if (event.which == 13) {
                $('#frm_login').submit();
            }
        });

        $("#passwordUserLogin").keypress(function(event) {
            if (event.which == 13) {
                $('#frm_login').submit();
            }
        });
        
        $('#userUserLogin').alphanumeric({
            allow:".-_#@"
        });
        
        $('#link-login').bind('click', function(){
            $('#frm_login').submit();
        });
    },
    
    initEventsForm: function (){
        $("#frm_login").validate({
            event: 'blur',
            rules: {
                'userUserLogin': 'required',
                'passwordUserLogin': 'required'
            },
            messages: {
                'userUserLogin': "Por favor ingrese su nombre de usuario",
                'passwordUserLogin': "Por favor ingrese su contrase&ntilde;a"
            },
            debug: true,
            errorElement: 'label', //error
            submitHandler: function(form){
                $('#msgForm').html('');
                var emailUser = $('#userUserLogin').val();
                var passwordUser = $('#passwordUserLogin').val();                
                callService(true, _SERVER_MIDDLE_END_+'services/ServiceLogin.php', 'loginIn', 'userEmail='+ emailUser +'&userPassword='+passwordUser, 'post', 'instanceManagerLogin.bs_login', 'instanceManagerLogin.cb_login', 'instanceManagerLogin.err_login');
            }			
        });
    },
	        
    bs_login: function (){
        instanceManagerLogin.showDialog('processing');
    },

    cb_login: function (data){
        if(data.statusParam == true){
            var infoUser = data.result;
            if(infoUser == "null"){
                $('#msgForm').html('El Usuario y/o Contrase&ntilde;a  Incorrectas');
            }else{
                arrayData = data.result;
                instanceManagerLogin.validateInitBuilding();
            }
        }else{
            $('#msgForm').html('Error! Contacte con soporte@mioficina.com ');
        }
        instanceManagerLogin.hideDialog('processing');
    },

    err_login: function (){ 
        instanceManagerLogin.hideDialog('processing');
    },
    
    
    validateInitBuilding: function (){
        if(arrayData.length == 1){
            var index = 0;
            nickBuilding = arrayData[index].infoBuilding.nick;
            idBuilding = arrayData[index].infoBuilding.id_building;
            instanceManagerLogin.validateUserProfile(index);
        }else if(arrayData.length > 1){
            instanceManagerLogin.showDialog('dlg-chooseBuilding');
            var str = '';
            for(i = 0; i < arrayData.length; i++){
                var itemBuilding = arrayData[i].infoBuilding;
                str += '<section id-index-array="'+i+'" id-building="'+itemBuilding.id_building+'" nick-building="'+itemBuilding.nick+'" class="eachBuldingChoose"><p>'+ itemBuilding.name +'</p></section>';
            }
            $('#listBuildings').html(str);
            instanceManagerLogin.initEventsChooseBuilding();
        }else{
            alert('error building');
        }
    },

    initEventsChooseBuilding: function (){
        $('.eachBuldingChoose').bind('click', function(){
            nickBuilding = $(this).attr('nick-building');
            idBuilding = $(this).attr('id-building');
            var index  = $(this).attr('id-index-array');
            instanceManagerLogin.validateUserProfile(index);
        });
    },

    initEventsChooseProfile: function (){
        $('.eachProfileChoose').bind('click', function(){
            idProfile = $(this).attr('id-profile');
            type_user = $(this).attr('id-type-user');
            instanceManagerLogin.createSession();
        });
    },

    validateUserProfile: function (index){
        instanceManagerLogin.hideDialog('dlg-chooseBuilding');
        if(arrayData[index].dataUser.is_validated == "1"){
            //is validated
            var dataProfile = arrayData[index].profiles;
            if(dataProfile.length == 1){
                var itemUserUnique = dataProfile[0];
                idProfile = itemUserUnique.profile.id_profile;
                type_user = itemUserUnique.userType.id_usertype;
                instanceManagerLogin.createSession();
            }else if(dataProfile.length >= 1){
                instanceManagerLogin.showDialog('dlg-chooseProfile');
                var str = '';
                for(i = 0; i < dataProfile.length; i++){
                    var itemUser = dataProfile[i];
                    str += '<section id-profile="'+itemUser.profile.id_profile+'" id-type-user="'+itemUser.userType.id_usertype+'" class="eachProfileChoose"><p>'+ itemUser.userType.name +'</p></section>';
                }
                $('#listProfiles').html(str);
                instanceManagerLogin.initEventsChooseProfile();
            }else{
                alert('no tienes un perfil, comunicate con el administrador!');
            }
        }else{
            //isn't validated
            alert('debes validar tu cuenta');
        }
    },

    createSession: function (){
        var data = r_callService(false,_SERVER_MIDDLE_END_+'services/ServiceSession.php', 'createSession','idUserProfile=' + idProfile + '&idBuilding=' + idBuilding + '&idTypeUser=' + type_user, 'post', 'instanceManagerLogin.bs_createSession');
        if(data.session == true){
            redirect('http://mioficina.co/@'+ nickBuilding + '/home/');
        }else{
            alert('Error Creando Su Perfil');
        }
        instanceManagerLogin.hideDialog('processing');
    },

    bs_createSession: function (){
        instanceManagerLogin.showDialog('processing');
    },

    /** hide and shows dialogs **/
    showDialog: function (dialog){
        $('div[id-dialog="'+dialog+'"]').show();
    },

    hideDialog: function (dialog){
        $('div[id-dialog="'+dialog+'"]').hide();
    }
    
}

//__Main__
$(function(){
    initMainLogin(); 
});

var instanceManagerLogin  = null;

function initMainLogin(){
    instanceManagerLogin = new classManagerLogin();
    instanceManagerLogin.init();
}