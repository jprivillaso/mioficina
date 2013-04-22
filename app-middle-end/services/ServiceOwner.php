<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceProperty
 *
 * @author mioficina.co
 */
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd() .'/../model/ModelOwner.php';

if (isset($_REQUEST)) {
    $serviceOwner = new ServiceOwner();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceOwner->run();
    } else if ($nameService == 'deteleOwner') {
        @$idOffice = $_REQUEST['idOffice'];
        @$idUserProfile = $_REQUEST['idUserProfile'];
        $serviceOwner->deleteOwner($idOffice, $idUserProfile);
    }
}

class ServiceOwner {

    private $modelOwner;

    public function __construct() {
        $this->modelOwner = new ModelOwner();
    }

    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS Owner'));
    }

    public function deleteOwner($idOffice, $idUserProfile) {
        echo json_encode($this->modelOwner->deleteOwner($idOffice, $idUserProfile));
    }

}

?>
