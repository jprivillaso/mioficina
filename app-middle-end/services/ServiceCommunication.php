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
include_once getcwd() .'/../model/ModelCommunication.php';

if (isset($_REQUEST)) {
    $serviceCommunication = new ServiceCommunication();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceCommunication->run();
    } else if ($nameService == 'getCommunicationType') {
        @$idBuilding = $_REQUEST['idBuilding'];
        $serviceCommunication->getCommunicationType($idBuilding);
    } else if($nameService == 'insertCommunication'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idUser = $_REQUEST['idUser'];
        @$idTypeCommunication = $_REQUEST['idTypeCommunication'];
        @$subject = $_REQUEST['subject'];
        @$data = $_REQUEST['data'];
        @$listAddresses = $_REQUEST['listAddresses'];
        $serviceCommunication->insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, urldecode($data), $listAddresses);
    }else if($nameService == 'getPathFolderFiles'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idTypeCommunication = $_REQUEST['idTypeCommunication'];
        $serviceCommunication->getPathFolderFiles($idBuilding, $idTypeCommunication);
    }
    /*}else if($nameService == 'getConceptById'){
        @$idConcept = $_REQUEST['idConcept'];
        $serviceConcept->getConceptById($idConcept);
    } else if($nameService == 'insertConcept'){
        @$nameConcept = $_REQUEST['nameConcept'];
        @$idBuilding = $_REQUEST['idBuilding'];
        @$typeConcept = $_REQUEST['typeConcept'];
        @$description = $_REQUEST['description'];
        $serviceConcept->insertConcept($nameConcept, $idBuilding, $typeConcept, $description);
    }else if($nameService == 'updateConcept'){
        @$idConcept = $_REQUEST['idConcept'];
        @$nameConcept = $_REQUEST['nameConcept'];
        @$description = $_REQUEST['description'];
        $serviceConcept->updateConcept($idConcept, $nameConcept, $description);
    }*/
}

class ServiceCommunication {

    private $modelCommunication;

    public function __construct() {
        $this->modelCommunication = new ModelCommunication();
    }

    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS Communication'));
    }

    public function getCommunicationType($idBuilding) {
        echo json_encode($this->modelCommunication->getCommunicationType($idBuilding));
    }
    
    public function insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $listAddresses){
        echo json_encode($this->modelCommunication->insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $listAddresses));
    }
    
    public function getPathFolderFiles($idBuilding, $idTypeCommunication){
        echo json_encode($this->modelCommunication->getPathFolderFiles($idBuilding, $idTypeCommunication));
    }
    
    /*
    public function getConceptById($idConcept){
        echo json_encode($this->modelConcept->getConceptById($idConcept));
    }
    
    public function insertConcept($nameConcept, $idBuilding, $typeConcept, $description){
        echo json_encode($this->modelConcept->insertConcept($nameConcept, $idBuilding, $typeConcept, $description));
    }
    
    public function updateConcept($idConcept, $nameConcept, $description){
        echo json_encode($this->modelConcept->updateConcept($idConcept, $nameConcept, $description));
    }*/
    
}

?>
