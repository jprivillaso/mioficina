<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceProperty
 *
 * @author miunudad.com
 */
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd() . '/../model/ModelOffice.php';

if (isset($_REQUEST)) {
    $serviceOffice = new ServiceOffice();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceOffice->run();
    } else if ($nameService == 'getOfficesByBuilding') {
        @$idBulding = $_REQUEST['idBuilding'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        $serviceOffice->getOfficesByBuilding($idBulding, $numPage, $sizePage);
    } else if ($nameService == 'getDataOffice') {
        @$idOffice = $_REQUEST['idOffice'];
        $serviceOffice->getDataOffice($idOffice);
    } else if ($nameService == 'getUserByOffice') {
        @$idOffice = $_REQUEST['idOffice'];
        @$idTypeUser = $_REQUEST['idTypeUser'];
        $serviceOffice->getUserByOffice($idOffice, $idTypeUser);
    } else if ($nameService == 'getOfficeByUser') {
        @$idUserProfile = $_REQUEST['idUserProfile'];
        $serviceOffice->getOfficeByUser($idUserProfile);
    } else if ($nameService == 'insertOffice') {
        @$idBuilding = $_REQUEST['idBuilding'];
        @$description = $_REQUEST['description'];
        @$isOccupied = $_REQUEST['isOccupied'];
        @$dimensions = $_REQUEST['dimensions'];
        @$phone = $_REQUEST['phone'];
        @$officeNumber = $_REQUEST['officeNumber'];
        $serviceOffice->insertOffice($idBuilding, $description, $isOccupied, $dimensions, $phone, $officeNumber);
    } else if ($nameService == 'updateOffice') {
        @$idOffice = $_REQUEST['idOffice'];
        @$description = $_REQUEST['description'];
        @$isOccupied = $_REQUEST['isOccupied'];
        @$dimensions = $_REQUEST['dimensions'];
        @$phone = $_REQUEST['phone'];
        @$officeNumber = $_REQUEST['officeNumber'];
        $serviceOffice->updateOffice($idOffice, $description, $isOccupied, $dimensions, $phone, $officeNumber);
    } else if ($nameService == 'deleteOffice') {
        @$idOffice = $_REQUEST['idOffice'];
        $serviceOffice->deleteOffice($idOffice);
    }
}

class ServiceOffice {

    private $modelOffice;

    public function __construct() {
        $this->modelOffice = new ModelOffice();
    }

    public function run() {
        echo json_encode(array('Status' => 'Running Rest WS Property'));
    }

    public function getOfficesByBuilding($idBuilding, $numPage, $sizePage) {
        echo json_encode($this->modelOffice->getOfficesByBuilding($idBuilding, $numPage, $sizePage));
    }

    public function getDataOffice($idOffice) {
        echo json_encode($this->modelOffice->getDataOffice($idOffice));
    }

    public function getUserByOffice($idOffice, $idTypeUser) {
        echo json_encode($this->modelOffice->getUserByOffice($idOffice, $idTypeUser));
    }

    public function getOfficeByUser($idUserProfile) {
        echo json_encode($this->modelOffice->getOfficeByUser($idUserProfile));
    }

    public function updateOffice($idOffice, $description, $isOccupied, $dimensions, $phone, $officeNumber) {
        echo json_encode($this->modelOffice->updateOffice($idOffice, $description, $isOccupied, $dimensions, $phone, $officeNumber));
    }

    public function insertOffice($idBuilding, $description, $isOccupied, $dimensions, $phone, $officeNumber) {
        echo json_encode($this->modelOffice->insertOffice($idBuilding, $description, $isOccupied, $dimensions, $phone, $officeNumber));
    }

    public function deleteOffice($idOffice) {
        echo json_encode($this->modelOffice->deleteOffice($idOffice));
    }

}

?>
