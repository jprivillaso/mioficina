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
include_once getcwd() .'/../model/ModelIncome.php';

if (isset($_REQUEST)) {
    $serviceIncome = new ServiceIncome();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceIncome->run();
    } else if ($nameService == 'getAllIncomes') {
        @$idBuilding = $_REQUEST['idBuilding'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        @$dateIni = $_REQUEST['dateIni'];
        @$dateFin = $_REQUEST['dateFin'];
        @$idConcept = $_REQUEST['idConcept'];
        $serviceIncome->getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage);
    } else if($nameService == 'getAllIncomesOffices'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        $serviceIncome->getAllIncomesOffices($idBuilding, $numPage, $sizePage);
    } else if($nameService == 'getIncomesByOffice'){
        @$idOffice = $_REQUEST['idOffice'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        $serviceIncome->getIncomesByOffice($idOffice, $numPage, $sizePage);
    } else if($nameService == 'getIncomeById'){
        @$idIncome = $_REQUEST['idIncome'];
        $serviceIncome->getIncomeById($idIncome);
    } else if($nameService == 'insertIncomeByAdmon'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idInnvoice = $_REQUEST['idInnvoice'];
        @$dateIncome = $_REQUEST['dateIncome'];
        @$value = $_REQUEST['value'];
        @$payType = $_REQUEST['payType'];
        @$from = $_REQUEST['from'];
        @$description = $_REQUEST['description'];
        $serviceIncome->insertIncomeByAdmon($idBuilding, $idInnvoice, $dateIncome, $value, $payType, $from, $description);
    } else if($nameService == 'insertIncomeGeneral'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idConcept = $_REQUEST['idConcept'];
        @$dateIncome = $_REQUEST['dateIncome'];
        @$value = $_REQUEST['value'];
        @$payType = $_REQUEST['payType'];
        @$from = $_REQUEST['from'];
        @$description = $_REQUEST['description'];
        $serviceIncome->insertIncomeGeneral($idBuilding, $idConcept, $dateIncome, $value, $payType, $from, $description);
    } else if($nameService == 'updateIncome'){
        @$idIncome = $_REQUEST['idIncome'];
        @$idConcept = $_REQUEST['idConcept'];
        @$idInnvoice = $_REQUEST['idInnvoice'];
        @$dateIncome = $_REQUEST['dateIncome'];
        @$value = $_REQUEST['value'];
        @$payType = $_REQUEST['payType'];
        @$from = $_REQUEST['from'];
        @$description = $_REQUEST['description'];
        $serviceIncome->updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description);
    } else if($nameService == 'deleteIncome'){
        @$idIncome = $_REQUEST['idIncome'];
        $serviceIncome->deleteIncome($idIncome);
    }
}

class ServiceIncome {

    private $modelIncome;

    public function __construct() {
        $this->modelIncome = new ModelIncome();
    }

    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS Income'));
    }
    
    public function getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage){
        echo json_encode($this->modelIncome->getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage));
    }
    
    public function getAllIncomesOffices($idBuilding, $numPage, $sizePage){
        echo json_encode($this->modelIncome->getAllIncomesOffices($idBuilding, $numPage, $sizePage));
    }
    
    public function getIncomesByOffice($idOffice, $numPage, $sizePage){
        echo json_encode($this->modelIncome->getIncomesByOffice($idOffice, $numPage, $sizePage));
    }
    
    public function getIncomeById($idIncome){
        echo json_encode($this->modelIncome->getIncomeById($idIncome));
    }
    
    public function insertIncomeByAdmon($idBuilding, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        echo json_encode($this->modelIncome->insertIncomeByAdmon($idBuilding, $idInnvoice, $dateIncome, $value, $payType, $from, $description));
    }
        
    public function insertIncomeGeneral($idBuilding, $idConcept, $dateIncome, $value, $payType, $from, $description){
        echo json_encode($this->modelIncome->insertIncomeGeneral($idBuilding, $idConcept, $dateIncome, $value, $payType, $from, $description));
    }
    
    public function updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        echo json_encode($this->modelIncome->updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description));
    }
    
    public function deleteIncome($idIncome){
        echo json_encode($this->modelIncome->deleteIncome($idIncome));
    }
    
}

?>
