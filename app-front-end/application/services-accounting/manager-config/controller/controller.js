/* 
 * Class and methods of service manager-concepts
 */

var classManagerConfig = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile;
    this.id_building = idBuilding;
    this.sizePage = 10;
    this.numPage = 0;
}

classManagerConfig.prototype = {
    
    init: function(){
        instanceManagerConfig.getDataBuildingAccountant();
        instanceManagerConfig.initEvents();
        instanceManagerConfig.getDataOfficesAccountant();
    },
    
    initEvents: function(){
        
        $('#txtEditAdmonValue').numeric({allow:"."});
        
        $('#txtEditAdmonValue').keyup(function(){
            var value = $('#txtEditAdmonValue').val();
            var valueFormated = accounting.formatMoney(value, "$", 2, ".", ",");
            $('#lblEditFormatedAdmonValue').html(valueFormated);
        });
        
        $('#btn-closeDialogEditAdmonValue').bind('click', function(){
            instanceManagerConfig.hideDialog('dlg-editAdmonValue');
        });
        
        $('#btn-saveEditAdmonValue').bind('click', function(){
            instanceManagerConfig.saveEditAdmonValue();
        });
        
        $('#btn-editBuildingAccountant').bind('click', function(){
            instanceManagerConfig.showDialog('dlg-editBuildingAccountant');
        });
        
        $('#btn-closeDialogEditBuildingAccountant').bind('click', function(){
            instanceManagerConfig.hideDialog('dlg-editBuildingAccountant');
        });
        
        $('#btn-saveEditBuildingAccountant').bind('click', function(){
            instanceManagerConfig.saveEditBuildingAccountant();
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
            if(instanceManagerConfig.numPage != idPage){
                instanceManagerConfig.numPage = idPage ;
                instanceManagerConfig.getDataOfficesAccountant();
            }
        });
        
        $('.chkOffice').bind('click', function(){
            var flag = false;
            $('.chkOffice').each(function(){
                if($(this).is(':checked')){
                    flag = true;                    
                }
            });
            if(flag){
                $('#buttonEditOfficesAccountant').show();
            }else{
                $('#buttonEditOfficesAccountant').hide();
            }
        });
        
        $('#chkAll').bind('click', function(){
            if($(this).is(':checked')){
                $('.chkOffice').each(function(){
                    $(this).attr('checked', 'checked');
                    $('#buttonEditOfficesAccountant').show();
                });
            }else{
                $('.chkOffice').each(function(){
                    $('#buttonEditOfficesAccountant').hide();
                    $(this).removeAttr('checked');
                });
            }
        });
        
        $('#buttonEditOfficesAccountant').bind('click', function(){
            instanceManagerConfig.showDialog('dlg-editAdmonValue');
        });
        
    },
    
    getDataBuildingAccountant: function(){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceAccountant.php', 'getBuildingAccountant', 'idBuilding=' + instanceManagerConfig.id_building, 'post', 'instanceManagerConfig.bs_getDataBuildingAccountant', 'instanceManagerConfig.cb_getDataBuildingAccountant', 'instanceManagerConfig.err_getDataBuildingAccountant');
    },
    
    bs_getDataBuildingAccountant: function(){  
        instanceManagerConfig.showDialog('processing');
    },
    
    cb_getDataBuildingAccountant: function(data){
        if(data.statusParam){
            var info = data.result;
            $('#infoValues').html('Interes por Mora <strong>'+info.interest_rate + '</strong> % <br />  Causaci&oacute;n de Interes <strong>' + info.periods_elapsed + '</strong> periodo(s)');
            $('#txtEditInterestRate').val(info.interest_rate);
            $('#txtEditPeriodsElapsed').val(info.periods_elapsed);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerConfig.hideDialog('processing');
    },
    
    err_getDataBuildingAccountant: function(){
        instanceManagerConfig.hideDialog('processing');
    },
    
    /** info office accountant **/
    
    getDataOfficesAccountant: function(){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceAccountant.php', 'getOfficesAccountant', 'idBuilding=' + instanceManagerConfig.id_building + '&numPage=' + instanceManagerConfig.numPage + '&sizePage=' + instanceManagerConfig.sizePage , 'post', 'instanceManagerConfig.bs_getDataOfficesAccountant', 'instanceManagerConfig.cb_getDataOfficesAccountant', 'instanceManagerConfig.err_getDataOfficesAccountant');
    },
    
    bs_getDataOfficesAccountant: function(){
        instanceManagerConfig.showDialog('processing');
    },
    
    cb_getDataOfficesAccountant: function(data){
        if(data.statusParam){
            instanceManagerConfig.drawGridOfficesAccountant(data.result.listOffices, data.result.totalOffices);
        }else{
            console.log('Err with parameters offices accountant');
        }
        instanceManagerConfig.hideDialog('processing');
    },
    
    err_getDataOfficesAccountant: function(){
        instanceManagerConfig.hideDialog('processing');
    },
    
    drawGridOfficesAccountant: function(listOffices, totalQuery){
        if(listOffices.length != 0){
            var str = '';
            for(var i = 0; i < listOffices.length; i++ ){
                var eachItem = listOffices[i];
                var idOffice = eachItem.infoOffice.id_office;
                var numOffice = eachItem.infoOffice.office_number;
                var admonValueOffice = 0;
                if(eachItem.accountant != null){
                    admonValueOffice = eachItem.accountant.admon_value;
                }
                str += '<div class="eachOfficeAccountantGrid" id-office-accountnt-grid="'+idOffice+'">';
                str += '<div style="width:40px;"><input class="chkOffice" type="checkbox" id-checkbox-office="'+idOffice+'" /></div>';
                str += '<div style="width:80px;"><p>' + numOffice  + '</p></div>';
                str += '<div style="width:200px;"><p>' + accounting.formatMoney(admonValueOffice, "$", 2, ".", ",") + '</p></div>';
                str += '</div>';
            }
            $('#listItemsGrid').html(str);
            $('#content-service #info p').html('Mostrando Resultado');
        }else{
            $('#listItemsGrid').html('');
            $('#content-service #info p').html('No Existen Oficinas para mostrar Para Mostrar');
        }
        instanceManagerConfig.drawPagination(totalQuery);
    },
    
    drawPagination: function(totalQuery){
        var str = "";
        var pages = Math.ceil(totalQuery / instanceManagerConfig.sizePage);
        for(i = 0; i < pages; i++){
            if(instanceManagerConfig.numPage == i){
                str += '<div class="class-pagination-on" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }else{
                str += '<div class="class-pagination-off" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }
        }
        $('#pagination #list-pagination').html(str);
        instanceManagerConfig.eventsPagination();
    },
    
    //save user 
    saveEditBuildingAccountant: function(){
        var interestRate = $('#txtEditInterestRate').val();
        var periodsElapsed = $('#txtEditPeriodsElapsed').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceAccountant.php', 'updateBuildingAccountant',
        'idBuilding=' + instanceManagerConfig.id_building + '&interestRate=' + interestRate + 
                '&periodsElapsed=' + periodsElapsed, 
                        'post', 'instanceManagerConfig.bs_editBuildingAccountant', 'instanceManagerConfig.cb_editBuildingAccountant', 'instanceManagerConfig.err_editBuildingAccountant');
    },
    
    bs_editBuildingAccountant: function(){
        instanceManagerConfig.showDialog('processing');
    },
    
    cb_editBuildingAccountant: function(data){
        instanceManagerConfig.getDataBuildingAccountant();
        instanceManagerConfig.hideDialog('dlg-editBuildingAccountant');
        instanceManagerConfig.hideDialog('processing');
    },
    
    err_editBuildingAccountant: function(){
        instanceManagerConfig.hideDialog('processing');
    },
    
    //save edit Admon Value
    
    saveEditAdmonValue: function(){
        var str = '';
        $('.chkOffice').each(function(){
            if($(this).is(':checked')){
                str += ';' + $(this).attr('id-checkbox-office');
            }
        });
        var value = $('#txtEditAdmonValue').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceAccountant.php', 'updateOfficesAccountant', 'value=' + value + '&idOffices=' + str, 'post', 'instanceManagerConfig.bs_saveEditAdmonValue', 'instanceManagerConfig.cb_saveEditAdmonValue', 'instanceManagerConfig.err_saveEditAdmonValue');
    },
    
    bs_saveEditAdmonValue: function(){
        instanceManagerConfig.showDialog('processing');
    },
    
    cb_saveEditAdmonValue: function(data){
        $('#txtEditAdmonValue').val("");
        $('#lblEditFormatedAdmonValue').html('--');
        $('#chkAll').removeAttr('checked');
        $('#buttonEditOfficesAccountant').hide();
        instanceManagerConfig.getDataOfficesAccountant();
        instanceManagerConfig.hideDialog('dlg-editAdmonValue');
        instanceManagerConfig.hideDialog('processing');
    },
    
    err_saveEditAdmonValue: function(){
        instanceManagerConfig.hideDialog('processing');
    }
    
};


//main!
$(function(){
   initManagerConfig();
});

    var instanceManagerConfig = null;
    
    function initManagerConfig(){
        //if(objectClassSession.validateSession()){
            //var id = objectClassSession.getSessionID();
            var idUserProfile = 1;
            var idBuilding = 1;
            loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
            instanceManagerConfig = new classManagerConfig(idUserProfile, idBuilding);
            instanceManagerConfig.init();
        //}
    }