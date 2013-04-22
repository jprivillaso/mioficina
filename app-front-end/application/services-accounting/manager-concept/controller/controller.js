/* 
 * Class and methods of service manager-concepts
 */

var classManagerConcept = function (idUserProfile, idBuilding) {  
    this.id_user = idUserProfile
    this.id_building = idBuilding;
    this.sizePage = 10;
    this.numPage = 0;
}

classManagerConcept.prototype = {
    
    init: function(){
        instanceManagerConcept.initEvents();
        var idType = $('#sltTypeConcept').val();
        instanceManagerConcept.getDataConcepts(idType);
    },
    
    initEvents: function(){
        
        $('#btn-closeDialogAddConcept').bind('click',function(){
            instanceManagerConcept.hideDialog('dlg-addConcept');
        });
        
        $('#btn-closeDialogEditConcept').bind('click', function(){
            instanceManagerConcept.hideDialog('dlg-editConcept');
        });

        $('#buttonAddConcept').bind('click', function(){
            instanceManagerConcept.showDialog('dlg-addConcept');
        });
        
        $('#btn-saveAddConcept').bind('click', function(){
            instanceManagerConcept.saveAddConcept();
        });
        
        $('#btn-saveEditConcept').bind('click', function(){
            var idConcept = $(this).attr('id-concept-button-edit');
            instanceManagerConcept.saveEditConcept(idConcept);
        });
        
        $('#sltTypeConcept').change(function(){
            var idType = $('#sltTypeConcept').val();
            instanceManagerConcept.getDataConcepts(idType);
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
            if(instanceManagerConcept.numPage != idPage){
                instanceManagerConcept.numPage = idPage ;
                instanceManagerConcept.getDataConcepts();
            }
        });
        
        $('.btn-editConcept').bind('click', function(){
            var idConcept = $(this).attr('button-id-concept-edit');
            instanceManagerConcept.createDialogEditConcept(idConcept);
        });
        
    },
    
    getDataConcepts: function(idTypeConcept){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceConcept.php', 'getConceptsByType', 'idBuilding=' + instanceManagerConcept.id_building + '&typeConcept=' + idTypeConcept + '&numPage=' + this.numPage + '&sizePage=' + this.sizePage , 'post', 'instanceManagerConcept.bs_getDataConcepts', 'instanceManagerConcept.cb_getDataConcepts', 'instanceManagerConcept.err_getDataConcepts');
    },
    
    bs_getDataConcepts: function(){  
        instanceManagerConcept.showDialog('processing');
    },
    
    cb_getDataConcepts: function(data){
        if(data.statusParam){
            instanceManagerConcept.drawGridConcepts(data.result.listConcepts, data.result.totalConcepts);
        }else{
            console.log('Err with parameters');
        }
        instanceManagerConcept.hideDialog('processing');
    },
    
    err_getDataConcepts: function(){
        instanceManagerConcept.hideDialog('processing');
    },
    
    drawGridConcepts: function(listConcepts, totalQuery){
        if(listConcepts.length != 0){
            var str = '';
            for(var i = 0; i < listConcepts.length; i++ ){
                str += '<div class="eachConceptGrid" id-concept-grid="'+listConcepts[i].id_concept+'">';
                var type= "";
                if(listConcepts[i].type_concept == 0){type = "Egreso";}else{type = "Ingreso";}
                str += '<div style="width:80px;"><p>' + type + '</p></div>';
                str += '<div style="width:200px;"><p>' + listConcepts[i].name_concept + '</p></div>';
                str += '<div style="width:280px;"><p>' + listConcepts[i].description + '</p></div>';
                str += '<div style="width:50px;"><p><img button-id-concept-edit="'+listConcepts[i].id_concept+'" class="btn-editConcept" src="http://mioficina.co/app-front-end/resources/multimedia/iconos/blue/edit.png" /></p></div>';
                str += '</div>';
            }
            $('#listItemsGrid').html(str);
            $('#content-service #info p').html('Mostrando Resultado');
        }else{
            $('#listItemsGrid').html('');
            $('#content-service #info p').html('No Existen Conceptos Para Mostrar');
        }
        instanceManagerConcept.drawPagination(totalQuery);
    },
    
    drawPagination: function(totalQuery){
        var str = "";
        var pages = Math.ceil(totalQuery / instanceManagerConcept.sizePage);
        for(i = 0; i < pages; i++){
            if(instanceManagerConcept.numPage == i){
                str += '<div class="class-pagination-on" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }else{
                str += '<div class="class-pagination-off" id-pagination="'+i+'"><p>'+ (i+1) +'</p></div>'; 
            }
        }
        $('#pagination #list-pagination').html(str);
        instanceManagerConcept.eventsPagination();
    },
    
    //save user 
    saveAddConcept: function(){
        var name = $('#txtAddName').val();
        var descripton = $('#txtAddDescription').val();
        var typeConcept = $('#sltAddTypeConcept').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceConcept.php', 'insertConcept', 
            'idBuilding=' + instanceManagerConcept.id_building + '&nameConcept=' + name + 
                '&description=' + descripton + '&typeConcept=' + typeConcept, 
                        'post', 'instanceManagerConcept.bs_insertConcept', 'instanceManagerConcept.cb_insertConcept', 'instanceManagerConcept.err_insertConcept');
    },
    
    bs_insertConcept: function(){
        instanceManagerConcept.showDialog('processing');
    },
    
    cb_insertConcept: function(data){
        $('#txtAddName').val("");
        $('#txtAddDescription').val("");
        var idType = $('#sltTypeConcept').val();
        instanceManagerConcept.getDataConcepts(idType);
        instanceManagerConcept.hideDialog('dlg-addConcept');
        instanceManagerConcept.hideDialog('processing');
    },
    
    err_insertConcept: function(){
        instanceManagerConcept.hideDialog('processing');
    },
    
    //edit concept
    createDialogEditConcept: function(idConcept){
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceConcept.php', 'getConceptById', 'idConcept=' + idConcept, 'post', 'instanceManagerConcept.bs_getDataEditConcept', 'instanceManagerConcept.cb_getDataEditConcept', 'instanceManagerConcept.err_getDataEditConcept');
    },
    
    bs_getDataEditConcept: function(){
        instanceManagerConcept.showDialog('processing');
    },
    
    cb_getDataEditConcept: function(data){
        var info = data.result;
        $('#btn-saveEditConcept').attr('id-concept-button-edit', info.id_concept);
        $('#txtEditName').val(info.name_concept);
        $('#txtEditDescription').val(info.description);
        instanceManagerConcept.showDialog('dlg-editConcept')
        instanceManagerConcept.hideDialog('processing');
    },
    
    err_getDataEditConcept: function(){   
        instanceManagerConcept.hideDialog('processing');
    },
    
    saveEditConcept: function(idConcept){
        var nameConcept = $('#txtEditName').val();
        var desciptionConcept = $('#txtEditDescription').val();
        callService(true, _SERVER_MIDDLE_END_+'services/ServiceConcept.php', 'updateConcept', 'idConcept=' + idConcept + '&nameConcept=' + nameConcept + '&description=' + desciptionConcept, 'post', 'instanceManagerConcept.bs_saveEditConcept', 'instanceManagerConcept.cb_saveEditConcept', 'instanceManagerConcept.err_saveEditConcept');
    },
    
    bs_saveEditConcept: function(){
        instanceManagerConcept.showDialog('processing');
    },
    
    cb_saveEditConcept: function(data){
        var idType = $('#sltTypeConcept').val();
        instanceManagerConcept.getDataConcepts(idType);
        instanceManagerConcept.hideDialog('dlg-editConcept');
        instanceManagerConcept.hideDialog('processing');
    },
    
    err_saveEditConcept: function(){
        instanceManagerConcept.hideDialog('processing');
    }
    
};


//main!
$(function(){
   initManagerConcept();
});

    var instanceManagerConcept = null;
    
    function initManagerConcept(){
        //if(objectClassSession.validateSession()){
            //var id = objectClassSession.getSessionID();
            var idUserProfile = 1;
            var idBuilding = 1;
            loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
            instanceManagerConcept = new classManagerConcept(idUserProfile, idBuilding);
            instanceManagerConcept.init();
        //}
    }