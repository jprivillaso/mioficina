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

include_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineOffice.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelOffice{
    
    public function __construct() {}

    public function getOfficesByBuilding($idBuilding, $numPage, $sizePage){
        $rs =  DAOEngineOffice::getOfficesByBuilding($idBuilding, $numPage, $sizePage);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function getDataOffice($idOffice){
        $rs = DAOEngineOffice::getDataOffice($idOffice);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;        
    }
        
    public function getUserByOffice($idOffice, $idTypeUser){
       $rs = DAOEngineOffice::getUserByOffice($idOffice, $idTypeUser);
       if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function getOfficeByUser($idUserProfile){
        $rs = DAOEngineOffice::getOfficeByUser($idUserProfile);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }

    public function updateOffice($idOffice, $description, $isOccupied,
            $dimensions, $phone, $officeNumber){
        $rs = DAOEngineOffice::updateOffice($idOffice, $description, $isOccupied,
            $dimensions, $phone, $officeNumber);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function insertOffice($idBuilding, $description, $isOccupied,$dimensions, $phone, $officeNumber){
        $rs = DAOEngineOffice::insertOffice($idBuilding, $description, $isOccupied,$dimensions, $phone, $officeNumber);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function deleteOffice($idOffice){
        $rs = DAOEngineOffice::deleteOffice($idOffice);
        if($rs != null){
            return _TRUE_;
        }
        return  _FALSE_;
    }
    
}
?>
