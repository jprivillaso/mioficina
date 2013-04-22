<?php

/**
 * Description of ModelUser
 * Methods related to the Model User
 * @author Mioficina.co
 */

include_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineUser.php';
include_once getcwd().'/../dao/DAOEngineProfile.php';
include_once getcwd().'/../utilities/Utilities.php';


class ModelUser {

    /**
     * Constructor
     */
    public function __construct() {}
    
    public function getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage){
        $rs = DAOEngineUser::getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType){
        $rs = DAOEngineUser::getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType);
        if($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function getAllUserByType($idBuilding, $userType){
        if(empty($userType)){
            //get all types
            $listUserTypes = DAOEngineUser::getAllUserType($idBuilding);
            $resultListUsers = array();
            foreach ($listUserTypes as $itemUserType) {
                $idEachUserType = $itemUserType['id_usertype'];
                $listUsers = DAOEngineUser::selectUserByType($idBuilding, $idEachUserType);
                array_push($resultListUsers, array('typeUser'=> $itemUserType, 'listUsers' => $listUsers));
            }
            return $resultListUsers;
        }else{
            $typeUser = DAOEngineUser::selectTypeUserById($userType);
            $listUsers = DAOEngineUser::selectUserByType($idBuilding, $userType);
            return array('typeUser'=> $typeUser, 'listUsers' => $listUsers );
        }
        return _FALSE_;
    }
    
    public function getAllUserType($idBuilding){
        $rs = DAOEngineUser::getAllUserType($idBuilding);
        if ($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    
    public function getInfoUserByEmail($email, $idBuilding){
        $rs = DAOEngineUser::getInfoUserByEmail($email, $idBuilding);
        if ($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function getInfoUserById($idUser){
        $rs = DAOEngineGlobal::getDataIdUser($idUser);
        if ($rs != null){
            return $rs;
        }
        return _FALSE_;
    }
    
    public function getInfoUserByIdProfile($idProfile){
        $dataProfile = DAOEngineGlobal::getDataProfileByIdProfile($idProfile);
        $idUser = $dataProfile['id_user'];
        $rs = DAOEngineGlobal::getDataIdUser($idUser);
        if ($rs != null){
            return $rs;
        }
        return _FALSE_;
    }

    public function insertUser($idBuilding, $idTypeUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        //chekear if user exist!
        /*$dataUserByEmail = DAOEngineGlobal::getDataUserByEmail($email);
        if($dataUserByEmail != null){
            $idUser = $dataUserByEmail['id_user'];
            $isUpdateUser = DAOEngineUser::updateUser($idUser, $identification, $name, $dataUserByEmail['nick'], $dataUserByEmail['password'], $email, $dataUserByEmail['key'], $homePhone, $celPhone, $officePhone, 0);
            $dataProfile = DAOEngineProfile::selectProfileByUserTypeBuilding($idUser, $idTypeUser, $idBuilding);
                if($dataProfile == null){
                    //add
                    $addProfile = DAOEngineProfile::insertProfile($idUser, $idTypeUser, $idBuilding);
                }else{
                    //change value is removed
                    $idProfile = $dataProfile['id_profile'];
                    $isUpdate = DAOEngineProfile::updateProfileRemoved(0, $idProfile);
                }
                return array('op' => true);
        }else{
            $key = substr(md5(time().rand()), 2, 8); //random
            $idNewUser = DAOEngineUser::insertUser($identification, $name, '', '', $email, $key, $homePhone, $celPhone, $officePhone);
            if($idNewUser != null){
                $addProfile = DAOEngineProfile::insertProfile($idNewUser, $idTypeUser, $idBuilding);
                return array('op' => true);
            }
        }
        return _FALSE_;*/
        
        $key = substr(md5(time().rand()), 2, 8); //random
        $idNewUser = DAOEngineUser::insertUser($identification, $idBuilding, $name, '', '', $email, $key, $homePhone, $celPhone, $officePhone);
        if($idNewUser != null){
            $addProfile = DAOEngineProfile::insertProfile($idNewUser, $idTypeUser, $idBuilding);
            return array('op' => true, 'idUser' => $idNewUser, 'idProfile' => $addProfile);
        }
        return _FALSE_;
    }
    
    
    public function deleteUserByBuilding($idBuilding, $idUser){
        $rs = DAOEngineProfile::deleteUserProfileByBuilding($idBuilding, $idUser);
        $rs2 = DAOEngineUser::deleteUser($idUser);
        if($rs != null && $rs2 != null){
            return _TRUE_;
        }
        return _FALSE_;
    }
    
    public function insertUserType($name, $idUser){
        return DAOEngineUser::insertUserType($name, $idUser);
    }
    
    public function updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        $rs = DAOEngineUser::updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone);
        if($rs != null){
            return _TRUE_;
        }
        return _FALSE_;
    }
    
    public function updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone){
        $rs = DAOEngineUser::updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone);
        if($rs != null){
            return _TRUE_;
        }
        return _FALSE_;
    }
    
}
?>
