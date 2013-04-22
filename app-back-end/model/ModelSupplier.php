<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelSupplier
 *
 * @author Mioficina.co
 */

include_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineSupplier.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelSupplier{
    
    public function __construct() {}
    
    public function getSupplierByBuilding($idBuilding, $numPage, $sizePage){
        $rs = null;
        if(isset($numPage) && isset($sizePage)){
            $min = $numPage * $sizePage;
            $max = ($numPage * $sizePage) + $sizePage;
            $rs = DAOEngineSupplier::selectSupplierByTypePagging($idBuilding, $min, $max);
        }else{
            $rs = DAOEngineSupplier::selectSuppliers($idBuilding);
        }
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function getSupplierById($idSupplier){
        $rs = DAOEngineSupplier::selectSupplierById($idSupplier);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        $rs = DAOEngineSupplier::insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function updateSupplier($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        $rs = DAOEngineSupplier::updateConcept($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
}
?>
