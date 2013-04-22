<?php

session_start();

class ModelSession {

    public function createSession($idUserProfile, $idBuilding, $typeUser){
        $_SESSION['idProfileSession'] = $idUserProfile;
        $_SESSION['buildingSession'] = $idBuilding;
        $_SESSION['typeUserSession'] = $typeUser;
        if (isset($_SESSION['idProfileSession'])){
            return array('session' => true, 'idUser' => $_SESSION['idProfileSession'], 'idBuilding' => $_SESSION['buildingSession'], 'idTypeUser' => $_SESSION['typeUserSession']);
        }else{
            return array('session' => false);
        }
    }

    public function validateSession(){
        if (isset($_SESSION['idProfileSession'])){
            return array('session' => true, 'idUserProfile' => $_SESSION['idProfileSession'], 'idBuilding' => $_SESSION['buildingSession'], 'idTypeUser' => $_SESSION['typeUserSession']);
        }else{
            return array('session' => false, 'idUser' => null );
        }
    }

    public function getIdProfileSession(){
        if(isset($_SESSION['idProfileSession'])){
            return $_SESSION['idProfileSession'];
        }
        return null;
    }

    public function getIdBuildingSession(){
        if(isset($_SESSION['buildingSession'])){
            return $_SESSION['buildingSession'];
        }
        return null;
    }
    
    public function getTypeUserProfileSession(){
        if(isset($_SESSION['typeUserSession'])){
            return $_SESSION['typeUserSession'];
        }
        return null;
    }
    
}

?>