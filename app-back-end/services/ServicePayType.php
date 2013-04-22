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
include_once getcwd().'/../model/ModelPayType.php';
include_once getcwd().'/../model/Boolean.php';

$ServicePayType = new ServicePayType();
jsonRPCServer::handle($ServicePayType) or print 'no request';

class ServicePayType {
    
    private $modelPayType;

    public function __construct() {
        $this->modelPayType = new ModelPayType();
    }
    
    public function getPayType($idBuilding) {
        return $this->modelPayType->getPayType($idBuilding);
    }
    
    public function insertPayType($namePayType, $idBuilding){
        return $this->modelPayType->insertPayType($namePayType, $idBuilding);
    }
    
    public function updatePayType($idPayType, $namePayType){
        return $this->modelPayType->updatePayType($idPayType, $namePayType);
    }
    
}

?>
