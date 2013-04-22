<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Supplier
 *
 * @author mioficina.co
 */
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd() .'/../model/ModelSupplier.php';

if (isset($_REQUEST)) {
    $serviceSupplier = new ServiceSupplier();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceSupplier->run();
    } else if ($nameService == 'getSupplierByBuilding') {
        @$idBuilding = $_REQUEST['idBuilding'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        $serviceSupplier->getSupplierByBuilding($idBuilding, $numPage, $sizePage);
    }else if($nameService == 'getSupplierById'){
        @$idSupplier = $_REQUEST['idSupplier'];
        $serviceSupplier->getSupplierById($idSupplier);
    } else if($nameService == 'insertSupplier'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$nameSupplier = $_REQUEST['nameSupplier'];
        @$IDSupplier = $_REQUEST['IDSupplier'];
        @$nitSupplier = $_REQUEST['nitSupplier'];
        @$phoneSupplier = $_REQUEST['phoneSupplier'];
        @$addressSupplier = $_REQUEST['addressSupplier'];
        @$emailSupplier = $_REQUEST['emailSupplier'];
        $serviceSupplier->insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier);
    }else if($nameService == 'updateSupplier'){
        @$idSupplier = $_REQUEST['idSupplier'];
        @$nameSupplier = $_REQUEST['nameSupplier'];
        @$IDSupplier = $_REQUEST['IDSupplier'];
        @$nitSupplier = $_REQUEST['nitSupplier'];
        @$phoneSupplier = $_REQUEST['phoneSupplier'];
        @$addressSupplier = $_REQUEST['addressSupplier'];
        @$emailSupplier = $_REQUEST['emailSupplier'];
        $serviceSupplier->updateSupplier($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier);
    }
}

class ServiceSupplier {

    private $modelSupplier;

    public function __construct() {
        $this->modelSupplier = new ModelSupplier();
    }

    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS Supplier'));
    }

    public function getSupplierByBuilding($idBuilding, $numPage, $sizePage){
        echo json_encode($this->modelSupplier->getSupplierByBuilding($idBuilding, $numPage, $sizePage));
    }
    
    public function getSupplierById($idSupplier){
        echo json_encode($this->modelSupplier->getSupplierById($idSupplier));
    }
    
    public function insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        echo json_encode($this->modelSupplier->insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier));
    }
    
    public function updateSupplier($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        echo json_encode($this->modelSupplier->updateSupplier($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier));
    }
    
}

?>
