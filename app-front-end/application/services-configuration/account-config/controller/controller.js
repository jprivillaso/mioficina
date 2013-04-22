/* 
 * Class and methods of service manager-concepts
 */

var classAccountConfig = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile
    this.id_building = idBuilding;
    this.sizePage = 10;
    this.numPage = 0;
}

classAccountConfig.prototype = {
    
    init: function(){
        instanceAccountConfig.getDataInfoUser();
        instanceAccountConfig.initEvents();
    },
    
    initEvents: function(){
        $('#btn-closeDialogEditDataUser').bind('click', function(){
            instanceAccountConfig.hideDialog('dlg-editDataUser');
        });
        
        $('#btn-editInfoUser').bind('click', function(){
            instanceAccountConfig.showDialog('dlg-editDataUser');
        });
        
        $('#btn-saveEditDataUser').bind('click', function(){
            var idUser = $(this).attr('id-user-edit');
            instanceAccountConfig.saveEditInfoUser(idUser);
        });
        
        $('#btn-saveEditPasswordUser').bind('click', function(){
            var idUser = $(this).attr('id-user-edit-password');
            var keyUser = $(this).attr('key-user-edit-password');
            instanceAccountConfig.saveChangePassword(idUser, keyUser);
        });
    },
    
    showDialog: function(dialog){
        $('div[id-dialog="'+dialog+'"]').show();
    },
    
    hideDialog: function(dialog){
        $('div[id-dialog="'+dialog+'"]').hide();
    },
    
    getDataInfoUser: function(){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'getInfoUserByIdProfile', 'idUserProfile=' + instanceAccountConfig.id_user, 'post', 'instanceAccountConfig.bs_getDataInfoUser', 'instanceAccountConfig.cb_getDataInfoUser', 'instanceAccountConfig.err_getDataInfoUser');
    },
    
    bs_getDataInfoUser: function(){  
        instanceAccountConfig.showDialog('processing');
    },
    
    cb_getDataInfoUser: function(data){
        if(data.statusParam){
            var info = data.result;
            $('#infoValues').html('Nombre <strong>'+info.name + '</strong> <br /> Cedula <strong>' + info.identification + '</strong> <br /> Nombre de Usuario <strong>' + info.nick + '</strong> <br /> Email <strong>' + info.email + '</strong> <br /> Telefono de la Casa <strong>' + info.home_phone + '</strong> <br /> Telefono de la Oficina <strong>' + info.office_phone + '</strong> <br /> Celular <strong>' + info.cel_phone + '</strong> ');
            $('#txtEditNameUser').val(info.name);
            $('#txtEditIDUser').val(info.identification);
            $('#txtEditNickUser').val(info.nick);
            $('#txtEditEmailUser').val(info.email);
            $('#txtEditHomePhoneUser').val(info.home_phone);
            $('#txtEditOfficePhoneUser').val(info.office_phone);
            $('#txtEditCelPhoneUser').val(info.cel_phone);
            $('#btn-saveEditDataUser').attr('id-user-edit', info.id_user);
            $('#btn-saveEditPasswordUser').attr('id-user-edit-password', info.id_user);
            $('#btn-saveEditPasswordUser').attr('key-user-edit-password', info.key);
        }else{
            console.log('Err with parameters');
        }
        instanceAccountConfig.hideDialog('processing');
    },
    
    err_getDataInfoUser: function(){
        instanceAccountConfig.hideDialog('processing');
    },
    
    //save user 
    saveEditInfoUser: function(idUser){
        var name = $('#txtEditNameUser').val();
        var nick = $('#txtEditNickUser').val();
        var identification = $('#txtEditIDUser').val();
        var email = $('#txtEditEmailUser').val();
        var home_phone = $('#txtEditHomePhoneUser').val();
        var cel_phone = $('#txtEditCelPhoneUser').val();
        var office_phone = $('#txtEditOfficePhoneUser').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'updateUserMe', 'idUser=' + idUser + '&identification='+ identification + '&name=' + name + '&nick=' + nick + '&email=' + email + '&homePhone='+ home_phone + '&celPhone=' + cel_phone + '&officePhone='+ office_phone, 'post', 'instanceAccountConfig.bs_saveEditInfoUser', 'instanceAccountConfig.cb_saveEditInfoUser', 'instanceAccountConfig.err_saveEditInfoUser');
    },
    
    bs_saveEditInfoUser: function(){
        instanceAccountConfig.showDialog('processing');
    },
    
    cb_saveEditInfoUser: function(data){
        instanceAccountConfig.getDataInfoUser();
        instanceAccountConfig.hideDialog('dlg-editDataUser');
        instanceAccountConfig.hideDialog('processing');
    },
    
    err_saveEditInfoUser: function(){
        instanceAccountConfig.hideDialog('processing');
    },
    
    //save edit Admon Value
    
    saveChangePassword: function(idUser, key){
        var previewPAssword = $('#txtPreviewPassword').val();
        var currentPassword = $('#txtCurrentPassword').val();
        var confirmCurrentPassword = $('#txtConfirmCurrentPassword').val();
        if(currentPassword == confirmCurrentPassword && currentPassword != '' ){
            callService(true, _SERVER_MIDDLE_END_+'services/ServiceLogin.php', 'changePassword', 'idUser=' + idUser + '&key='+ key + '&previewPassword=' + previewPAssword + '&currentPassword=' + currentPassword, 'post', 'instanceAccountConfig.bs_saveChangePassword', 'instanceAccountConfig.cb_saveChangePassword', 'instanceAccountConfig.err_saveChangePassword');
        }else{
            $('#content-service #info p').html('Las contrase&ntilde;as no coindicen');
        }
    },
    
    bs_saveChangePassword: function(){
        instanceAccountConfig.showDialog('processing');
    },
    
    cb_saveChangePassword: function(data){
        if(data.result == "notMatch"){
            $('#txtPreviewPassword').val("");
            $('#content-service #info p').html('Las contrase&ntilde;a es invalida');
        }else{
            $('#txtPreviewPassword').val("");
            $('#txtCurrentPassword').val("");
            $('#txtConfirmCurrentPassword').val("");
            $('#content-service #info p').html('Las contrase&ntilde;a se ha cambiado');
        }
        instanceAccountConfig.hideDialog('processing');
    },
    
    err_saveChangePassword: function(){
        instanceAccountConfig.hideDialog('processing');
    }
    
};


//main!
$(function(){
   initAccountConfig();
});

    var instanceAccountConfig = null;
    
    function initAccountConfig(){
        //if(objectClassSession.validateSession()){
            //var id = objectClassSession.getSessionID();
            var idUserProfile = 1;
            var idBuilding = 1;
            loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
            instanceAccountConfig = new classAccountConfig(idUserProfile, idBuilding);
            instanceAccountConfig.init();
        //}
    }