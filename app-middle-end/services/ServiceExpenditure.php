<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceExpedinture
 *
 * @author MiOficina.co
 */

header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd() .'/../model/ModelExpenditure.php';
    

 if (isset($_REQUEST)) {
    $serviceExpenditure = new ServiceExpenditure();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceExpenditure->run();
    } else if ($nameService == 'getAllExpenditures') {
        @$idBuilding = $_REQUEST['idBuilding'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        @$dateIni = $_REQUEST['dateIni'];
        @$dateFin = $_REQUEST['dateFin'];
        @$idConcept = $_REQUEST['idConcept'];
        $serviceExpenditure->getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage);
    }else if($nameService == 'getExpenditureById'){
       @$idExpenditure = $_REQUEST['idExpenditure'];
       $serviceExpenditure->getExpenditureById($idExpenditure);
    } else if($nameService == 'insertExpenditure'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idConcept = $_REQUEST['idConcept'];
        @$value = $_REQUEST['value'];
        @$voucher = $_REQUEST['voucher'];
        @$idPayType = $_REQUEST['idPayType'];
        @$idSupplier = $_REQUEST['idSupplier'];
        @$dateExpenditure = $_REQUEST['dateExpenditure'];
        @$description = $_REQUEST['description'];
        $serviceExpenditure->insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description);
    } else if($nameService == 'updateExpenditure'){
        @$idExpenditure = $_REQUEST['idExpenditure'];
        @$idConcept = $_REQUEST['idConcept'];
        @$value = $_REQUEST['value'];
        @$voucher = $_REQUEST['voucher'];
        @$idPayType = $_REQUEST['idPayType'];
        @$idSupplier = $_REQUEST['idSupplier'];
        @$dateExpenditure = $_REQUEST['dateExpenditure'];
        @$description = $_REQUEST['description'];
        $serviceExpenditure->updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description);
    } else if($nameService == 'deleteExpenditure'){
        @$idExpenditure = $_REQUEST['idExpenditure'];
        $serviceExpenditure->deleteExpenditure($idExpenditure);
    }
    
}

class ServiceExpenditure {
   
    private $modelExpenditure;
    
    public function __construct() {
        $this->modelExpenditure = new ModelExpenditure();
    } 
    
    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS Expenditure'));
    }
    
    public function getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage){
        echo json_encode($this->modelExpenditure->getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage));
    }
      
    public function getExpenditureById($idExpenditure){
        echo json_encode($this->modelExpenditure->getExpenditureById($idExpenditure));
    }
    
    public function insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
        echo json_encode($this->modelExpenditure->insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description));
    }
    
    public function updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
        echo json_encode($this->modelExpenditure->updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description));
    }
    
    public function deleteExpenditure($idExpenditure){
        echo json_encode($this->modelExpenditure->deleteExpenditure($idExpenditure));
    }
    
}

?>
