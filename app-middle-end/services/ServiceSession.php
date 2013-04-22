<?php

/**
 * Description of ServiceSession
 *
 * @author MiOffice.co
 */

include_once getcwd().'/../model/ModelSession.php';
header ('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');

session_start();

/**
 * Verify the Name Service and calls the respective method
 */
if (isset($_REQUEST)) {
    $serviceSession = new ServiceSession();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceSession->run();
    }else if($nameService == 'createSession'){
        @$idUserProfile = $_REQUEST['idUserProfile'];
        @$idBuilding = $_REQUEST['idBuilding'];
        @$typeUser = $_REQUEST['idTypeUser'];
        $serviceSession->createSession($idUserProfile, $idBuilding, $typeUser);
    }else if($nameService == 'validateSession'){
        $serviceSession->validateSession();
    }else if($nameService == 'destroySession'){
        $serviceSession->destroySession();
    }
}

class ServiceSession {
    
    private $modelSession;

    /**
     * Constructor
     */
    public function __construct() {
        $this->modelSession = new ModelSession();
    }
    
    public function run(){
        echo json_encode(array('Status' => 'Running Rest WS Login'));
    }
    
    function createSession($idUserProfile, $idBuilding, $typeUser){
        echo json_encode($this->modelSession->createSession($idUserProfile, $idBuilding, $typeUser));
    }

    public function validateSession(){
        echo json_encode($this->modelSession->validateSession());
    }
    
    public function destroySession(){
        //
    }
    
}

?>
