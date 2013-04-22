<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceAccountant
 *
 * @author Mioficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCServer.php';
include_once getcwd().'/../model/ModelAccountant.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceAccountant = new ServiceAccountant();
jsonRPCServer::handle($ServiceAccountant) or print 'no request';

class ServiceAccountant {
    
    private $modelAccountant;

    public function __construct() {
        $this->modelAccountant = new ModelAccountant();
    }
    
    public function getBuildingAccountant($idBuilding) {
        return $this->modelAccountant->getBuildingAccountant($idBuilding);
    }
    
    public function updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed){
        return $this->modelAccountant->updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed);
    }
    
    public function getOfficesAccountant($idBuilding, $numPage, $sizePage){
        return $this->modelAccountant->getOfficesAccountant($idBuilding, $numPage, $sizePage);
    }
    
    public function getAccountantByIdOffice($idOffice){
        return $this->modelAccountant->getAccountantByIdOffice($idOffice);
    }
    
    public function updateOfficesAccountant($value, $idOffices){
        return $this->modelAccountant->updateOfficesAccountant($value, $idOffices);
    }
    
}

?>
