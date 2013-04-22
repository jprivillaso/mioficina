<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceExpenditure
 *
 * @author MiOficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCServer.php';
include_once getcwd().'/../model/ModelExpenditure.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceExpenditure = new ServiceExpenditure();
jsonRPCServer::handle($ServiceExpenditure) or print 'no request';

class ServiceExpenditure {
    
    private $modelExpenditure;
    
    public function __construct() {
        $this->modelExpenditure = new ModelExpenditure();
    }
    
    public function getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage){
        return $this->modelExpenditure->getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage);
    }
    
    public function getExpenditureById($idExpenditure){
        return $this->modelExpenditure->getExpenditureById($idExpenditure);
    }
    
    public function insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
        return $this->modelExpenditure->insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description);
    }
    
    public function updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
        return $this->modelExpenditure->updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description);
    }
    
    public function deleteExpenditure($idExpenditure){
        return $this->modelExpenditure->deleteExpenditure($idExpenditure);
    }
    
}

?>
