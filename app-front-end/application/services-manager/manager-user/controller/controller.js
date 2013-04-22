/* 
 * Class and methods of service manager-properties!
 */

//var idOfficeLoadedActive = null;
//var flagOwnerActive = null;

var classManagerUser = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile
    this.id_building = idBuilding;
    this.sizePage = 10;
    this.numPage = 0;
}

classManagerUser.prototype = {
    
    init: function(){
        instanceManagerUser.initEvents();
        instanceManagerUser.getDataUser();
    },
    
    initEvents: function(){
        
        $('input[name=txtSearchEmail]').keyup(function(){
            $('#infoDlgAddUser p').html('');
            $('#tabFormAddUser').hide();
        });
        
        $('#buttonSearchEmail').bind('click', function(){
            var email = $('#txtSearchEmail').val();
            if(email != ""){
                instanceManagerUser.searchUserByEmail(email);
            }else{
                $('#infoDlgAddUser p').html('Ingrese un E-mail');
            }
        });
       
        $('#btn-closeDialogAddUser').bind('click', function(){
            instanceManagerUser.hideDialog('dlg-addUser');
        });
        
        $('#buttonAddUser').bind('click', function(){
            instanceManagerUser.showDialog('dlg-addUser');
        });
        
        $('#btn-saveAddUser').bind('click', function(){
            instanceManagerUser.saveAddUser();
        });
        
        $('#btn-closeDialogShowEditUser').bind('click', function(){
            instanceManagerUser.hideDialog('dlg-showEditUser');
        });
        
        $('#btn-saveChangesEditUser').bind('click', function(){
            var idUser = $(this).attr('id-user-button-edit');
            instanceManagerUser.saveEditUser(idUser);
        });
        
        $('#btn-closeDialogDeteleUser').bind('click',function(){
            instanceManagerUser.hideDialog('dlg-deleteUser');
        });

        $('#btn-deleteUser').bind('click', function(){
            var idUser = $(this).attr('id-button-user-delete');
            instanceManagerUser.deleteUser(idUser);
        });
        
    },
    
    showDialog: function(dialog){
        $('div[id-dialog="'+dialog+'"]').show();
    },
    
    hideDialog: function(dialog){
        $('div[id-dialog="'+dialog+'"]').hide();
    },
    
    eventsPagination: function(){
        $('#list-pagination div').bind('click', function(){
            var idPage = $(this).attr('id-pagination');
            if(instanceManagerUser.numPage != idPage){
                instanceManagerUser.numPage = idPage ;
                instanceManagerUser.getDataUser();
            }
        });
        
        $('.btn-deleteUser').bind('click', function(){
            var idUser = $(this).attr('button-id-user-delete');
            instanceManagerUser.sureDeleteUser(idUser);
        });
        
        $('.btn-editUser').bind('click', function(){
            var idUser = $(this).attr('button-id-user-edit');
            instanceManagerUser.createDialogEditUser(idUser);
        });
        
    },
    
    getDataUser: function(){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'getUsersByBuilding', 'idBuilding=' + instanceManagerUser.id_building + '&numPage=' + this.numPage + '&sizePage=' + this.sizePage , 'post', 'instanceManagerUser.bs_getAllUsers', 'instanceManagerUser.cb_getAllUsers', 'instanceManagerUser.err_getAllUsers');
    },
    
    bs_getAllUsers: function(){  
        instanceManagerUser.showDialog('processing');
    },
    
    cb_getAllUsers: function(data){
        if(data.statusParam){
            instanceManagerUser.drawGridUsers(data.result.listUsers, data.result.totalUsers);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerUser.hideDialog('processing');
    },
    
    err_getAllUsers: function(){
        instanceManagerUser.hideDialog('processing');
    },
    
    drawGridUsers: function(listUsers, totalQuery){
        if(listUsers.length != 0){
            var str = '';
            for(var i = 0; i < listUsers.length; i++ ){
                str += '<div class="eachUserGrid" id-user-grid="'+listUsers[i].id_user+'">';
                str += '<div style="width:80px;"><p>' + listUsers[i].identification + '</p></div>';
                str += '<div style="width:120px;"><p>' + listUsers[i].name + '</p></div>';
                str += '<div style="width:60px;"><p><img id-type-profile="'+listUsers[i].id_user+'" class="btn-viewTypesProfile" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/multi-agents-edit.png" /></p></div>';
                str += '<div style="width:150px;"><p>' + listUsers[i].email + '</p></div>';
                str += '<div style="width:70px;"><p>' + listUsers[i].home_phone + '</p></div>';
                str += '<div style="width:80px;"><p>' + listUsers[i].cel_phone + '</p></div>';
                str += '<div style="width:70px;"><p>' + listUsers[i].office_phone + '</p></div>';
                str += '<div style="width:50px;"><p><img button-id-user-delete="'+listUsers[i].id_user+'" class="btn-deleteUser" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/red/delete-item.png" /></p></div>';
                str += '<div style="width:50px;"><p><img button-id-user-edit="'+listUsers[i].id_user+'" class="btn-editUser" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/edit.png" /></p></div>';
                str += '</div>';
            }
            $('#listItemsGrid').html(str);
            $('#content-service #info p').html('Mostrando Resultado');
        }else{
            $('#listItemsGrid').html('');
            $('#content-service #info p').html('No Existen Usuarios Para Mostrar');
        }
        instanceManagerUser.drawPagination(totalQuery);
    },
    
    drawPagination: function(totalQuery){
        var str = "";
        var pages = Math.ceil(totalQuery / instanceManagerUser.sizePage);
        for(i = 0; i < pages; i++){
            if(instanceManagerUser.numPage == i){
                str += '<div class="class-pagination-on" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }else{
                str += '<div class="class-pagination-off" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }
        }
        $('#pagination #list-pagination').html(str);
        instanceManagerUser.eventsPagination();
    },
    
    /** search user by email **/
    
    searchUserByEmail: function(email){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'getInfoUserByEmail', 'email=' + email + '&idBuilding=' + instanceManagerUser.id_building, 'post', 'instanceManagerUser.bs_getDataUserByEmail', 'instanceManagerUser.cb_getDataUserByEmail', 'instanceManagerUser.err_getDataUserByEmail');
    },
    
    bs_getDataUserByEmail:function(){
        instanceManagerUser.showDialog('processing');
    },
    
    cb_getDataUserByEmail:function(data){
        
        var dataProfileUser = instanceManagerUser.getTypeProfileUser();
        var str = '';
        for(i = 0; i < dataProfileUser.result.length; i++){
            var itemTypeUser = dataProfileUser.result[i];
            str += '<option value="'+itemTypeUser.id_usertype+'">'+itemTypeUser.name+'</option>';
        }
        $('#sltAddTypeUser').html(str);
        
        //erase the fields
        var email = $('#txtSearchEmail').val();
        $('#txtAddEmail').val(email);
        $('#txtAddName').val("");
        $('#txtAddID').val("");
        $('#txtAddPhoneHome').val("");
        $('#txtAddCelPhone').val("");
        $('#txtAddPhoneOffice').val("");
        $('#infoDlgAddUser p').html('');
        
        if(data.result != "false"){
            if(data.result.userInBuilding == true){
                $('#infoDlgAddUser p').html('El usuario ya esta agregado en la lista');
                $('#tabFormAddUser').hide();
            }else{
                var infoUser = data.result.userData;
                $('#txtAddName').val(infoUser.name);
                $('#txtAddID').val(infoUser.identification);
                $('#txtAddEmail').val(infoUser.email);
                $('#txtAddPhoneHome').val(infoUser.home_phone);
                $('#txtAddCelPhone').val(infoUser.cel_phone);
                $('#txtAddPhoneOffice').val(infoUser.office_phone);
                $('#tabFormAddUser').show();
            }
        }else{
            //new user
            $('#tabFormAddUser').show();
        }
        instanceManagerUser.hideDialog('processing');
    },
    
    err_getDataUserByEmail:function(){
        instanceManagerUser.hideDialog('processing');
    },
    
    getTypeProfileUser:function(){
        var response = r_callService(false, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'getAllUserType', 'idBuilding=' + instanceManagerUser.id_building, 'post', 'instanceManagerUser.bs_typeUsers');
        return response;
    },
    
    bs_typeUsers: function(){
        
    },
    
    //save user 
    saveAddUser: function(){
        var typeUser = $('#sltAddTypeUser').val();
        var name = $('#txtAddName').val();
        var identification = $('#txtAddID').val();
        var email = $('#txtAddEmail').val();
        var phoneHome = $('#txtAddPhoneHome').val();
        var celPhone = $('#txtAddCelPhone').val();
        var phoneOffice = $('#txtAddPhoneOffice').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'insertUser', 
            'idBuilding=' + instanceManagerUser.id_building + '&idTypeUser=' + typeUser + 
                '&identification=' + identification + '&name=' + name + 
                    '&email=' + email + '&homePhone=' + phoneHome + '&celPhone=' + celPhone + '&officePhone=' + phoneOffice, 
                        'post', 'instanceManagerUser.bs_insertUser', 'instanceManagerUser.cb_insertUser', 'instanceManagerUser.err_insertUser');
    },
    
    bs_insertUser: function(){
        instanceManagerUser.showDialog('processing');
    },
    
    cb_insertUser: function(data){
        $('#txtSearchEmail').val("");
        $('#infoDlgAddUser p').html('Usuario Ingresado Correctamente');
        $('#tabFormAddUser').hide();
        instanceManagerUser.getDataUser();
        instanceManagerUser.hideDialog('processing');
    },
    
    err_insertUser: function(){
        instanceManagerUser.hideDialog('processing');
    },
    
    sureDeleteUser: function(idUser){
        $('#btn-deleteUser').attr('id-button-user-delete', idUser);
        instanceManagerUser.showDialog('dlg-deleteUser');
    },
    
    deleteUser: function(idUser){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'deleteUserByBulding', 'idBuilding=' + instanceManagerUser.id_building + '&idUser=' + idUser, 'post', 'instanceManagerUser.bs_deleteUser', 'instanceManagerUser.cb_deleteUser', 'instanceManagerUser.err_deleteUser');
    },
    
    bs_deleteUser: function(){
        instanceManagerUser.showDialog('processing');
    },
    
    cb_deleteUser: function(data){
        instanceManagerUser.getDataUser();
        instanceManagerUser.hideDialog('dlg-deleteUser');
        instanceManagerUser.hideDialog('processing');
    },
    
    err_deleteUser:function(){
        instanceManagerUser.hideDialog('processing');
    },
    
    createDialogEditUser: function(idUser){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'getInfoUserById', 'idUser=' + idUser, 'post', 'instanceManagerUser.bs_createEditUser', 'instanceManagerUser.cb_createEditUser', 'instanceManagerUser.err_createEditUser');
    },
    
    bs_createEditUser: function(){
        instanceManagerUser.showDialog('processing');
    },
    
    cb_createEditUser: function(data){
        var info = data.result;
        $('#btn-saveChangesEditUser').attr('id-user-button-edit', info.id_user);
        $('#txtEditName').val(info.name);
        $('#txtEditID').val(info.identification);
        $('#txtEditEmail').val(info.email);
        $('#txtEditPhoneHome').val(info.home_phone);
        $('#txtEditCelPhone').val(info.cel_phone);
        $('#txtEditPhoneOffice').val(info.office_phone);
        instanceManagerUser.showDialog('dlg-showEditUser');
        instanceManagerUser.hideDialog('processing');
    },
    err_createEditUser: function(){
        instanceManagerUser.hideDialog('processing');
    },
    
    saveEditUser: function(idUser){
        var name = $('#txtEditName').val();
        var identification = $('#txtEditID').val();
        var email = $('#txtEditEmail').val();
        var home_phone = $('#txtEditPhoneHome').val();
        var cel_phone = $('#txtEditCelPhone').val();
        var office_phone = $('#txtEditPhoneOffice').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'updateUser', 'idUser=' + idUser + '&identification='+ identification + '&name=' + name + '&email=' + email + '&homePhone='+ home_phone + '&celPhone=' + cel_phone + '&officePhone='+ office_phone, 'post', 'instanceManagerUser.bs_saveEditUser', 'instanceManagerUser.cb_saveEditUser', 'instanceManagerUser.err_saveEditUser');
    },
    
    
    bs_saveEditUser: function(){
        instanceManagerUser.showDialog('processing');
    },
    
    cb_saveEditUser: function(data){
        instanceManagerUser.getDataUser();
        instanceManagerUser.hideDialog('dlg-showEditUser');
        instanceManagerUser.hideDialog('processing');
    },
    
    err_saveEditUser: function(){
        instanceManagerUser.hideDialog('processing');
    }
    
};


//main!
$(function(){
   initManagerUser();
});

    var instanceManagerUser = null;
    
    function initManagerUser(){
        //if(objectClassSession.validateSession()){
            //var id = objectClassSession.getSessionID();
            var idUserProfile = 1;
            var idBuilding = 1;
            loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
            instanceManagerUser = new classManagerUser(idUserProfile, idBuilding);
            instanceManagerUser.init();
        //}
    }