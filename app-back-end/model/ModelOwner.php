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
include_once getcwd().'/../dao/DAOEngineOwner.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelOwner{
    
    public function __construct() {}
    
    public function deleteOwner($idOffice, $idUserProfile){
        $rs = DAOEngineOwner::deleteOwner($idOffice, $idUserProfile);
        if($rs != null){
            return _TRUE_;
        }
        return  _FALSE_;
    }
    
}
?>
