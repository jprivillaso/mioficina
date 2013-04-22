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
//include_once getcwd().'/../dao/DAOEnginePayType.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelPayType{
    
    public function __construct() {}
    
    public function getPayType($idBuilding) {
        return array('gettyp');
    }
    
    public function insertPayType($namePayType, $idBuilding){
        return array('insert');
    }
    
    public function updatePayType($idPayType, $namePayType){
        return array('update');
    }
    
}
?>
