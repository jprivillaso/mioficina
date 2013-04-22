<?php

/**
 * Description of ServiceConfigProfile
 *
 * @author MiUnidad.com
 */
header ('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd().'/../model/ModelConfigProfile.php';

if (isset($_REQUEST)) {
    $serviceSession = new ServiceConfigProfile();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceSession->run();
    }else if($nameService == 'getModules'){
        $serviceSession->getModules();
    }else if($nameService == 'getServices'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idUserType = $_REQUEST['idUserType'];
        $serviceSession->getServicesForUser($idBuilding, $idUserType);
    }
}

class ServiceConfigProfile {
    
    private $modelConfigProfile;
    
    public function __construct() {
        $this->modelConfigProfile = new ModelConfigProfile();
    }
    
    public function run(){
        echo json_encode( array('Status' => 'Running Rest WS Login') );
    }
    
    public function getModules(){
        echo json_encode( $this->modelConfigProfile->getModules() );
    }
    
    public function getServicesForUser($idBuilding, $idUserType){
        echo json_encode( $this->modelConfigProfile->getServicesForUser($idBuilding, $idUserType));
    }
    
}