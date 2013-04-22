/* 
 * Class and methods of service manager-properties!
 */

var idOfficeLoadedActive = null;
var flagOwnerActive = null;

var classManagerOffice = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile
    this.id_building = idBuilding;
    this.sizePage = 10;
    this.numPage = 0;
}

classManagerOffice.prototype = {
    
    init: function(){
        instanceManagerOffice.initEvents();
        instanceManagerOffice.getDataOffice();
    },
    
    initEvents: function(){
        $('#btn-closeDialogShowOwner').bind('click', function(){
            instanceManagerOffice.hideDialog('dlg-showOwnerByProperty');
        });
        
        $('#btn-closeDialogShowEditProperty').bind('click', function(){
            instanceManagerOffice.hideDialog('dlg-showEditProperty');
        });
        
        $('#btn-closeDialogShowAddOffice').bind('click', function(){
            instanceManagerOffice.hideDialog('dlg-showAddOffice');
        });
        
        $('#btn-closeDialogDeteleOffice').bind('click',function(){
            instanceManagerOffice.hideDialog('dlg-deleteOffice');
        });
        
        $('#sel_typePropertySearch').change(function(){
           instanceManagerOffice.numPage = 0;
           instanceManagerOffice.getDataOffice();
        });
        
        $('#buttonAddOffice').bind('click', function(){
            instanceManagerOffice.showDialog('dlg-showAddOffice');
        });
        
        $('#btn-saveAddOffice').bind('click', function(){
            instanceManagerOffice.saveAddOffice();
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
            if(instanceManagerOffice.numPage != idPage){
                instanceManagerOffice.numPage = idPage ;
                instanceManagerOffice.getDataOffice();
            }
        });
        
        $('.btn-viewDetailOwner').bind('click', function(){
            var idOffice = $(this).attr('id-button-id-property');
            instanceManagerOffice.createDialogOwnerByProperty(idOffice);
        });
        
        $('.btn-viewDetailRenter').bind('click', function(){
            var idOffice = $(this).attr('id-button-id-office-renter');
            instanceManagerOffice.createDialogRenterByProperty(idOffice);
        });
        
        $('.btn-deletePropery').bind('click', function(){
            var idOffice = $(this).attr('button-id-property-delete');
            instanceManagerOffice.createDialogSureDeleteOffice(idOffice);
        });
        
        $('.btn-editProperty').bind('click', function(){
            var idOffice = $(this).attr('button-id-property-edit');
            instanceManagerOffice.createDialogEditProperty(idOffice);
        });
        
        $('#btn-saveChangesEdit').bind('click', function(){
            var idProperty = $(this).attr('id-property-button-edit');
            instanceManagerOffice.updateDataProperty(idProperty);
        });
        
        $('#btn-deleteOffice').bind('click', function(){
            var idOffice = $(this).attr('id-button-office-delete');
            instanceManagerOffice.deleteOffice(idOffice);
        });
        
    },
    
    initEventsOwners:function(){
        $('.btn-deleteOwner').bind('click', function(){
            var idOwnerProfile = $(this).attr('button-id-owner-delete');
            var idOfficeLoaded = $(this).attr('id-office-loaded');
            instanceManagerOffice.deleteOwnerOffice(idOwnerProfile, idOfficeLoaded);
        });
    },
    
    createDialogRenterByProperty:function(idOffice){
        flagOwnerActive = 3;
        idOfficeLoadedActive = idOffice;
        instanceManagerOffice.invokeOwnersByOffice(idOffice, 3);
    },
    
    createDialogOwnerByProperty: function(idOffice){
        flagOwnerActive = 2;
        idOfficeLoadedActive = idOffice;
        instanceManagerOffice.invokeOwnersByOffice(idOffice, 2);
    },
    
    invokeOwnersByOffice:function(idOffice, typeOwner){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceOffice.php', 'getUserByOffice', 'idOffice=' + idOffice +'&idTypeUser='+ typeOwner, 'post', 'instanceManagerOffice.bs_getAllOwnerByProperty', 'instanceManagerOffice.cb_getAllOwnerByProperty', 'instanceManagerOffice.err_getAllOwnerByProperty');
    },
    
    cb_getAllOwnerByProperty: function(data){
        if(data.result != "false"){
            var str = '';
            var listOwners = data.result;
            for(i = 0; i < listOwners.length; i++){
                var itemOwnerUser = listOwners[i].dataUser;
                var itemOwnerProfile = listOwners[i].dataProfile;
                var itemIdOffice = listOwners[i].idOffice;
                str += '<div class="eachOwnerPropertyGrid">';
                str += '<div style="width:80px;"><p>' + itemOwnerUser.identification + '</p></div>';
                str += '<div style="width:120px;"><p>' + itemOwnerUser.name + '</p></div>';
                str += '<div style="width:150px;"><p>' + itemOwnerUser.email + '</p></div>';
                str += '<div style="width:80px;"><p>' + itemOwnerUser.home_phone + '</p></div>';
                str += '<div style="width:80px;"><p>' + itemOwnerUser.cel_phone + '</p></div>';
                str += '<div style="width:80px;"><p>' + itemOwnerUser.office_phone + '</p></div>';
                str += '<div style="width:60px;"><p><img id-office-loaded="'+itemIdOffice+'" button-id-owner-delete="'+itemOwnerProfile.id_profile+'" class="btn-deleteOwner" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/red/delete-item.png" /></p></div>';
                str += '</div>'
            }
            $('#tableGridOwners #listItemsGridOwner').html(str);
            $('#infoDialog p').html('Mostrando Resultado');
        }else{
            $('#infoDialog p').html('No se encontró ningun propietario para esta propiedad');
            $('#tableGridOwners #listItemsGridOwner').html('');
        }
        instanceManagerOffice.initEventsOwners();
        instanceManagerOffice.showDialog('dlg-showOwnerByProperty');
        instanceManagerOffice.hideDialog('processing');
    },
    
    err_getAllOwnerByProperty: function(){  },
    
    bs_getAllOwnerByProperty: function(){ 
        instanceManagerOffice.showDialog('processing');
    },
    
    getDataOffice: function(){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceOffice.php', 'getOfficesByBuilding', 'idBuilding=' + instanceManagerOffice.id_building + '&numPage=' + this.numPage + '&sizePage=' + this.sizePage , 'post', 'instanceManagerOffice.bs_getAllOffice', 'instanceManagerOffice.cb_getAllOffice', 'instanceManagerOffice.err_getAllOffice');
    },
    
    bs_getAllOffice: function(){  
        instanceManagerOffice.showDialog('processing');
    },
    
    cb_getAllOffice: function(data){
        if(data.statusParam){
            instanceManagerOffice.drawGridOffices(data.result.listOffices, data.result.totalOffices);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerOffice.hideDialog('processing');
    },
    
    err_getAllOffice: function(){
        console.log("Err Service getProperties");
    },
    
    drawGridOffices: function(listOffices, totalQuery){
        if(listOffices.length != 0){
            var str = '';
            for(var i = 0; i < listOffices.length; i++ ){
                str += '<div class="eachPropertyGrid" id-property-grid="'+listOffices[i].id_office+'">';
                str += '<div style="width:80px;"><p>' + listOffices[i].office_number + '</p></div>';
                str += '<div style="width:80px;"><p> Oficina </p></div>';
                if(listOffices[i].is_occupied == 1){
                    str += '<div style="width:60px;"><p>Si</p></div>';
                }else{
                    str += '<div style="width:60px;"><p>No</p></div>';
                }
                str += '<div style="width:80px;"><p><img id-button-id-property="'+listOffices[i].id_office+'" class="btn-viewDetailOwner" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/multi-agents-edit.png" /></p></div>';
                str += '<div style="width:80px;"><p><img id-button-id-office-renter="'+listOffices[i].id_office+'" class="btn-viewDetailRenter" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/multi-agents-edit.png" /></p></div>';
                str += '<div style="width:70px;"><p>' + listOffices[i].dimensions + '</p></div>';
                str += '<div style="width:90px;"><p>' + listOffices[i].phone + '</p></div>';
                str += '<div style="width:100px;"><p>' + listOffices[i].description + '</p></div>';
                str += '<div style="width:50px;"><p><img button-id-property-delete="'+listOffices[i].id_office+'" class="btn-deletePropery" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/red/delete-item.png" /></p></div>';
                str += '<div style="width:50px;"><p><img button-id-property-edit="'+listOffices[i].id_office+'" class="btn-editProperty" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/edit.png" /></p></div>';
                str += '</div>';
            }
            $('#gridProperties #tableGridProperties #listItemsGrid').html(str);
            $('#content-service #info p').html('Mostrando Resultado');
        }else{
            $('#gridProperties #tableGridProperties #listItemsGrid').html('');
            $('#content-service #info p').html('No Existen Propiedades Para Mostrar');
        }
        instanceManagerOffice.drawPagination(totalQuery);
    },
    
    drawPagination: function(totalQuery){
        var str = "";
        var pages = Math.ceil(totalQuery / instanceManagerOffice.sizePage);
        for(i = 0; i < pages; i++){
            if(instanceManagerOffice.numPage == i){
                str += '<div class="class-pagination-on" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }else{
                str += '<div class="class-pagination-off" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }
        }
        $('#pagination #list-pagination').html(str);
        instanceManagerOffice.eventsPagination();
    },
    
    createDialogEditProperty: function(idOffice){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceOffice.php', 'getDataOffice', 'idOffice=' + idOffice , 'post', 'instanceManagerOffice.bs_getDataProperty', 'instanceManagerOffice.cb_getDataProperty', 'instanceManagerOffice.err_getDataProperty');
    },
    
    bs_getDataProperty: function(){
        instanceManagerOffice.showDialog('processing');
    },
    
    cb_getDataProperty: function(data){
        var info = data.result;
        $('#btn-saveChangesEdit').attr('id-property-button-edit',info.id_office);
        $('#txtEditNumber').val(info.office_number);
        $('#txtEditDimensions').val(info.dimensions);
        $('#txtEditPhone').val(info.phone);
        $('#txtEditDescription').val(info.description);
        var strIsOccupied = '';
        if(info.isOccupied == "1"){
            strIsOccupied = '<option value="1" selected="selected">Si</option><option value="0">No</option>';
        }else{
            strIsOccupied = '<option value="1">Si</option><option value="0" selected="selected">No</option>';
        }
        $('#sltOcuppant').html(strIsOccupied);
        instanceManagerOffice.showDialog('dlg-showEditProperty');
        instanceManagerOffice.hideDialog('processing');
    },
    
    err_getDataProperty: function(){    },
    
    
    updateDataProperty: function(idOffice){
        var occupant = $('#sltOcuppant').val();
        var numberId = $('#txtEditNumber').val();
        var dimensions = $('#txtEditDimensions').val();
        var phone = $('#txtEditPhone').val();
        var description = $('#txtEditDescription').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceOffice.php', 'updateOffice', 
            'idOffice=' + idOffice + '&description=' + description + 
                '&isOccupied=' + occupant + '&dimensions=' + dimensions + 
                    '&phone=' + phone + '&officeNumber=' + numberId, 
                        'post', 'instanceManagerOffice.bs_updateDataProperty', 'instanceManagerOffice.cb_updateDataProperty', 'instanceManagerOffice.err_updateDataProperty');
        
    },
    
    bs_updateDataProperty: function(){ 
        instanceManagerOffice.showDialog('processing');
    },
    
    cb_updateDataProperty: function(data){
        instanceManagerOffice.getDataOffice();
        instanceManagerOffice.hideDialog('dlg-showEditProperty');
        instanceManagerOffice.hideDialog('processing');
    },
    err_updateDataProperty: function(){ },
    
    
    saveAddOffice: function(){
        var number = $('#txtAddNumber').val();
        var isOccupied = $('#sltAddOcuppant').val();
        var dimensions = $('#txtAddDimensions').val();
        var phone = $('#txtAddPhone').val();
        var description = $('#txtAddDescription').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceOffice.php', 'insertOffice', 
            'idBuilding=' + instanceManagerOffice.id_building + '&description=' + description + 
                '&isOccupied=' + isOccupied + '&dimensions=' + dimensions + 
                    '&phone=' + phone + '&officeNumber=' + number, 
                        'post', 'instanceManagerOffice.bs_insertOffice', 'instanceManagerOffice.cb_insertOffice', 'instanceManagerOffice.err_insertOffice');
    },
    
    bs_insertOffice: function(){
        instanceManagerOffice.showDialog('processing');
    },
    
    cb_insertOffice: function(data){
        instanceManagerOffice.getDataOffice();
        $('#txtAddNumber').val("");
        $('#sltAddOcuppant').val("");
        $('#txtAddDimensions').val("");
        $('#txtAddPhone').val("");
        $('#txtAddDescription').val("");
        instanceManagerOffice.hideDialog('dlg-showAddOffice');
        instanceManagerOffice.hideDialog('processing');
    },
    
    err_insertOffice: function(){   },
    
    createDialogSureDeleteOffice:function(idOffice){
        $('#btn-deleteOffice').attr('id-button-office-delete', idOffice);
        instanceManagerOffice.showDialog('dlg-deleteOffice');
    },
    
    deleteOffice:function(idOffice){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceOffice.php', 'deleteOffice', 'idOffice='+idOffice , 'post', 'instanceManagerOffice.bs_deleteOffice', 'instanceManagerOffice.cb_deleteOffice', 'instanceManagerOffice.err_deleteOffice');
    },
    
    bs_deleteOffice: function(){  
        instanceManagerOffice.showDialog('processing');
    },
    
    cb_deleteOffice: function(data){ 
        instanceManagerOffice.getDataOffice();
        $('#infoDialog p').html('Officina eliminada');
        instanceManagerOffice.hideDialog('dlg-deleteOffice');
        instanceManagerOffice.hideDialog('processing');
    },
    
    err_deleteOffice: function(){   },
    
    deleteOwnerOffice: function(idOwnerProfile, idOfficeLoaded){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceOwner.php', 'deteleOwner', 'idOffice='+idOfficeLoaded+'&idUserProfile='+ idOwnerProfile, 'post', 'instanceManagerOffice.bs_deleteOwner', 'instanceManagerOffice.cb_deleteOwner', 'instanceManagerOffice.err_deleteOwner');
    },
    
    bs_deleteOwner: function(){
        instanceManagerOffice.showDialog('processing');
    },
    
    cb_deleteOwner: function(data){
        if(flagOwnerActive == 3){
            instanceManagerOffice.createDialogRenterByProperty(idOfficeLoadedActive);
        }else{
            instanceManagerOffice.createDialogOwnerByProperty(idOfficeLoadedActive);
        }
        instanceManagerOffice.hideDialog('processing');
    },
    
    err_deleteOwner: function(){
        
    }
    
};


//main!
$(function(){
   initManagerProperty();
});

    var instanceManagerOffice = null;
    
    function initManagerProperty(){
        //if(objectClassSession.validateSession()){
            //var id = objectClassSession.getSessionID();
            var idUserProfile = 1;
            var idBuilding = 1;
            loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
            instanceManagerOffice = new classManagerOffice(idUserProfile, idBuilding);
            instanceManagerOffice.init();
        //}
    }