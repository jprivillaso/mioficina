<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceProperty
 *
 * @author mioficina.co
 */
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd() .'/../model/ModelPayType.php';

if (isset($_REQUEST)) {
    $servicePayType = new ServicePayType();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $servicePayType->run();
    } else if ($nameService == 'getPayType') {
        @$idBuilding = $_REQUEST['idBuilding'];
        $servicePayType->getPayType($idBuilding);
    } else if($nameService == 'insertPayType'){
        @$namePayType = $_REQUEST['namePayType'];
        @$idBuilding = $_REQUEST['idBuilding'];
        $servicePayType->insertPayType($namePayType, $idBuilding);
    }else if($nameService == 'updatePayType'){
        @$idPayType = $_REQUEST['idPayType'];
        @$namePayType = $_REQUEST['namePayType'];
        $servicePayType->updatePayType($idPayType, $namePayType);
    }
}

class ServicePayType {

    private $modelPayType;

    public function __construct() {
        $this->modelPayType = new ModelPayType();
    }

    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS PayType'));
    }

    public function getPayType($idBuilding) {
        echo json_encode($this->modelPayType->getPayType($idBuilding));
    }
    
    public function insertPayType($namePayType, $idBuilding){
        echo json_encode($this->modelPayType->insertPayType($namePayType, $idBuilding));
    }
    
    public function updatePayType($idPayType, $namePayType){
        echo json_encode($this->modelPayType->updatePayType($idPayType, $namePayType));
    }
    
}

?>
