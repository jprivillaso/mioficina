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

class ModelOffice {
    
    private $serviceBackEnd;
    
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceOffice.php');
    }
    
    public function getOfficesByBuilding($idBuilding, $numPage, $sizePage){
        $statusParam = false;
        $msg = 'Error with Parameters';
        if(isset($idBuilding) && isset($numPage) && isset($sizePage)){
            $statusParam = true;
            $msg = 'OK';
            $response = $this->serviceBackEnd->getOfficesByBuilding($idBuilding, $numPage, $sizePage);
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg );
        }
        return array('statusParam' => $statusParam, 'msg' => $msg);
    }
    
    public function getDataOffice($idOffice){
        $statusParam = false;
        $msg = 'Error with Parameters';
        if(isset($idOffice)){
            $statusParam = true;
            $msg = 'OK';
            $response = $this->serviceBackEnd->getDataOffice($idOffice);
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg);
        }
        return array('statusParam' => $statusParam, 'msg' => $msg);
    }
       
    public function getUserByOffice($idOffice, $idTypeUser){        
        $statusParam = false;
        $msg = 'Error with Parameters';
        if(isset($idOffice)){
            $statusParam = true;
            $response = $this->serviceBackEnd->getUserByOffice($idOffice, $idTypeUser);
            $msg = 'OK';
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg);
        }
        return array('statusParam' => $statusParam, 'msg' => $msg );
    }
    
    public function getOfficeByUser($idUserProfile){
        $statusParam = false;
        $msg = 'Error with Parameters';
        if(isset($idUserProfile)){
            $statusParam = true;
            $response = $this->serviceBackEnd->getOfficeByUser($idUserProfile);
            $msg = 'OK';
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg);
        }
        return array('statusParam' => $statusParam, 'msg' => $msg );
    }

    public function insertOffice($idBuilding, $description, $isOccupied,
            $dimensions, $phone,$officeNumber){
        $statusParam = false;
        $msg = 'Error with Parameters';
        if(isset($idBuilding) && isset($isOccupied) && isset($dimensions) && isset($officeNumber)){
            $statusParam = true;
            $response = $this->serviceBackEnd->insertOffice($idBuilding, $description, $isOccupied,
                    $dimensions, $phone, $officeNumber);
            $msg = 'OK';
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg);
        }
        return array('statusParam' => $statusParam, 'msg' => $msg );
    }
    
    public function updateOffice($idOffice, $description, $isOccupied,
            $dimensions, $phone, $officeNumber){
        
        $statusParam = false;
        $msg = 'Error with Parameters';
        
        if( isset($idOffice) && isset($isOccupied) &&
                isset($dimensions) && isset($officeNumber) 
                    &&  isset($description) &&  isset($phone)){
            $statusParam = true;
            $response = $this->serviceBackEnd->updateOffice($idOffice, $description, $isOccupied,
            $dimensions, $phone, $officeNumber);
            $msg = 'OK';
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg);
        }
        return array('statusParam' => $statusParam, 'msg' => $msg );
    }
    
    public function deleteOffice($idOffice){
        
        $statusParam = false;
        $msg = 'Error with parameters';
        
        if(isset($idOffice)){ 
            $statusParam = true;
            $response = $this->serviceBackEnd->deleteOffice($idOffice);
            $msg = 'OK';
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg);
        }
        return array('statusParam' => $statusParam, 'msg' => $msg );
    }

}

?>
