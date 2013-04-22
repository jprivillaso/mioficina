/* 
 * Class and methods of service manager-income
 */

var classManagerIncome = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile
    this.id_building = idBuilding;
    this.sizePage = 10;
    this.numPage = 0;
}

classManagerIncome.prototype = {
    
    init: function(){
        instanceManagerIncome.getDataIncomes("","","");
        instanceManagerIncome.getDataConcepts();
        instanceManagerIncome.initEvents();
    },
    
    initEvents: function(){
        
        $('#txtAddValueIncome').numeric({allow:"."});
        
        $('#txtAddValueIncome').keyup(function(){
            var value = $('#txtAddValueIncome').val();
            var valueFormated = accounting.formatMoney(value, "$", 2, ".", ",");
            $('#lblAddFormatedValueIncome').html(valueFormated);
        });
        
        $('#txtEditValueIncome').keyup(function(){
            var value = $('#txtEditValueIncome').val();
            var valueFormated = accounting.formatMoney(value, "$", 2, ".", ",");
            $('#lblEditFormatedValueIncome').html(valueFormated);
        });
        
        $('#buttonAddIncome').bind('click', function(){
            instanceManagerIncome.showDialog('dlg-addIncome');
        });
        
        $('#btn-closeDialogAddIncome').bind('click',function(){
            instanceManagerIncome.hideDialog('dlg-addIncome');
        });
        
        $('#btn-saveAddIncome').bind('click', function(){
            instanceManagerIncome.saveAddIncome();
        });
        
        
        $('#btn-closeDialogEditIncome').bind('click', function(){
            instanceManagerIncome.hideDialog('dlg-editIncome');
        });
        
        
        $('#btn-saveEditIncome').bind('click', function(){
            var idIncome = $('#btn-saveEditIncome').attr('id-income-button-edit');
            instanceManagerIncome.saveEditIncome(idIncome);
        });
        
        $('#btn-closeDialogDeteleIncome').bind('click', function(){
            instanceManagerIncome.hideDialog('dlg-deleteIncome');
        });
        
        $('#btn-deleteIncome').bind('click', function(){
            var idIncome = $('#btn-deleteIncome').attr('id-button-income-delete');
            instanceManagerIncome.deleteIncome(idIncome);
        });
       
       $('#buttonSearchIncome').bind('click', function(){
           var dateIni = $('#datepickerInit').val();
           var dateFin = $('#datepickerFin').val();
           var idConcept = $('#sltTypeConceptSearch').val();
           if(idConcept == 'all'){
               idConcept = '';
           }
           instanceManagerIncome.getDataIncomes(dateIni, dateFin, idConcept);
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
            if(instanceManagerIncome.numPage != idPage){
                instanceManagerIncome.numPage = idPage ;
                instanceManagerIncome.getDataIncomes("","","");
            }
        });
        
        $('.btn-deleteIncome').bind('click', function(){
            var idIncome = $(this).attr('button-id-income-delete');
            instanceManagerIncome.createDialogSureDeleteIncome(idIncome);
        });
        
        $('.btn-editIncome').bind('click', function(){
            var idIncome = $(this).attr('button-id-income-edit');
            instanceManagerIncome.createDialogEditIncome(idIncome);
        });
        
    },
    
    getDataIncomes: function(dateIni, dateFin, idConcept){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceIncome.php', 'getAllIncomes', 'idBuilding=' + instanceManagerIncome.id_building + '&dateIni=' + dateIni + '&dateFin=' + dateFin + '&idConcept=' + idConcept + '&numPage=' + instanceManagerIncome.numPage + '&sizePage=' + instanceManagerIncome.sizePage, 'post', 'instanceManagerIncome.bs_getDataIncomes', 'instanceManagerIncome.cb_getDataIncomes', 'instanceManagerIncome.err_getDataIncomes');
    },
    
    bs_getDataIncomes: function(){  
        instanceManagerIncome.showDialog('processing');
    },
    
    cb_getDataIncomes: function(data){
        if(data.statusParam){
            instanceManagerIncome.drawGridIncomes(data.result.listIncomes, data.result.totalIncomes);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerIncome.hideDialog('processing');
    },
    
    err_getDataIncomes: function(){
        instanceManagerIncome.hideDialog('processing');
    },
    
    drawGridIncomes: function(listIncomes, totalQuery){
        if(listIncomes.length != 0){
            var str = '';
            for(var i = 0; i < listIncomes.length; i++ ){
                str += '<div class="eachIncomeGrid" id-income-grid="'+listIncomes[i].id_income+'">';
                str += '<div style="width:50px;"><p>' + listIncomes[i].number_income + '</p></div>';
                str += '<div style="width:100px;"><p>' + listIncomes[i].name_concept + '</p></div>';
                str += '<div style="width:80px;"><p>' + listIncomes[i].date_income + '</p></div>';
                str += '<div style="width:90px;"><p>' + accounting.formatMoney(listIncomes[i].value, "$", 2, ".", ",") + '</p></div>';
                var typePay= "";
                if(listIncomes[i].id_pay_type == 1){typePay = "Efectivo";}else{typePay = "Banco";}
                str += '<div style="width:60px;"><p>' + typePay + '</p></div>';
                str += '<div style="width:100px;"><p>' + listIncomes[i].from + '</p></div>';
                str += '<div style="width:120px;"><p>' + listIncomes[i].description_income + '</p></div>';
                str += '<div style="width:50px;"><p><img button-id-income-delete="'+listIncomes[i].id_income+'" class="btn-deleteIncome" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/red/delete-item.png" /></p></div>';
                str += '<div style="width:50px;"><p><img button-id-income-edit="'+listIncomes[i].id_income+'" class="btn-editIncome" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/edit.png" /></p></div>';
                str += '</div>';
            }
            $('#listItemsGrid').html(str);
            $('#content-service #info p').html('Mostrando Resultado');
        }else{
            $('#listItemsGrid').html('');
            $('#content-service #info p').html('No Existen Ingresos Para Mostrar');
        }
        instanceManagerIncome.drawPagination(totalQuery);
    },
    
    drawPagination: function(totalQuery){
        var str = "";
        var pages = Math.ceil(totalQuery / instanceManagerIncome.sizePage);
        for(i = 0; i < pages; i++){
            if(instanceManagerIncome.numPage == i){
                str += '<div class="class-pagination-on" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }else{
                str += '<div class="class-pagination-off" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }
        }
        $('#pagination #list-pagination').html(str);
        instanceManagerIncome.eventsPagination();
    },
    
    /** concept list **/
    getDataConcepts: function(){
        var typeConcept = 1;
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceConcept.php', 'getConceptsByType', 'idBuilding=' + instanceManagerIncome.id_building + '&typeConcept=' + typeConcept, 'post', 'instanceManagerIncome.bs_getDataConcepts', 'instanceManagerIncome.cb_getDataConcepts', 'instanceManagerIncome.err_getDataConcepts');
    },
    
    bs_getDataConcepts: function(){  
        instanceManagerIncome.showDialog('processing');
    },
    
    cb_getDataConcepts: function(data){
        if(data.statusParam){
            var str = '';
            for(i = 0; i < data.result.length; i++){
                var item = data.result[i];
                str += '<option value="'+item.id_concept+'">'+item.name_concept+'</option>';
            }
            $('#sltTypeConceptSearch').html('<option value="all">-- Todos --</option>' + str);
            $('#sltAddTypeConceptIncome').html('<option value="none">-- Seleccione Concepto --</option>' + str);
            $('#sltEditTypeConceptIncome').html('<option value="none">-- Seleccione Concepto --</option>' + str);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerIncome.hideDialog('processing');
    },
    
    err_getDataConcepts: function(){
        instanceManagerIncome.hideDialog('processing');
    },
    
    //save user 
    saveAddIncome: function(){
        var conceptIncome = $('#sltAddTypeConceptIncome').val();
        var dateIncome = $('#txtAddDateIncome').val();
        var valueIncome = $('#txtAddValueIncome').val();
        var payTypeIncome = $('#sltAddPayTypeIncome').val();
        var fromIncome = $('#txtAddFromIncome').val();
        var descriptionIncome = $('#txtAddDescriptionIncome').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceIncome.php', 'insertIncomeGeneral', 
            'idBuilding=' + instanceManagerIncome.id_building + '&idConcept=' + conceptIncome + 
                '&dateIncome=' + dateIncome + '&value=' + valueIncome + '&payType=' + payTypeIncome + '&from=' + fromIncome + '&description=' + descriptionIncome,
                        'post', 'instanceManagerIncome.bs_insertIncome', 'instanceManagerIncome.cb_insertIncome', 'instanceManagerIncome.err_insertIncome');
    },
    
    bs_insertIncome: function(){
        instanceManagerIncome.showDialog('processing');
    },
    
    cb_insertIncome: function(data){
        $('#txtAddDateIncome').val("");
        $('#txtAddValueIncome').val("");
        $('#txtAddFromIncome').val("");
        $('#txtAddDescriptionIncome').val("");
        $('#lblAddFormatedValueIncome').html('--');
        instanceManagerIncome.getDataIncomes("", "", "");
        instanceManagerIncome.hideDialog('dlg-addIncome');
        instanceManagerIncome.hideDialog('processing');
    },
    
    err_insertIncome: function(){
        instanceManagerIncome.hideDialog('processing');
    },
    
    //edit income
    createDialogEditIncome: function(idIncome){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceIncome.php', 'getIncomeById', 'idIncome=' + idIncome, 'post', 'instanceManagerIncome.bs_getDataEditIncome', 'instanceManagerIncome.cb_getDataEditIncome', 'instanceManagerIncome.err_getDataEditIncome');
    },
    
    bs_getDataEditIncome: function(){
        instanceManagerIncome.showDialog('processing');
    },
    
    cb_getDataEditIncome: function(data){
        var info = data.result;
        $('#btn-saveEditIncome').attr('id-income-button-edit',info.id_income);
        $('#txtEditDateIncome').val(info.date_income);
        $('#txtEditValueIncome').val(info.value);
        var valueFormated = accounting.formatMoney(info.value, "$", 2, ".", ",");
        $('#lblEditFormatedValueIncome').html(valueFormated);
        $('#txtEditFromIncome').val(info.from);
        $('#txtEditDescriptionIncome').val(info.description_income);
        
        var strConcepts = '';
        $('#sltEditTypeConceptIncome option').each(function(){
            var item = $(this);
            if(item.attr("value") == info.id_concept){
                strConcepts += '<option selected="selected" value="'+item.attr("value")+'">'+ item.html() +'</option>';
            }else{
                strConcepts += '<option value="'+item.attr("value")+'">'+ item.html() +'</option>';
            }
        });
        $('#sltEditTypeConceptIncome').html(strConcepts);
        
        var strPayType = '';
        if(info.id_pay_type == "1"){
            strPayType = '<option value="1" selected="selected">Efectivo</option><option value="2">Banco</option>';
        }else{
            strPayType = '<option value="1">Efectivo</option><option value="2" selected="selected">Banco</option>';
        }
        $('#sltEditPayTypeIncome').html(strPayType);
        
        instanceManagerIncome.showDialog('dlg-editIncome')
        instanceManagerIncome.hideDialog('processing');
    },
    
    err_getDataEditIncome: function(){    },
    
    saveEditIncome: function(idIncome){
        var idTypeConcept = $('#sltEditTypeConceptIncome').val();
        var dateIncome = $('#txtEditDateIncome').val();
        var valueIncome = $('#txtEditValueIncome').val();
        var payTypeIncome = $('#sltEditPayTypeIncome').val();
        var fromIncome = $('#txtEditFromIncome').val();
        var descriptionIncome = $('#txtEditDescriptionIncome').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceIncome.php', 'updateIncome', 'idIncome=' + idIncome + '&idConcept=' + idTypeConcept + '&idInnvoice=0' + 
            '&dateIncome=' + dateIncome + '&value=' + valueIncome + '&payType=' + payTypeIncome + '&from=' + fromIncome + '&description=' + descriptionIncome,
            'post', 'instanceManagerIncome.bs_saveEditIncome', 'instanceManagerIncome.cb_saveEditIncome', 'instanceManagerIncome.err_saveEditIncome');
    },
    
    bs_saveEditIncome: function(){
        instanceManagerIncome.showDialog('processing');
    },
    
    cb_saveEditIncome: function(data){
        instanceManagerIncome.getDataIncomes("", "", "");
        instanceManagerIncome.hideDialog('dlg-editIncome')
        instanceManagerIncome.hideDialog('processing');
    },
    
    err_saveEditIncome: function(){
        
    },
    
    
    createDialogSureDeleteIncome:function(idIncome){
        $('#btn-deleteIncome').attr('id-button-income-delete', idIncome);
        instanceManagerIncome.showDialog('dlg-deleteIncome');
    },
    
    deleteIncome: function(idIncome){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceIncome.php', 'deleteIncome', 'idIncome=' + idIncome, 'post', 'instanceManagerIncome.bs_deleteIncome', 'instanceManagerIncome.cb_deleteIncome', 'instanceManagerIncome.err_deleteIncome');
    },
    
    
    bs_deleteIncome: function(){
        instanceManagerIncome.showDialog('processing');
    },
    
    cb_deleteIncome: function(data){
        instanceManagerIncome.getDataIncomes("", "", "");
        instanceManagerIncome.hideDialog('dlg-deleteIncome');
        instanceManagerIncome.hideDialog('processing');
    },
    
    err_deleteIncome: function(){
        
    }
    
};


//main!
$(function(){
   initManagerIncome();
});

    var instanceManagerIncome = null;
    
    function initManagerIncome(){
        //if(objectClassSession.validateSession()){
            //var id = objectClassSession.getSessionID();
            var idUserProfile = 1;
            var idBuilding = 1;
            loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
            instanceManagerIncome = new classManagerIncome(idUserProfile, idBuilding);
            instanceManagerIncome.init();
        //}
    }