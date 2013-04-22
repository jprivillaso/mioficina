<?php

/**
 * Description of ModelLogin
 * Methods related to the Login Module
 * @author MiOficina.co
 */

include_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineLogin.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelLogin {

    /**
     * Constructor
     */
    public function __construct() { }

    public function loginIn($userEmail, $userPassword){
        $rs = DAOEngineLogin::LoginIn($userEmail, $userPassword);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function checkAccount($buildingNick, $userNick, $key){
        $name = DAOEngineLogin::checkAccount($buildingNick, $userNick, $key);
        if($name == false){
            return _FALSE_;
        }
        return $name;
    }
    
    public function changePassword($idUser, $key, $previewPassword, $currentPassword){
        $rs = null;
        $dataUser = DAOEngineGlobal::getDataIdUser($idUser);
        if($dataUser['key'] == $key && $dataUser['password'] == $previewPassword){
            //change
            $rs = DAOEngineLogin::changePassword($dataUser['email'], $currentPassword);
        }else{
            return 'notMatch';
        }
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
}

?>