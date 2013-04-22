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
include_once getcwd().'/../model/ModelCommunication.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceCommunication = new ServiceCommunication();
jsonRPCServer::handle($ServiceCommunication) or print 'no request';

class ServiceCommunication {
    
    private $modelCommunication;

    public function __construct() {
        $this->modelCommunication = new ModelCommunication();
    }
    
    public function getCommunicationType($idBuilding){
        return $this->modelCommunication->getCommunicationType($idBuilding);
    }
    
    public function insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $listAddresses){
        return $this->modelCommunication->insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $listAddresses);
    }
    
    public function getPathFolderFiles($idBuilding, $typeCommunication){
        return $this->modelCommunication->getPathFolderFiles($idBuilding, $typeCommunication);
    }
    
    public function insertFile($idCommunication, $name, $path){
        return $this->modelCommunication->insertFile($idCommunication, $name, $path);
    }
    
}

?>
