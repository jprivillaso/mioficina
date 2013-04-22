<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelAccountant
 *
 * @author Mioficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCClient.php';
include_once getcwd().'/../net/PathBackEnd/PathBackEnd.php';

class ModelAccountant {
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceAccountant.php');
    }
    
    
    public function getBuildingAccountant($idBuilding) {
        if(isset($idBuilding)){ 
            $response = $this->serviceBackEnd->getBuildingAccountant($idBuilding);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed){
        if(isset($idBuilding) && isset($interestRate) && isset($periodsElapsed) ){ 
            $response = $this->serviceBackEnd->updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function getOfficesAccountant($idBuilding, $numPage, $sizePage){
        if(isset($idBuilding)){ 
            $response = $this->serviceBackEnd->getOfficesAccountant($idBuilding, $numPage, $sizePage);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function getAccountantByIdOffice($idOffice){
        if(isset($idOffice)){ 
            $response = $this->serviceBackEnd->getAccountantByIdOffice($idOffice);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function updateOfficesAccountant($value, $idOffices){
        if(isset($idOffices) && isset($value)){ 
            $response = $this->serviceBackEnd->updateOfficesAccountant($value, $idOffices);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
}

?>
