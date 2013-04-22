<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelIncome
 *
 * @author Mioficina.co
 */

date_default_timezone_set('America/Bogota');
include_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineIncome.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelIncome{
    
    public function __construct() {}
    
    public function getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $numPage, $sizePage){
        $min = -1;
        $max = -1;
        if(isset($numPage) && isset($sizePage)){
            $min = $numPage * $sizePage;
            $max = ($numPage * $sizePage) + $sizePage;
        }
        $rs = DAOEngineIncome::getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $min, $max);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function getAllIncomesOffices($idBuilding, $numPage, $sizePage){
        return array('getAllIncomesOffices');
    }
    
    public function getIncomesByOffice($idOffice, $numPage, $sizePage){
        return array('getIncomesByOffice');
    }
    
    public function getIncomeById($idIncome){
        $rs = DAOEngineIncome::selectIncome($idIncome);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function insertIncomeByAdmon($idBuilding, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        return array('insertIncomeByAdmon');
    }
        
    public function insertIncomeGeneral($idBuilding, $idConcept, $dateIncome, $value, $payType, $from, $description){
        $date = date("Y-m-d H:i:s");
        $rs = DAOEngineIncome::insertIncome($idBuilding, $idConcept, 0, $dateIncome, $value, $payType, $from, $description, $date);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        $rs = DAOEngineIncome::updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function deleteIncome($idIncome){
        $rs = DAOEngineIncome::deleteIncome($idIncome);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
}
?>
