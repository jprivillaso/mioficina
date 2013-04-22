<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceAccountant
 *
 * @author mioficina.co
 */
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd() .'/../model/ModelAccountant.php';

if (isset($_REQUEST)) {
    $serviceAccountant = new ServiceAccountant();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceAccountant->run();
    } else if ($nameService == 'getBuildingAccountant') {
        @$idBuilding = $_REQUEST['idBuilding'];
        $serviceAccountant->getBuildingAccountant($idBuilding);
    } else if($nameService == 'updateBuildingAccountant'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$interestRate = $_REQUEST['interestRate'];
        @$periodsElapsed = $_REQUEST['periodsElapsed'];
        $serviceAccountant->updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed);
    }else if($nameService == 'getOfficesAccountant'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        $serviceAccountant->getOfficesAccountant($idBuilding, $numPage, $sizePage);
    }else if($nameService == 'getAccountantByIdOffice'){
        @$idOffice = $_REQUEST['idOffice'];
        $serviceAccountant->getAccountantByIdOffice($idOffice);
    }else if($nameService == 'updateOfficesAccountant'){
        @$value = $_REQUEST['value'];
        @$idOffices = $_REQUEST['idOffices'];
        $serviceAccountant->updateOfficesAccountant($value, $idOffices);
    }
}

class ServiceAccountant {

    private $modelAccountant;

    public function __construct() {
        $this->modelAccountant = new ModelAccountant();
    }
    
    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS Accounting'));
    }

    public function getBuildingAccountant($idBuilding) {
        echo json_encode($this->modelAccountant->getBuildingAccountant($idBuilding));
    }
    
    public function updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed){
        echo json_encode($this->modelAccountant->updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed));
    }
    
    public function getOfficesAccountant($idBuilding, $numPage, $sizePage){
        echo json_encode($this->modelAccountant->getOfficesAccountant($idBuilding, $numPage, $sizePage));
    }
    
    public function getAccountantByIdOffice($idOffice){
        echo json_encode($this->modelAccountant->getAccountantByIdOffice($idOffice));
    }
    
    public function updateOfficesAccountant($value, $idOffices){
        echo json_encode($this->modelAccountant->updateOfficesAccountant($value, $idOffices));
    }
    
}

?>