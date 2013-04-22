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
include_once getcwd().'/../model/ModelOwner.php';
include_once getcwd().'/../model/Boolean.php';

$ServiceOwner = new ServiceOwner();
jsonRPCServer::handle($ServiceOwner) or print 'no request';

class ServiceOwner {
    
    private $modelOwner;

    public function __construct() {
        $this->modelOwner = new ModelOwner();
    }
    
    public function deleteOwner($idOffice, $idUserProfile){
        return $this->modelOwner->deleteOwner($idOffice, $idUserProfile);
    }
    
}

?>
