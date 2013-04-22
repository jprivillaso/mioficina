/* 
 * class for manager session user id
 */

var classSession = function(){ 
    this.GLOBAL_ID_USER = null;
    this.GLOBAL_ID_BUILDING = null;
    this.GLOBAL_TYPE_USER = null;
    this._IS_SESSION_ = false;
};

classSession.prototype = {
    
    validateSession: function (){
        var data = r_callService(false,_SERVER_MIDDLE_END_+'services/ServiceSession.php', 'validateSession','', 'post', 'bs_validateSession');
        if(data.session){
            this.setGlobalId(data.session, data.idUser, data.idBuilding, data.idTypeUser);
        }else{
            redirect('http://mioficina.co/login.html');
        }
        return data.session;
    },
    
    setGlobalId: function(isSession, idUser, idBuilding, idTypeUser){
        objectClassSession.GLOBAL_ID_USER = idUser;
        objectClassSession.GLOBAL_ID_BUILDING = idBuilding;
        objectClassSession.GLOBAL_TYPE_USER = idTypeUser;
        objectClassSession._IS_SESSION_ = isSession;
    },
    
    getSessionIDUser: function(){
        return objectClassSession.GLOBAL_ID_USER;
    },
    
    getSessionIDBulding: function(){
        return objectClassSession.GLOBAL_ID_BUILDING;
    },
    
    getSessionIDTypeUser: function(){
        return objectClassSession.GLOBAL_TYPE_USER;
    },
    
    isSession: function(){
        return objectClassSession._IS_SESSION_;
    }
};
    
    var objectClassSession = new classSession();
    
    function bs_validateSession(){  }
