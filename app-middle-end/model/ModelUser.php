<?php

/**
 * Description of ModelUser
 * Methods related to the Model User
 * @author MiOficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCClient.php';
include_once getcwd().'/../net/PathBackEnd/PathBackEnd.php';

class ModelUser {

    private $serviceBackEnd;

    /**
     * Constructor
     */
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceUser.php');
    }
    
    public function getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage){
        $statusParam = false;
        $msg = 'Error with Parameters';
        if(isset($idBuilding)){
            $statusParam = true;
            $msg = 'OK';
            if(isset($userType)){
                $response = $this->serviceBackEnd->getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage);
            }else{
                $response = $this->serviceBackEnd->getUsersByBuilding($idBuilding, null, $numPage, $sizePage);
            }
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg );
        }
        return array('statusParam' => $statusParam, 'msg' => $msg);

    }
    
    public function getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType){
        if(isset($idBuilding) && isset($idOffice)){
            $response = $this->serviceBackEnd->getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'OK');
        }
        return array('statusParam' => false, 'msg' => 'err params');
    }
    
    public function getAllUserByType($idBuilding, $userType){
        if(isset($idBuilding) && isset($userType)){
            $response = $this->serviceBackEnd->getAllUserByType($idBuilding, $userType);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'OK');
        }
        return array('statusParam' => false, 'msg' => 'err params');
    }

    public function getAllUserType($idBuilding){
        $statusParam = false;
        $msg = 'Error with Parameters';
        if(isset($idBuilding)){
            $statusParam = true;
            $msg = 'OK';
            $response = $this->serviceBackEnd->getAllUserType($idBuilding);
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg );
        }
        return array('statusParam' => $statusParam, 'msg' => $msg);
    }
    
    public function getInfoUserByEmail($email, $idBuilding){
        if(isset($email)){
            $response = $this->serviceBackEnd->getInfoUserByEmail($email, $idBuilding);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'OK');
        }
        return array('statusParam' => false, 'msg' => 'err params');
    }
    
    public function getInfoUserById($idUser){
        if(isset($idUser)){
            $response = $this->serviceBackEnd->getInfoUserById($idUser);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'OK');
        }
        return array('statusParam' => false, 'msg' => 'err params');
    }
    
    public function getInfoUserByIdProfile($idUserProfile){
        if(isset($idUserProfile)){
            $response = $this->serviceBackEnd->getInfoUserByIdProfile($idUserProfile);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'OK');
        }
        return array('statusParam' => false, 'msg' => 'err params');
    }

    public function insertUser($idBuilding, $idTypeUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        if(isset($idBuilding) && isset($idTypeUser) && isset($identification) && isset($name) && isset($email)){
            $response = $this->serviceBackEnd->insertUser($idBuilding, $idTypeUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'OK' );
        }
        return array('statusParam' => false, 'msg' => 'Err params');

    }
    
    public function deleteUserByBuilding($idBuilding, $idUser){
        if(isset($idBuilding) && isset($idUser)){
            $response = $this->serviceBackEnd->deleteUserByBuilding($idBuilding, $idUser);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'OK' );
        }
        return array('statusParam' => false, 'msg' => 'Err params');
    }

    public function insertUserType($name, $idUser){
        $statusParam = false;
        $msg = 'Error with Parameters';
        if(isset($name) && isset($idUser)){
            $statusParam = true;
            $msg = 'OK';
            $response = $this->serviceBackEnd->insertUserType($name, $idUser);
            return array('statusParam' => $statusParam, 'result' => $response, 'msg' => $msg );
        }
        return array('statusParam' => $statusParam, 'msg' => $msg);
    }

    
    public function updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        if(isset($idUser) && isset($identification) && isset($name) && isset($email) && isset($homePhone) && isset($celPhone) && isset($officePhone)){
            $response = $this->serviceBackEnd->updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
    public function updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone){
        if(isset($idUser) && isset($identification) && isset($name) && isset($nick)  && isset($email) && isset($homePhone) && isset($celPhone) && isset($officePhone)){
            $response = $this->serviceBackEnd->updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }

}
?>
