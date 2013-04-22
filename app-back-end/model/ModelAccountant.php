<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelAccountant
 *
 * @author Mioficina.co
 */

include_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineAccountant.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelAccountant{
    
    public function __construct() {}
    
    public function getBuildingAccountant($idBuilding){
        $rs = DAOEngineAccountant::selectBuildingAccountant($idBuilding);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed){
        $rs = DAOEngineAccountant::updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function getOfficesAccountant($idBuilding, $numPage, $sizePage){
        $rs = null;
        if(isset($numPage) && isset($sizePage)){
            $min = $numPage * $sizePage;
            $max = ($numPage * $sizePage) + $sizePage;
            $rs = DAOEngineAccountant::selectOfficesAccountantPagging($idBuilding, $min, $max);
        }else{
            $rs = DAOEngineAccountant::selectOfficesAccountant($idBuilding);
        }
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function getAccountantByIdOffice($idOffice){
        $rs = DAOEngineAccountant::selectOfficeAccountantByOffice($idOffice);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function updateOfficesAccountant($admonValue, $idOffices){
        $rs = null;
        $arrayOffices = explode(';', $idOffices);
        foreach ($arrayOffices as $idOffice){
            if($idOffice != ''){
                $dataAccountantOffice = DAOEngineAccountant::selectOfficeAccountantByOffice($idOffice);
                if($dataAccountantOffice != null){
                    $rs = DAOEngineAccountant::updateOfficeAccountant($idOffice, $admonValue);
                }else{
                    $rs = DAOEngineAccountant::insertOfficeAccountant($idOffice, $admonValue);
                }
            }
        }
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
}
?>
