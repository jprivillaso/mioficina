<?php

/**
 * Description of ServiceUser
 * Methods related to the Service User
 * @author MiOficina.co
 */

header ('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd().'/../model/ModelUser.php';

/**
 * Verify the Name Service and calls the respective method
 */
if (isset($_REQUEST)) {
    $serviceUser = new ServiceUser();
    @$nameService = $_REQUEST['nameservice'];
    if($nameService == 'run'){
        $serviceUser->run();
    }else if($nameService == 'getUsersByBuilding'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$userType = $_REQUEST['userType'];
        @$numPage = $_REQUEST['numPage'];
        @$sizePage = $_REQUEST['sizePage'];
        $serviceUser->getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage);
    }else if($nameService == 'getAllUserByType'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$userType = $_REQUEST['userType'];
        $serviceUser->getAllUserByType($idBuilding, $userType);
    }else if($nameService == 'getAllUserType'){
        @$idBuilding = $_REQUEST['idBuilding'];
        $serviceUser->getAllUserType($idBuilding);
    }else if($nameService == 'getUsersByBuildingNoOwner'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idOffice = $_REQUEST['idOffice'];
        @$userType = $_REQUEST['userType'];
        $serviceUser->getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType);
    }else if($nameService == 'getInfoUserByEmail'){
        @$email = $_REQUEST['email'];
        @$idBuilding = $_REQUEST['idBuilding'];
        $serviceUser->getInfoUserByEmail($email, $idBuilding);
    }else if($nameService == 'getInfoUserById'){
        @$idUser = $_REQUEST['idUser'];
        $serviceUser->getInfoUserById($idUser);
    }else if($nameService == 'getInfoUserByIdProfile'){
        @$idUserProfile = $_REQUEST['idUserProfile'];
        $serviceUser->getInfoUserByIdProfile($idUserProfile);
    }else if($nameService == 'insertUser'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idTypeUser = $_REQUEST['idTypeUser'];
        @$identification = $_REQUEST['identification'];
        @$name = $_REQUEST['name'];
        @$email = $_REQUEST['email'];
        @$homePhone = $_REQUEST['homePhone'];
        @$celPhone = $_REQUEST['celPhone'];
        @$officePhone = $_REQUEST['officePhone'];
        $serviceUser->insertUser($idBuilding, $idTypeUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone);
    }else if($nameService == 'updateUser'){
        @$idUser = $_REQUEST['idUser'];
        @$identification = $_REQUEST['identification'];
        @$name = $_REQUEST['name'];
        @$email = $_REQUEST['email'];
        @$homePhone = $_REQUEST['homePhone'];
        @$celPhone = $_REQUEST['celPhone'];
        @$officePhone = $_REQUEST['officePhone'];
        $serviceUser->updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone);
    }else if($nameService == 'updateUserMe'){
        @$idUser = $_REQUEST['idUser'];
        @$identification = $_REQUEST['identification'];
        @$name = $_REQUEST['name'];
        @$nick = $_REQUEST['nick'];
        @$email = $_REQUEST['email'];
        @$homePhone = $_REQUEST['homePhone'];
        @$celPhone = $_REQUEST['celPhone'];
        @$officePhone = $_REQUEST['officePhone'];
        $serviceUser->updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone);
    }else if($nameService == 'deleteUserByBuilding'){
        @$idBuilding = $_REQUEST['idBuilding'];
        @$idUser = $_REQUEST['idUser'];
        $serviceUser->deleteUserByBuilding($idBuilding, $idUser);
    }else if($nameService == 'insertUserType'){
        //*
    }
}

class ServiceUser {
    private $modelUser;

    /**
     * Constructor
     */
    public function __construct() {
        $this->modelUser = new ModelUser();
    }

    public function run(){
        echo json_encode( array('Status' => 'Running Rest WS User') );
    }

    public function getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage){
       echo json_encode( $this->modelUser->getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage) );
    }
    
    public function getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType){
        echo json_encode( $this->modelUser->getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType));
    }
    
    public function getAllUserByType($idBuilding, $userType){
        echo json_encode( $this->modelUser->getAllUserByType($idBuilding, $userType));
    }

    public function getAllUserType($idBuilding){
        echo json_encode( $this->modelUser->getAllUserType($idBuilding) );
    }
    
    public function getInfoUserByEmail($email, $idBuilding){
        echo json_encode( $this->modelUser->getInfoUserByEmail($email, $idBuilding) );
    }
    
    public function getInfoUserById($idUser){
        echo json_encode( $this->modelUser->getInfoUserById($idUser) );
    }
    
    public function getInfoUserByIdProfile($idUserProfile){
        echo json_encode( $this->modelUser->getInfoUserByIdProfile($idUserProfile) );
    }

    public function insertUser($idBuilding, $idTypeUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        echo json_encode( $this->modelUser->insertUser($idBuilding, $idTypeUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone) );
    }
    
    public function deleteUserByBuilding($idBuilding, $idUser){
        echo json_encode( $this->modelUser->deleteUserByBuilding($idBuilding, $idUser) );
    }

    public function insertUserType($name, $idUser){
        echo json_encode( $this->modelUser->insertUserType($name, $idUser) );
    }

    public function updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        echo json_encode( $this->modelUser->updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone) );
    }
    
    public function updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone){
        echo json_encode( $this->modelUser->updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone));
    }

}
?>