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
include_once getcwd().'/../model/ModelSupplier.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceSupplier = new ServiceSupplier();
jsonRPCServer::handle($ServiceSupplier) or print 'no request';

class ServiceSupplier {
    
    private $modelSupplier;

    public function __construct() {
        $this->modelSupplier = new ModelSupplier();
    }
    
    public function getSupplierByBuilding($idBuilding, $numPage, $sizePage){
        return $this->modelSupplier->getSupplierByBuilding($idBuilding, $numPage, $sizePage);
    }
    
    public function getSupplierById($idSupplier){
        return $this->modelSupplier->getSupplierById($idSupplier);
    }
    
    public function insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        return $this->modelSupplier->insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier);
    }
    
    public function updateSupplier($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        return $this->modelSupplier->updateSupplier($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier);
    }
    
}

?>
