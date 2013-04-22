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
include_once getcwd() .'/../model/ModelConcept.php';

if (isset($_REQUEST)) {
    $serviceConcept = new ServiceConcept();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceConcept->run();
    } else if ($nameService == 'getConceptsByType') {
        @$idBuilding = $_REQUEST['idBuilding'];
        @$typeConcept = $_REQUEST['typeConcept'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        $serviceConcept->getConceptsByType($idBuilding, $typeConcept, $numPage, $sizePage);
    }else if($nameService == 'getConceptById'){
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
    }
}

class ServiceConcept {

    private $modelConcept;

    public function __construct() {
        $this->modelConcept = new ModelConcept();
    }

    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS Concept'));
    }

    public function getConceptsByType($idBuilding, $typeConcept, $numPage, $sizePage) {
        echo json_encode($this->modelConcept->getConceptsByType($idBuilding, $typeConcept, $numPage, $sizePage));
    }
    
    public function getConceptById($idConcept){
        echo json_encode($this->modelConcept->getConceptById($idConcept));
    }
    
    public function insertConcept($nameConcept, $idBuilding, $typeConcept, $description){
        echo json_encode($this->modelConcept->insertConcept($nameConcept, $idBuilding, $typeConcept, $description));
    }
    
    public function updateConcept($idConcept, $nameConcept, $description){
        echo json_encode($this->modelConcept->updateConcept($idConcept, $nameConcept, $description));
    }
    
}

?>
