<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author miofina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCClient.php';
include_once getcwd().'/../net/PathBackEnd/PathBackEnd.php';

class ModelConfigProfile {
    
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceConfigProfile.php');
    }
    
    public function getModules(){        
        $responseModules = $this->serviceBackEnd->getModules();
        return $responseModules;
    }
    
    public function getServicesForUser($idBuilding, $idUserType){
        if(isset($idBuilding) && isset($idUserType)){
            $responseServices = $this->serviceBackEnd->getServicesForUser($idBuilding, $idUserType);
            return $responseServices;
        }
        return array('idUser' => 'null');
    }
    
}

?>
