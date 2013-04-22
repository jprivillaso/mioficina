/* 
 * Class and methods of service manager-expenditure
 */

var classManagerExpenditure = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile;
    this.id_building = idBuilding;
    this.sizePage = 10;
    this.numPage = 0;
}

classManagerExpenditure.prototype = {
    
    init: function(){
        instanceManagerExpenditure.getDataExpenditures("","","");
        instanceManagerExpenditure.getDataConcepts();
        instanceManagerExpenditure.getDataSuppliers();
        instanceManagerExpenditure.initEvents();
    },
    
    initEvents: function(){
        
        $('#txtAddValueExpenditure').numeric({allow:"."});
        
        $('#txtAddValueExpenditure').keyup(function(){
            var value = $('#txtAddValueExpenditure').val();
            var valueFormated = accounting.formatMoney(value, "$", 2, ".", ",");
            $('#lblAddFormatedValueExpenditure').html(valueFormated);
        });
        
        $('#txtEditValueExpenditure').keyup(function(){
            var value = $('#txtEditValueExpenditure').val();
            var valueFormated = accounting.formatMoney(value, "$", 2, ".", ",");
            $('#lblEditFormatedValueExpenditure').html(valueFormated);
        });
        
        $('#buttonAddExpenditure').bind('click', function(){
            instanceManagerExpenditure.showDialog('dlg-addExpenditure');
        });
        
        $('#btn-closeDialogAddExpenditure').bind('click',function(){
            instanceManagerExpenditure.hideDialog('dlg-addExpenditure');
        });
        
        $('#btn-saveAddExpenditure').bind('click', function(){
            instanceManagerExpenditure.saveAddExpenditure();
        });
        
        
        $('#btn-closeDialogEditExpenditure').bind('click', function(){
            instanceManagerExpenditure.hideDialog('dlg-editExpenditure');
        });
        
        
        $('#btn-saveEditExpenditure').bind('click', function(){
            var idExpenditure = $('#btn-saveEditExpenditure').attr('id-expenditure-button-edit');
            instanceManagerExpenditure.saveEditExpenditure(idExpenditure);
        });
        
        $('#btn-closeDialogDeteleExpenditure').bind('click', function(){
            instanceManagerExpenditure.hideDialog('dlg-deleteExpenditure');
        });
        
        $('#btn-deleteExpenditure').bind('click', function(){
            var idExpenditure = $('#btn-deleteExpenditure').attr('id-button-expenditure-delete');
            instanceManagerExpenditure.deleteExpenditure(idExpenditure);
        });
       
       $('#buttonSearchExpenditure').bind('click', function(){
           var dateIni = $('#datepickerInit').val();
           var dateFin = $('#datepickerFin').val();
           var idConcept = $('#sltTypeConceptSearch').val();
           if(idConcept == 'all'){
               idConcept = '';
           }
           instanceManagerExpenditure.getDataExpenditures(dateIni, dateFin, idConcept);
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
            if(instanceManagerExpenditure.numPage != idPage){
                instanceManagerExpenditure.numPage = idPage ;
                instanceManagerExpenditure.getDataExpenditures("","","");
            }
        });
        
        $('.btn-deleteExpenditure').bind('click', function(){
            var idExpenditure = $(this).attr('button-id-expenditure-delete');
            instanceManagerExpenditure.createDialogSureDeleteExpenditure(idExpenditure);
        });
        
        $('.btn-editExpenditure').bind('click', function(){
            var idExpenditure = $(this).attr('button-id-expenditure-edit');
            instanceManagerExpenditure.createDialogEditExpenditure(idExpenditure);
        });
        
    },
    
    getDataExpenditures: function(dateIni, dateFin, idConcept){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceExpenditure.php', 'getAllExpenditures', 'idBuilding=' + instanceManagerExpenditure.id_building + '&dateIni=' + dateIni + '&dateFin=' + dateFin + '&idConcept=' + idConcept + '&numPage=' + instanceManagerExpenditure.numPage + '&sizePage=' + instanceManagerExpenditure.sizePage, 'post', 'instanceManagerExpenditure.bs_getDataExpenditures', 'instanceManagerExpenditure.cb_getDataExpenditures', 'instanceManagerExpenditure.err_getDataExpenditures');
    },
    
    bs_getDataExpenditures: function(){  
        instanceManagerExpenditure.showDialog('processing');
    },
    
    cb_getDataExpenditures: function(data){
        if(data.statusParam){
            instanceManagerExpenditure.drawGridExpenditures(data.result.listExpenditures, data.result.totalExpenditures);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    err_getDataExpenditures: function(){
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    drawGridExpenditures: function(listExpenditures, totalQuery){
        if(listExpenditures.length != 0){
            var str = '';
            for(var i = 0; i < listExpenditures.length; i++ ){
                str += '<div class="eachExpenditureGrid" id-expenditure-grid="'+listExpenditures[i].id_expenditure+'">';
                str += '<div style="width:50px;"><p>' + listExpenditures[i].number_expenditure + '</p></div>';
                str += '<div style="width:100px;"><p>' + listExpenditures[i].name_concept + '</p></div>';
                str += '<div style="width:80px;"><p>' + listExpenditures[i].date_expenditure + '</p></div>';
                str += '<div style="width:90px;"><p>' + accounting.formatMoney(listExpenditures[i].value, "$", 2, ".", ",") + '</p></div>';
                var typePay= "";
                if(listExpenditures[i].id_pay_type == 1){typePay = "Efectivo";}else{typePay = "Banco";}
                str += '<div style="width:60px;"><p>' + typePay + '</p></div>';
                str += '<div style="width:50px;"><p>' + listExpenditures[i].voucher + '</p></div>';
                str += '<div style="width:80px;"><p>' + listExpenditures[i].id_supplier + '</p></div>';
                str += '<div style="width:120px;"><p>' + listExpenditures[i].description_expenditure + '</p></div>';
                str += '<div style="width:50px;"><p><img button-id-expenditure-delete="'+listExpenditures[i].id_expenditure+'" class="btn-deleteExpenditure" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/red/delete-item.png" /></p></div>';
                str += '<div style="width:50px;"><p><img button-id-expenditure-edit="'+listExpenditures[i].id_expenditure+'" class="btn-editExpenditure" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/edit.png" /></p></div>';
                str += '</div>';
            }
            $('#listItemsGrid').html(str);
            $('#content-service #info p').html('Mostrando Resultado');
        }else{
            $('#listItemsGrid').html('');
            $('#content-service #info p').html('No Existen Ingresos Para Mostrar');
        }
        instanceManagerExpenditure.drawPagination(totalQuery);
    },
    
    drawPagination: function(totalQuery){
        var str = "";
        var pages = Math.ceil(totalQuery / instanceManagerExpenditure.sizePage);
        for(i = 0; i < pages; i++){
            if(instanceManagerExpenditure.numPage == i){
                str += '<div class="class-pagination-on" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }else{
                str += '<div class="class-pagination-off" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }
        }
        $('#pagination #list-pagination').html(str);
        instanceManagerExpenditure.eventsPagination();
    },
    
    /** concept list **/
    getDataConcepts: function(){
        var typeConcept = 0;
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceConcept.php', 'getConceptsByType', 'idBuilding=' + instanceManagerExpenditure.id_building + '&typeConcept=' + typeConcept, 'post', 'instanceManagerExpenditure.bs_getDataConcepts', 'instanceManagerExpenditure.cb_getDataConcepts', 'instanceManagerExpenditure.err_getDataConcepts');
    },
    
    bs_getDataConcepts: function(){  
        instanceManagerExpenditure.showDialog('processing');
    },
    
    cb_getDataConcepts: function(data){
        if(data.statusParam){
            var str = '';
            for(i = 0; i < data.result.length; i++){
                var item = data.result[i];
                str += '<option value="'+item.id_concept+'">'+item.name_concept+'</option>';
            }
            $('#sltTypeConceptSearch').html('<option value="all">-- Todos --</option>' + str);
            $('#sltAddTypeConceptExpenditure').html('<option value="none">-- Seleccione Concepto --</option>' + str);
            $('#sltEditTypeConceptExpenditure').html('<option value="none">-- Seleccione Concepto --</option>' + str);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    err_getDataConcepts: function(){
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    
    /** providers list **/
    getDataSuppliers: function (){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceSupplier.php', 'getSupplierByBuilding', 'idBuilding=' + instanceManagerExpenditure.id_building, 'post', 'instanceManagerExpenditure.bs_getDataSuppliers', 'instanceManagerExpenditure.cb_getDataSuppliers', 'instanceManagerExpenditure.err_getDataSuppliers');
    },
    
    bs_getDataSuppliers: function(){
        instanceManagerExpenditure.showDialog('processing');
    },
    
    cb_getDataSuppliers: function(data){
        if(data.statusParam){
            var str = '';
            for(i = 0; i < data.result.length; i++){
                var item = data.result[i];
                str += '<option value="'+item.id_supplier+'">'+item.name_supplier+'</option>';
            }
            $('#sltAddSuppliersExpenditure').html('<option value="none">-- Seleccione Proveedor --</option>' + str);
            $('#sltEditSuppliersExpenditure').html('<option value="none">-- Seleccione Proveedor --</option>' + str);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerExpenditure.hideDialog('processing');
    },
    err_getDataSuppliers: function(){
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    //save user 
    saveAddExpenditure: function(){
        var conceptExpenditure = $('#sltAddTypeConceptExpenditure').val();
        var dateExpenditure = $('#txtAddDateExpenditure').val();
        var valueExpenditure = $('#txtAddValueExpenditure').val();
        var payTypeExpenditure = $('#sltAddPayTypeExpenditure').val();
        var voucherExpenditure = $('#txtAddVoucherExpenditure').val();
        var supplierExpenditure = $('#sltAddSuppliersExpenditure').val();
        var descriptionExpenditure = $('#txtAddDescriptionExpenditure').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceExpenditure.php', 'insertExpenditure', 
            'idBuilding=' + instanceManagerExpenditure.id_building + '&idConcept=' + conceptExpenditure + 
                '&dateExpenditure=' + dateExpenditure + '&value=' + valueExpenditure + '&voucher=' + voucherExpenditure + '&idPayType=' + payTypeExpenditure + '&idSupplier=' + supplierExpenditure + '&description=' + descriptionExpenditure,
                        'post', 'instanceManagerExpenditure.bs_insertExpenditure', 'instanceManagerExpenditure.cb_insertExpenditure', 'instanceManagerExpenditure.err_insertExpenditure');
    },
    
    bs_insertExpenditure: function(){
        instanceManagerExpenditure.showDialog('processing');
    },
    
    cb_insertExpenditure: function(data){
        $('#txtAddDateExpenditure').val("");
        $('#txtAddValueExpenditure').val("");
        $('#txtAddVoucherExpenditure').val("");
        $('#txtAddDescriptionExpenditure').val("");
        $('#lblAddFormatedValueExpenditure').html('--');
        instanceManagerExpenditure.getDataExpenditures("", "", "");
        instanceManagerExpenditure.hideDialog('dlg-addExpenditure');
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    err_insertExpenditure: function(){
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    //edit expenditure
    createDialogEditExpenditure: function(idExpenditure){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceExpenditure.php', 'getExpenditureById', 'idExpenditure=' + idExpenditure, 'post', 'instanceManagerExpenditure.bs_getDataEditExpenditure', 'instanceManagerExpenditure.cb_getDataEditExpenditure', 'instanceManagerExpenditure.err_getDataEditExpenditure');
    },
    
    bs_getDataEditExpenditure: function(){
        instanceManagerExpenditure.showDialog('processing');
    },
    
    cb_getDataEditExpenditure: function(data){
        var info = data.result;
        $('#btn-saveEditExpenditure').attr('id-expenditure-button-edit',info.id_expenditure);
        $('#txtEditDateExpenditure').val(info.date_expenditure);
        $('#txtEditValueExpenditure').val(info.value);
        var valueFormated = accounting.formatMoney(info.value, "$", 2, ".", ",");
        $('#lblEditFormatedValueExpenditure').html(valueFormated);
        $('#txtEditVoucherExpenditure').val(info.voucher);
        $('#txtEditDescriptionExpenditure').val(info.description_expenditure);
        
        var strConcepts = '';
        $('#sltEditTypeConceptExpenditure option').each(function(){
            var item = $(this);
            if(item.attr("value") == info.id_concept){
                strConcepts += '<option selected="selected" value="'+item.attr("value")+'">'+ item.html() +'</option>';
            }else{
                strConcepts += '<option value="'+item.attr("value")+'">'+ item.html() +'</option>';
            }
        });
        $('#sltEditTypeConceptExpenditure').html(strConcepts);
        
        var strSuppliers = '';
        $('#sltEditSuppliersExpenditure option').each(function(){
            var item = $(this);
            if(item.attr("value") == info.id_supplier){
                strSuppliers += '<option selected="selected" value="'+item.attr("value")+'">'+ item.html() +'</option>';
            }else{
                strSuppliers += '<option value="'+item.attr("value")+'">'+ item.html() +'</option>';
            }
        });
        $('#sltEditSuppliersExpenditure').html(strSuppliers);
        
        var strPayType = '';
        if(info.id_pay_type == "1"){
            strPayType = '<option value="1" selected="selected">Efectivo</option><option value="2">Banco</option>';
        }else{
            strPayType = '<option value="1">Efectivo</option><option value="2" selected="selected">Banco</option>';
        }
        $('#sltEditPayTypeExpenditure').html(strPayType);
        
        instanceManagerExpenditure.showDialog('dlg-editExpenditure')
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    err_getDataEditExpenditure: function(){    },
    
    saveEditExpenditure: function(idExpenditure){
        var idTypeConcept = $('#sltEditTypeConceptExpenditure').val();
        var dateExpenditure = $('#txtEditDateExpenditure').val();
        var valueExpenditure = $('#txtEditValueExpenditure').val();
        var payTypeExpenditure = $('#sltEditPayTypeExpenditure').val();
        var voucherExpenditure = $('#txtEditVoucherExpenditure').val();
        var supplierExpenditure = $('#sltEditSuppliersExpenditure').val();
        var descriptionExpenditure = $('#txtEditDescriptionExpenditure').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceExpenditure.php', 'updateExpenditure', 'idExpenditure=' + idExpenditure + '&idConcept=' + idTypeConcept + 
            '&dateExpenditure=' + dateExpenditure + '&voucher=' + voucherExpenditure + '&value=' + valueExpenditure + '&idPayType=' + payTypeExpenditure + '&idSupplier=' + supplierExpenditure + '&description=' + descriptionExpenditure,
            'post', 'instanceManagerExpenditure.bs_saveEditExpenditure', 'instanceManagerExpenditure.cb_saveEditExpenditure', 'instanceManagerExpenditure.err_saveEditExpenditure');
    },
    
    bs_saveEditExpenditure: function(){
        instanceManagerExpenditure.showDialog('processing');
    },
    
    cb_saveEditExpenditure: function(data){
        instanceManagerExpenditure.getDataExpenditures("", "", "");
        instanceManagerExpenditure.hideDialog('dlg-editExpenditure')
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    err_saveEditExpenditure: function(){
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    
    createDialogSureDeleteExpenditure:function(idExpenditure){
        $('#btn-deleteExpenditure').attr('id-button-expenditure-delete', idExpenditure);
        instanceManagerExpenditure.showDialog('dlg-deleteExpenditure');
    },
    
    deleteExpenditure: function(idExpenditure){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceExpenditure.php', 'deleteExpenditure', 'idExpenditure=' + idExpenditure, 'post', 'instanceManagerExpenditure.bs_deleteExpenditure', 'instanceManagerExpenditure.cb_deleteExpenditure', 'instanceManagerExpenditure.err_deleteExpenditure');
    },
    
    
    bs_deleteExpenditure: function(){
        instanceManagerExpenditure.showDialog('processing');
    },
    
    cb_deleteExpenditure: function(data){
        instanceManagerExpenditure.getDataExpenditures("", "", "");
        instanceManagerExpenditure.hideDialog('dlg-deleteExpenditure');
        instanceManagerExpenditure.hideDialog('processing');
    },
    
    err_deleteExpenditure: function(){
        instanceManagerExpenditure.hideDialog('processing');
    }
    
};


//main!
$(function(){
   initManagerExpenditure();
});

    var instanceManagerExpenditure = null;
    
    function initManagerExpenditure(){
        //if(objectClassSession.validateSession()){
            //var id = objectClassSession.getSessionID();
            var idUserProfile = 1;
            var idBuilding = 1;
            loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
            instanceManagerExpenditure = new classManagerExpenditure(idUserProfile, idBuilding);
            instanceManagerExpenditure.init();
        //}
    }