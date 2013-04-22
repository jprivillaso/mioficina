<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelSupplier
 *
 * @author Mioficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCClient.php';
include_once getcwd().'/../net/PathBackEnd/PathBackEnd.php';

class ModelSupplier {
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceSupplier.php');
    }
    
    public function getSupplierByBuilding($idBuilding, $numPage, $sizePage){
        if(isset($idBuilding)){ 
            $response = $this->serviceBackEnd->getSupplierByBuilding($idBuilding, $numPage, $sizePage);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function getSupplierById($idSupplier){
        if(isset($idSupplier)){ 
            $response = $this->serviceBackEnd->getSupplierById($idSupplier);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        if(isset($idBuilding) && isset($nameSupplier) && isset($IDSupplier) && isset($nitSupplier) && isset($phoneSupplier) && isset($addressSupplier) && isset($emailSupplier) ){ 
            $response = $this->serviceBackEnd->insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function updateSupplier($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        if(isset($idSupplier) && isset($nameSupplier) && isset($IDSupplier) && isset($nitSupplier) && isset($phoneSupplier) && isset($addressSupplier) && isset($emailSupplier) ){ 
            $response = $this->serviceBackEnd->updateSupplier($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
}

?>
