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

class ModelOwner {
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceOwner.php');
    }
    
    public function deleteOwner($idOffice, $idUserProfile){
        $statusParam = false;
        $msg = 'Error with parameters';
        if(isset($idOffice) && isset($idUserProfile)){ 
            $statusParam = true;
            $response = $this->serviceBackEnd->deleteOwner($idOffice, $idUserProfile);
            $msg = 'OK';
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg);
        }
        return array('statusParam' => $statusParam, 'msg' => $msg);
    }

}

?>
