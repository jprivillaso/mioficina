<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelProperty
 *
 * @author Mioficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCClient.php';
include_once getcwd().'/../net/PathBackEnd/PathBackEnd.php';

class ModelPayType {
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServicePayType.php');
    }
    
    public function getPayType($idBuilding) {
        if(isset($idBuilding)){ 
            $response = $this->serviceBackEnd->getPayType($idBuilding);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function insertPayType($namePayType, $idBuilding){
        if(isset($idBuilding) && isset($namePayType)){ 
            $response = $this->serviceBackEnd->insertPayType($namePayType, $idBuilding);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function updatePayType($idPayType, $namePayType){
        if(isset($idPayType) && isset($namePayType)){ 
            $response = $this->serviceBackEnd->updatePayType($idPayType, $namePayType);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }

}

?>
