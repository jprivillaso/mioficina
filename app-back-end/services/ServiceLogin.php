<?php

/**
 * Description of ServiceLogin
 * Methods related to the Service Login
 * @author MiOficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCServer.php';
include_once getcwd().'/../model/ModelLogin.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceLogin = new ServiceLogin();
jsonRPCServer::handle($ServiceLogin) or print 'no request';

class ServiceLogin {
    
    private $modelLogin;

    /**
     * Constructor
     */
    public function __construct() {
        $this->modelLogin = new ModelLogin();
    }

    /**
     * Method that calls the loginIn method of ModelLogin class
     * @param type $buildingNick
     * @param type $userNick
     * @param type $userPassword
     * @return array or false
     */
    public function loginIn($userEmail, $userPassword){
        return $this->modelLogin->loginIn($userEmail, $userPassword);
    }
    
    public function checkAccount($buildingNick, $userNick, $key){
        return $this->modelLogin->checkAccount($buildingNick, $userNick, $key);
    }
    
    public function changePassword($idUser, $key, $previewPassword, $currentPassword){
        return $this->modelLogin->changePassword($idUser, $key, $previewPassword, $currentPassword);
    }
    
}

?>
