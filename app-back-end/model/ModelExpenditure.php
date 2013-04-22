<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelExpenditure
 *
 * @author Mioficina.co
 */

date_default_timezone_set('America/Bogota');
include_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineExpenditure.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelExpenditure {  
       
    public function __construct() {}
    
    public function getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage){
        $min = -1;    
        $max = -1;
        if(isset($numPage) && isset($sizePage)){
            $min = $numPage * $sizePage;
            $max = ($numPage * $sizePage) + $sizePage;
        }
        $rs = DAOEngineExpenditure::getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $min, $max);
        
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function getExpenditureById($idExpenditure){
       $rs = DAOEngineExpenditure::getExpenditureById($idExpenditure);
       if($rs != null){
            return $rs;
       }
       return _FALSE_;
    }
    
    public function insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
        $date = date("Y-m-d H:i:s");
        $rs = DAOEngineExpenditure::insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description, $date);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
       $rs = DAOEngineExpenditure::updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description);
       if($rs != null){
            return $rs;
       }
       return _FALSE_;
    }
    
    public function deleteExpenditure($idExpenditure){
       $rs = DAOEngineExpenditure::deleteExpenditure($idExpenditure);
       if($rs != null){
            return $rs;
       }
       return _FALSE_;
    }
    
}

?>
