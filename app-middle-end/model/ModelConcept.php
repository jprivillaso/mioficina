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

class ModelConcept {
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceConcept.php');
    }
    
    public function getConceptsByType($idBuilding, $typeConcept, $numPage, $sizePage){
        if(isset($idBuilding) && isset($typeConcept)){ 
            $response = $this->serviceBackEnd->getConceptsByType($idBuilding, $typeConcept, $numPage, $sizePage);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function getConceptById($idConcept){
        if(isset($idConcept)){ 
            $response = $this->serviceBackEnd->getConceptById($idConcept);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }

    public function insertConcept($nameConcept, $idBuilding, $typeConcept, $description){
        if(isset($idBuilding) && isset($typeConcept) && isset($nameConcept) && isset($description)){ 
            $response = $this->serviceBackEnd->insertConcept($nameConcept, $idBuilding, $typeConcept, $description);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function updateConcept($idConcept, $nameConcept, $description){
        if(isset($idConcept)  && isset($nameConcept) && isset($description)){ 
            $response = $this->serviceBackEnd->updateConcept($idConcept, $nameConcept, $description);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }

}

?>
