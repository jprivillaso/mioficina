<?php

/**
 * Description of ServiceUser
 * Methods related to the Service User
 * @author MiOficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCServer.php';
include_once getcwd().'/../model/ModelUser.php';
include_once getcwd().'/../model/Boolean.php';

$serviceUser = new ServiceUser();
jsonRPCServer::handle($serviceUser) or print 'no request';

class ServiceUser {
    private $modelUser;

    /**
     * Constructor
     */
    public function __construct() {
        $this->modelUser = new ModelUser();
    }
    
    public function getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage){
        return $this->modelUser->getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage);
    }
    
    public function getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType){
        return $this->modelUser->getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType);
    }

    public function getAllUserType($idBuilding){
        return $this->modelUser->getAllUserType($idBuilding);
    }
    
    public function getAllUserByType($idBuilding, $userType){
        return $this->modelUser->getAllUserByType($idBuilding, $userType);
    }
    
    public function getInfoUserByEmail($email, $idBuilding){
        return $this->modelUser->getInfoUserByEmail($email, $idBuilding);
    }
    
    public function getInfoUserById($idUser){
        return $this->modelUser->getInfoUserById($idUser);
    }
    
    public function getInfoUserByIdProfile($idUserProfile){
        return $this->modelUser->getInfoUserByIdProfile($idUserProfile);
    }

    public function insertUser($idBuilding, $idTypeUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        return $this->modelUser->insertUser($idBuilding, $idTypeUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone);
    }
    
    public function deleteUserByBuilding($idBuilding, $idUser){
        return $this->modelUser->deleteUserByBuilding($idBuilding, $idUser);
    }
   
    public function updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        return $this->modelUser->updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone);
    }
    
    public function updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone){
        return $this->modelUser->updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone);
    }
    
    public function insertUserType($name, $idUser){
        return $this->modelUser->insertUserType($name, $idUser);
    }
}
?>
