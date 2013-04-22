<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelIncome
 *
 * @author Mioficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCClient.php';
include_once getcwd().'/../net/PathBackEnd/PathBackEnd.php';

class ModelIncome {
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceIncome.php');
    }
    
    public function getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage){
        if(isset($idBuilding)){ 
            $response = $this->serviceBackEnd->getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function getAllIncomesOffices($idBuilding, $numPage, $sizePage){
        if(isset($idBuilding)){ 
            $response = $this->serviceBackEnd->getAllIncomesOffices($idBuilding, $numPage, $sizePage);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function getIncomesByOffice($idOffice, $numPage, $sizePage){
        if(isset($idOffice)){ 
            $response = $this->serviceBackEnd->getIncomesByOffice($idOffice, $numPage, $sizePage);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function getIncomeById($idIncome){
        if(isset($idIncome)){ 
            $response = $this->serviceBackEnd->getIncomeById($idIncome);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function insertIncomeByAdmon($idBuilding, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        if(isset($idBuilding) && isset($idInnvoice) && isset($dateIncome) && isset($value) && isset($payType) && isset($from) && isset($description)){ 
            $response = $this->serviceBackEnd->insertIncomeByAdmon($idBuilding, $idInnvoice, $dateIncome, $value, $payType, $from, $description);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
        
    public function insertIncomeGeneral($idBuilding, $idConcept, $dateIncome, $value, $payType, $from, $description){
        if(isset($idBuilding) && isset($idConcept) && isset($dateIncome) && isset($value) && isset($payType) && isset($from) && isset($description)){ 
            $response = $this->serviceBackEnd->insertIncomeGeneral($idBuilding, $idConcept, $dateIncome, $value, $payType, $from, $description);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        if(isset($idIncome) && isset($idConcept) && isset($idInnvoice) && isset($dateIncome) && isset($value) && isset($payType) && isset($from) && isset($description)){ 
            $response = $this->serviceBackEnd->updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function deleteIncome($idIncome){
        if(isset($idIncome)){ 
            $response = $this->serviceBackEnd->deleteIncome($idIncome);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
}

?>
