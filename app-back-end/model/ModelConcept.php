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
include_once getcwd().'/../dao/DAOEngineConcept.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelConcept{
    
    public function __construct() {}
    
    public function getConceptsByType($idBuilding, $typeConcept, $numPage, $sizePage){
        $rs = null;
        if(isset($numPage) && isset($sizePage)){
            $min = $numPage * $sizePage;
            $max = ($numPage * $sizePage) + $sizePage;
            $rs = DAOEngineConcept::selectConceptsByTypePagging($idBuilding, $typeConcept, $min, $max);
        }else{
            $rs = DAOEngineConcept::selectConceptsByType($idBuilding, $typeConcept);
        }
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function getConceptById($idConcept){
        $rs = DAOEngineConcept::selectConceptById($idConcept);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function insertConcept($nameConcept, $idBuilding, $typeConcept, $description){
        $rs = DAOEngineConcept::insertConcept($nameConcept, $description, $idBuilding, $typeConcept);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function updateConcept($idConcept, $nameConcept, $description){
        $rs = DAOEngineConcept::updateConcept($idConcept, $nameConcept, $description);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
}
?>
