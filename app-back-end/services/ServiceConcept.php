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
include_once getcwd().'/../model/ModelConcept.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceConcept = new ServiceConcept();
jsonRPCServer::handle($ServiceConcept) or print 'no request';

class ServiceConcept {
    
    private $modelConcept;

    public function __construct() {
        $this->modelConcept = new ModelConcept();
    }
    
    public function getConceptsByType($idBuilding, $typeConcept, $numPage, $sizePage){
        return $this->modelConcept->getConceptsByType($idBuilding, $typeConcept, $numPage, $sizePage);
    }
    
    public function getConceptById($idConcept){
        return $this->modelConcept->getConceptById($idConcept);
    }
    
    public function insertConcept($nameConcept, $idBuilding, $typeConcept, $description){
        return $this->modelConcept->insertConcept($nameConcept, $idBuilding, $typeConcept, $description);
    }
    
    public function updateConcept($idConcept, $nameConcept, $description){
        return $this->modelConcept->updateConcept($idConcept, $nameConcept, $description);
    }
    
}

?>
