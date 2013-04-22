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
include_once getcwd().'/../model/ModelOffice.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceOffice = new ServiceOffice();
jsonRPCServer::handle($ServiceOffice) or print 'no request';

class ServiceOffice {
    
    private $modelOffice;

    public function __construct() {
        $this->modelOffice = new ModelOffice();
    }

    public function getOfficesByBuilding($idBuilding, $numPage, $sizePage){
        return $this->modelOffice->getOfficesByBuilding($idBuilding, $numPage, $sizePage);
    }
    
    
    public function getDataOffice($idOffice){
        return $this->modelOffice->getDataOffice($idOffice);
    }
    
    
    public function getUserByOffice($idOffice, $idTypeUser){        
        return $this->modelOffice->getUserByOffice($idOffice, $idTypeUser);       
    }
    
    public function getOfficeByUser($idUserProfile){
        return $this->modelOffice->getOfficeByUser($idUserProfile);
    }
    
    public function updateOffice($idOffice, $description, $isOccupied,
            $dimensions, $phone, $officeNumber){
        return $this->modelOffice->updateOffice($idOffice, $description, $isOccupied,
            $dimensions, $phone, $officeNumber);
    }
    
    public function insertOffice($idBuilding, $description, $isOccupied,
            $dimensions, $phone,$officeNumber){
        return $this->modelOffice->insertOffice($idBuilding, $description, $isOccupied,
            $dimensions, $phone, $officeNumber);
    }
    
    public function deleteOffice($idOffice){
        return $this->modelOffice->deleteOffice($idOffice);
    }
    
}

?>
