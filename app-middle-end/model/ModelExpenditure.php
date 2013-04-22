<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelExpenditure
 *
 * @author Mioficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCClient.php';
include_once getcwd().'/../net/PathBackEnd/PathBackEnd.php';

class ModelExpenditure {  
    
    private $serviceBackend;
    
    public function __construct(){
        $this->serviceBackend = new jsonRPCClient(PATH_BACK_END.'services/ServiceExpenditure.php');
    }
    
    public function getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage){
        if(isset($idBuilding)){
            $response = $this->serviceBackend->getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
        
    }
    
    public function getExpenditureById($idExpenditure){
        if(isset($idExpenditure)){
            $response = $this->serviceBackend->getExpenditureById($idExpenditure);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');  
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
       
    public function insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
        if(isset($idBuilding) && isset($idConcept) && isset($value) && isset($voucher) && isset($idPayType) && isset($idSupplier) && isset($dateExpenditure) && isset($description)){
            $response = $this->serviceBackend->insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');        
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
        if(isset($idExpenditure) && isset($idConcept) && isset($value) && isset($voucher) && isset($idPayType) && isset($idSupplier) && isset($dateExpenditure) && isset($description)){
            $response = $this->serviceBackend->updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');        
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function deleteExpenditure($idExpenditure){
        if(isset($idExpenditure)){
            $response = $this->serviceBackend->deleteExpenditure($idExpenditure);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');        
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
}
?>
