/* 
 * Class and methods of service manager-concepts
 */

var classManagerNotice = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile
    this.id_building = idBuilding;
    this.queue = 0;
}

classManagerNotice.prototype = {
    
    init: function(){
        instanceManagerNotice.getDataTypeCommuncation();
        instanceManagerNotice.getDataListUsers();
        instanceManagerNotice.initUploadFiles();
        instanceManagerNotice.initEvents();
    },
    
    initEvents: function(){
        $('#btn-closeDialogSelectUser').bind('click', function(){
            instanceManagerNotice.hideDialog('dlg-selectUser');
        });
        
        $('#btn-selectAddresses').bind('click', function(){
            instanceManagerNotice.showDialog('dlg-selectUser');
        });
        
        $('#btn-okSelectUsers').bind('click', function(){
            instanceManagerNotice.hideDialog('dlg-selectUser');
        });
        
        $('#btn-closeDialogConfirmSent').bind('click', function(){
            instanceManagerNotice.hideDialog('dlg-confirmSent');
            instanceManagerNotice.hidePage('pageSendNotification');
            instanceManagerNotice.showPage('pageSelectTypeNotification');
        });
        
        $('#buttonSendNotice').bind('click', function(){
            instanceManagerNotice.sendInfoNotice();
        });
    },
    
    initUploadFiles: function(){
        $('#file_upload').uploadify({
            'swf'      : _SERVER_FRONT_END_+ 'resources/pluggins/uploadify-v3.1/uploadify.swf',
            'uploader' : _SERVER_MIDDLE_END_+'services/ServiceUploadFiles.php',
            'fileTypeExts' : '*.gif; *.jpg; *.png; *.bmp; *.pdf; *.doc; *.docx; *.xls; *.xlsx; *.xlsm; *.pps; *.ppt; *.pptx; *.zip; *.rar',
            'fileSizeLimit' : '25MB',
            'auto'      : false,
            'formData'  : {
                'idBuilding' : instanceManagerNotice.id_building, 
                'idTypeCommunication' : 0,
                'idCommunication' : 0
            },
            'width'    : 250,
            'multi' : true,
            'onSelect' : function(file) {
                //alert('The file ' + file.name + ' was added to the queue.');
                instanceManagerNotice.queue ++;
            },
            'onSelectError' : function(file, errorCode, errorMsg) {
                alert('The file ' + file.name + ' returned an error and was not added to the queue. ' + errorCode + ' msg ' + errorMsg);
            },
            'onCancel' : function(file) {
                //alert('The file ' + file.name + ' was cancelled.');
                instanceManagerNotice.queue --;
            } ,
            'onUploadStart' : function(file) {
                //alert('Starting to upload ' + file.name);
                instanceManagerNotice.showDialog('processing');
            },
            'onUploadComplete' : function(file) {
                //alert('The file ' + file.name + ' finished processing.');
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                //alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
            },
            'onUploadSuccess' : function(file, data, response) {
                //alert('The file ' + file.name + ' was successfully uploaded response of ' + response + ':' + data);
            },
            'onQueueComplete' : function(queueData) {
                //alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
                instanceManagerNotice.queue = 0;
                instanceManagerNotice.showDialog('dlg-confirmSent');
                instanceManagerNotice.hideDialog('processing');
            }		
        });
    },
    
    initEventsTypeNotice: function(){
        $('.tagNotice').bind('click', function(){
            var idNoticeType = $(this).attr('id-type-notice');
            $('#buttonSendNotice').attr('id-notice-add', idNoticeType);
            instanceManagerNotice.hidePage('pageSelectTypeNotification');
            instanceManagerNotice.showPage('pageSendNotification');
        });
    },
    
    initEventsFindAdresses: function(){
        $('.titleTypeUser').bind('click', function(){
            if($(this).parent().attr('is-showed') == 'false'){
                //show
                $(this).parent().children('.contentListUsers').show();
                $(this).parent().attr('is-showed', 'true');
            }else{
                //hide
                $(this).parent().children('.contentListUsers').hide();
                $(this).parent().attr('is-showed', 'false');
            }
        });
        
        $('.chk-user-all').bind('click', function(){
            if($(this).is(':checked')){
                $(this).parents('.itemTypeUsers').children('.contentListUsers').find('input').each(function(){
                   $(this).attr('checked', 'checked');
                });
            }else{
                $(this).parents('.itemTypeUsers').children('.contentListUsers').find('input').each(function(){
                    $(this).removeAttr('checked');
                });
            }
        });
    },
    
    showDialog: function(dialog){
        $('div[id-dialog="'+dialog+'"]').show();
    },
    
    hideDialog: function(dialog){
        $('div[id-dialog="'+dialog+'"]').hide();
    },
    
    showPage:function(page){
        $('#'+page).show();
    },
    
    hidePage: function(page){
        $('#'+page).hide();
    },
    
    getDataTypeCommuncation: function(){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceCommunication.php', 'getCommunicationType', 'idBuilding=' + instanceManagerNotice.id_building, 'post', 'instanceManagerNotice.bs_getDataTypeCommuncation', 'instanceManagerNotice.cb_getDataTypeCommuncation', 'instanceManagerNotice.err_getDataTypeCommuncation');
    },
    
    bs_getDataTypeCommuncation: function(){  
        instanceManagerNotice.showDialog('processing');
    },
    
    cb_getDataTypeCommuncation: function(data){
        if(data.statusParam){
            var listTypes = data.result;
            var str = '';
            for(var i = 0; i < listTypes.length; i++){
                var item = listTypes[i];
                str += '<div id-type-notice="'+ item.id_type +'" class="tagNotice"><p>'+ item.name_type +'</p></div>';
            }
            $('#selectTypeNotification').html(str);
            instanceManagerNotice.initEventsTypeNotice();
            instanceManagerNotice.showPage('pageSelectTypeNotification');
        }else{
            console.log('Err with parameters');
        }
        instanceManagerNotice.hideDialog('processing');
    },
    
    err_getDataTypeCommuncation: function(){
        instanceManagerNotice.hideDialog('processing');
    },
    
    getDataListUsers: function(){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceUser.php', 'getAllUserByType', 'idBuilding=' + instanceManagerNotice.id_building + '&userType=', 'post', 'instanceManagerNotice.bs_getDataListUsers', 'instanceManagerNotice.cb_getDataListUsers', 'instanceManagerNotice.err_getDataListUsers');
    },
    
    bs_getDataListUsers: function(){
        instanceManagerNotice.showDialog('processing');
    },
    
    cb_getDataListUsers: function(data){
        var results = data.result;
        var str = '';
        for(var i = 0; i < results.length; i++){
            var itemUsersByType = results[i];
            str += '<div class="itemTypeUsers" is-showed="false">';
            str += '    <div class="titleTypeUser">';
            str += '        <img src="http://mioficina.co/app-front-end/resources/multimedia/iconos/white/user.png" />';
            str += '        <input class="chk-user-all" type="checkbox" />';
            str += '        <p>'+ itemUsersByType.typeUser.name +'</p>';
            str += '    </div>';
            str += '    <div class="contentListUsers">';
            if(itemUsersByType.listUsers.length > 0){
                for(var j = 0; j < itemUsersByType.listUsers.length; j++){
                    var itemUser = itemUsersByType.listUsers[j];
                    str += '<div class="eachUserList"><input class="chk-user" id-user-cbox="'+ itemUser.id_profile  +'" type="checkbox" /><p>'+ itemUser.name +'</p></div>';
                }
            }else{
                str += '<div class="noUserList"><p>No hay usuarios para mostrar</p></div>';
            }
            str += '    </div>';
            str += '</div>';
        }
        $('#contentFindUsers').html(str);
        instanceManagerNotice.initEventsFindAdresses();
        instanceManagerNotice.hideDialog('processing');
    },
    
    err_getDataListUsers: function(){
        instanceManagerNotice.hideDialog('processing');
    },
    
    sendInfoNotice: function(){
        var subject = $('#txtSubject').val();
        var idTypeNotice = $('#buttonSendNotice').attr('id-notice-add');
        var str = '';
        $('.chk-user').each(function(){
            if($(this).is(':checked')){
                str += ';' + $(this).attr('id-user-cbox');
            }
        });
        var listAddresses = str;
        var data = CKEDITOR.instances.editor1.getData();
        data = instanceManagerNotice.urlEncode(data);
        if(subject != "" && str != ""){
            callService(true, _SERVER_MIDDLE_END_+'services/ServiceCommunication.php', 'insertCommunication', 'idBuilding=' + instanceManagerNotice.id_building + '&idUser=' + instanceManagerNotice.id_user + '&idTypeCommunication=' + idTypeNotice + '&data='+ data + '&subject=' + subject + '&listAddresses=' + listAddresses, 'post', 'instanceManagerNotice.bs_sendInfoNotice', 'instanceManagerNotice.cb_sendInfoNotice', 'instanceManagerNotice.err_sendInfoNotice');
        }else{
            $('#info p').html('El asunto esta vacio o los destinatarios no se han seleccionado');
        }
    },
    
    urlEncode:function (str) {
        return escape(str).replace(/\+/g,'%2B').replace(/%20/g, '+').replace(/\*/g, '%2A').replace(/\//g, '%2F').replace(/@/g, '%40');
    },
    
    bs_sendInfoNotice: function(){
        instanceManagerNotice.showDialog('processing');
    },
    
    cb_sendInfoNotice: function(data){
        if(data.result != 'false'){
            var id_notice = data.result;
            var idTypeNotice = $('#buttonSendNotice').attr('id-notice-add');
            if(instanceManagerNotice.queue > 0){
                $("#file_upload").uploadify("settings", "formData", {'idBuilding' : instanceManagerNotice.id_building, 'idTypeCommunication' : idTypeNotice, 'idCommunication' : id_notice} );
                $('#file_upload').uploadify('upload','*');
            }else{
                instanceManagerNotice.showDialog('dlg-confirmSent');
                instanceManagerNotice.hideDialog('processing');
                instanceManagerNotice.queue = 0;
            }
            $('#txtSubject').val("");
            CKEDITOR.instances.editor1.setData("");
        }else{
            $('#info p').html('Error enviando el comunicado');
            instanceManagerNotice.hideDialog('processing');
        }
    },
    
    err_sendInfoNotice: function(){
        instanceManagerNotice.hideDialog('processing');
    }
    
};


//main!
$(function(){
    initManagerNotice();
});

var instanceManagerNotice = null;
    
function initManagerNotice(){
    //if(objectClassSession.validateSession()){
    //var id = objectClassSession.getSessionID();
    var idUserProfile = 1;
    var idBuilding = 1;
    loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
    instanceManagerNotice = new classManagerNotice(idUserProfile, idBuilding);
    instanceManagerNotice.init();
//}
}