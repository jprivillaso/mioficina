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

class ModelCommunication {
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceCommunication.php');
    }
    
    public function getCommunicationType($idBuilding){
        if(isset($idBuilding)){ 
            $response = $this->serviceBackEnd->getCommunicationType($idBuilding);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $listAddresses){
        if(isset($idBuilding) && isset($idUser) && isset($idTypeCommunication) && isset($subject) && isset($data) && isset($listAddresses) ){ 
            $response = $this->serviceBackEnd->insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $listAddresses);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function getPathFolderFiles($idBuilding, $typeCommunication){
        if(isset($idBuilding) && isset($typeCommunication)){ 
            $response = $this->serviceBackEnd->getPathFolderFiles($idBuilding, $typeCommunication);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function insertFile($idCommunication, $name, $path){
        if(isset($idCommunication) && isset($name) && isset($path)){ 
            $response = $this->serviceBackEnd->insertFile($idCommunication, $name, $path);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }

}

?>
