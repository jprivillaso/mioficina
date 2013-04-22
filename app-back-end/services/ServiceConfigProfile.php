<?php

/**
 * Description of ServiceConfigProfile
 * Methods related to the Service Config Profile
 * @author miunidad.com
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCServer.php';
include_once getcwd().'/../model/ModelConfigProfile.php';
include_once getcwd().'/../model/Boolean.php';


$ServiceConfigProfile = new ServiceConfigProfile();
jsonRPCServer::handle($ServiceConfigProfile) or print 'no request';

class ServiceConfigProfile {
    
    private $modelConfigProfile;

    /**
     * Constructor
     */
    public function __construct() {
        $this->modelConfigProfile = new ModelConfigProfile();
    }

    /**
     * Method that calls getModules method of the ModelConfigProfile class
     * @return array
     */
    public function getModules(){
        return $this->modelConfigProfile->getModules();
    }

    /**
     * Method that calls getServicesForUser method of the class
     * ModelConfigProfile class
     * @param type $idUser
     * @return array
     */
    public function getServicesForUser($idBuilding, $idUserType){
        return $this->modelConfigProfile->getServicesForUser($idBuilding, $idUserType);
    }
    
}

?>