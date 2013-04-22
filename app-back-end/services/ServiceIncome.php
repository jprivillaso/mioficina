<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceProperty
 *
 * @author Mioficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCServer.php';
include_once getcwd().'/../model/ModelIncome.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceIncome = new ServiceIncome();
jsonRPCServer::handle($ServiceIncome) or print 'no request';

class ServiceIncome {
    
    private $modelIncome;

    public function __construct() {
        $this->modelIncome = new ModelIncome();
    }
    
    public function getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage){
        return $this->modelIncome->getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage);
    }
    
    public function getAllIncomesOffices($idBuilding, $numPage, $sizePage){
        return $this->modelIncome->getAllIncomesOffices($idBuilding, $numPage, $sizePage);
    }
    
    public function getIncomesByOffice($idOffice, $numPage, $sizePage){
        return $this->modelIncome->getIncomesByOffice($idOffice, $numPage, $sizePage);
    }
    
    public function getIncomeById($idIncome){
        return $this->modelIncome->getIncomeById($idIncome);
    }
    
    public function insertIncomeByAdmon($idBuilding, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        return $this->modelIncome->insertIncomeByAdmon($idBuilding, $idInnvoice, $dateIncome, $value, $payType, $from, $description);
    }
        
    public function insertIncomeGeneral($idBuilding, $idConcept, $dateIncome, $value, $payType, $from, $description){
        return $this->modelIncome->insertIncomeGeneral($idBuilding, $idConcept, $dateIncome, $value, $payType, $from, $description);
    }
    
    public function updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        return $this->modelIncome->updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description);
    }
    
    public function deleteIncome($idIncome){
        return $this->modelIncome->deleteIncome($idIncome);
    }
    
}

?>
