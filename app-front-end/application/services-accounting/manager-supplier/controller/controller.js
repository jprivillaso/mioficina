/* 
 * Class and methods of service manager-Suppliers
 */

var classManagerSupplier = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile
    this.id_building = idBuilding;
    this.sizePage = 10;
    this.numPage = 0;
}

classManagerSupplier.prototype = {
    
    init: function(){
        instanceManagerSupplier.initEvents();
        instanceManagerSupplier.getDataSuppliers();
    },
    
    initEvents: function(){
        
        $('#btn-closeDialogAddSupplier').bind('click',function(){
            instanceManagerSupplier.hideDialog('dlg-addSupplier');
        });
        
        $('#btn-closeDialogEditSupplier').bind('click', function(){
            instanceManagerSupplier.hideDialog('dlg-editSupplier');
        });

        $('#buttonAddSupplier').bind('click', function(){
            instanceManagerSupplier.showDialog('dlg-addSupplier');
        });
        
        $('#btn-saveAddSupplier').bind('click', function(){
            instanceManagerSupplier.saveAddSupplier();
        });
        
        $('#btn-saveEditSupplier').bind('click', function(){
            var idSupplier = $(this).attr('id-supplier-button-edit');
            instanceManagerSupplier.saveEditSupplier(idSupplier);
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
            if(instanceManagerSupplier.numPage != idPage){
                instanceManagerSupplier.numPage = idPage ;
                instanceManagerSupplier.getDataSuppliers();
            }
        });
        
        $('.btn-editSupplier').bind('click', function(){
            var idSupplier = $(this).attr('button-id-supplier-edit');
            instanceManagerSupplier.createDialogEditSupplier(idSupplier);
        });
        
    },
    
    getDataSuppliers: function(){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceSupplier.php', 'getSupplierByBuilding', 'idBuilding=' + instanceManagerSupplier.id_building + '&numPage=' + this.numPage + '&sizePage=' + this.sizePage , 'post', 'instanceManagerSupplier.bs_getDataSuppliers', 'instanceManagerSupplier.cb_getDataSuppliers', 'instanceManagerSupplier.err_getDataSuppliers');
    },
    
    bs_getDataSuppliers: function(){  
        instanceManagerSupplier.showDialog('processing');
    },
    
    cb_getDataSuppliers: function(data){
        if(data.statusParam){
            instanceManagerSupplier.drawGridSuppliers(data.result.listSuppliers, data.result.totalSuppliers);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerSupplier.hideDialog('processing');
    },
    
    err_getDataSuppliers: function(){
        instanceManagerSupplier.hideDialog('processing');
    },
    
    drawGridSuppliers: function(listSuppliers, totalQuery){
        if(listSuppliers.length != 0){
            var str = '';
            for(var i = 0; i < listSuppliers.length; i++ ){
                str += '<div class="eachSupplierGrid" id-supplier-grid="'+listSuppliers[i].id_supplier+'">';
                str += '<div style="width:100px;"><p>' + listSuppliers[i].name_supplier + '</p></div>';
                str += '<div style="width:80px;"><p>' + listSuppliers[i].identification + '</p></div>';
                str += '<div style="width:80px;"><p>' + listSuppliers[i].nit_supplier + '</p></div>';
                str += '<div style="width:80px;"><p>' + listSuppliers[i].phone_supplier + '</p></div>';
                str += '<div style="width:120px;"><p>' + listSuppliers[i].address_supplier + '</p></div>';
                str += '<div style="width:140px;"><p>' + listSuppliers[i].email_supplier + '</p></div>';
                str += '<div style="width:50px;"><p><img button-id-supplier-edit="'+listSuppliers[i].id_supplier+'" class="btn-editSupplier" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/edit.png" /></p></div>';
                str += '</div>';
            }
            $('#listItemsGrid').html(str);
            $('#content-service #info p').html('Mostrando Resultado');
        }else{
            $('#listItemsGrid').html('');
            $('#content-service #info p').html('No Existen Supplieros Para Mostrar');
        }
        instanceManagerSupplier.drawPagination(totalQuery);
    },
    
    drawPagination: function(totalQuery){
        var str = "";
        var pages = Math.ceil(totalQuery / instanceManagerSupplier.sizePage);
        for(i = 0; i < pages; i++){
            if(instanceManagerSupplier.numPage == i){
                str += '<div class="class-pagination-on" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }else{
                str += '<div class="class-pagination-off" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }
        }
        $('#pagination #list-pagination').html(str);
        instanceManagerSupplier.eventsPagination();
    },
    
    //save user 
    saveAddSupplier: function(){
        var name = $('#txtAddName').val();
        var ID = $('#txtAddID').val();
        var nit = $('#txtAddNit').val();
        var phone = $('#txtAddPhone').val();
        var address = $('#txtAddAddress').val();
        var email = $('#txtAddEmail').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceSupplier.php', 'insertSupplier', 
            'idBuilding=' + instanceManagerSupplier.id_building + '&nameSupplier=' + name + 
                '&IDSupplier=' + ID + '&nitSupplier=' + nit + '&phoneSupplier=' + phone + '&addressSupplier=' + address + '&emailSupplier=' + email, 
                        'post', 'instanceManagerSupplier.bs_insertSupplier', 'instanceManagerSupplier.cb_insertSupplier', 'instanceManagerSupplier.err_insertSupplier');
    },
    
    bs_insertSupplier: function(){
        instanceManagerSupplier.showDialog('processing');
    },
    
    cb_insertSupplier: function(data){
        $('#txtAddName').val("");
        $('#txtAddID').val("");
        $('#txtAddNit').val("");
        $('#txtAddPhone').val("");
        $('#txtAddAddress').val("");
        $('#txtAddEmail').val("");
        instanceManagerSupplier.getDataSuppliers();
        instanceManagerSupplier.hideDialog('dlg-addSupplier');
        instanceManagerSupplier.hideDialog('processing');
    },
    
    err_insertSupplier: function(){
        instanceManagerSupplier.hideDialog('processing');
    },
    
    //edit Supplier
    createDialogEditSupplier: function(idSupplier){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceSupplier.php', 'getSupplierById', 'idSupplier=' + idSupplier, 'post', 'instanceManagerSupplier.bs_getDataEditSupplier', 'instanceManagerSupplier.cb_getDataEditSupplier', 'instanceManagerSupplier.err_getDataEditSupplier');
    },
    
    bs_getDataEditSupplier: function(){
        instanceManagerSupplier.showDialog('processing');
    },
    
    cb_getDataEditSupplier: function(data){
        var info = data.result;
        $('#btn-saveEditSupplier').attr('id-supplier-button-edit', info.id_supplier);
        $('#txtEditName').val(info.name_supplier);
        $('#txtEditID').val(info.identification);
        $('#txtEditNit').val(info.nit_supplier);
        $('#txtEditPhone').val(info.phone_supplier);
        $('#txtEditAddress').val(info.address_supplier);
        $('#txtEditEmail').val(info.email_supplier);
        instanceManagerSupplier.showDialog('dlg-editSupplier')
        instanceManagerSupplier.hideDialog('processing');
    },
    
    err_getDataEditSupplier: function(){   
        instanceManagerSupplier.hideDialog('processing');
    },
    
    saveEditSupplier: function(idSupplier){
        var name = $('#txtEditName').val();
        var ID = $('#txtEditID').val();
        var nit = $('#txtEditNit').val();
        var phone = $('#txtEditPhone').val();
        var address = $('#txtEditAddress').val();
        var email = $('#txtEditEmail').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceSupplier.php', 'updateSupplier', 'idSupplier=' + idSupplier + '&nameSupplier=' + name + '&IDSupplier=' + ID + '&nitSupplier=' + nit + '&phoneSupplier=' + phone + '&addressSupplier=' + address + '&emailSupplier=' + email, 'post', 'instanceManagerSupplier.bs_saveEditSupplier', 'instanceManagerSupplier.cb_saveEditSupplier', 'instanceManagerSupplier.err_saveEditSupplier');
    },
    
    bs_saveEditSupplier: function(){
        instanceManagerSupplier.showDialog('processing');
    },
    
    cb_saveEditSupplier: function(data){
        instanceManagerSupplier.getDataSuppliers();
        instanceManagerSupplier.hideDialog('dlg-editSupplier');
        instanceManagerSupplier.hideDialog('processing');
    },
    
    err_saveEditSupplier: function(){
        instanceManagerSupplier.hideDialog('processing');
    }
    
};


//main!
$(function(){
   initManagerSupplier();
});

    var instanceManagerSupplier = null;
    
    function initManagerSupplier(){
        //if(objectClassSession.validateSession()){
            //var id = objectClassSession.getSessionID();
            var idUserProfile = 1;
            var idBuilding = 1;
            loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
            instanceManagerSupplier = new classManagerSupplier(idUserProfile, idBuilding);
            instanceManagerSupplier.init();
        //}
    }