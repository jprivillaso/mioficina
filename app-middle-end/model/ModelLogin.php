<?php

/**
 * Description of ModelLogin
 * Methods related to the Model Login
 * @author MiOficina.co
 */

require_once getcwd().'/../net/JSON-RPC/jsonRPCClient.php';
include_once getcwd().'/../net/PathBackEnd/PathBackEnd.php';

class ModelLogin {

    private $serviceBackEnd;

    /**
     * Constructor
     */
    public function __construct() {
        $this->serviceBackEnd = new jsonRPCClient(PATH_BACK_END.'services/ServiceLogin.php');
    }
    
    /**
     * Method that calls the loginIn method of the class Service Login in the
     * app-back-end
     * @param type $buildingNick
     * @param type $userNick
     * @param type $userPassword
     * @return array or false
     */
    public function loginIn($userEmail, $userPassword){
        if(isset ($userEmail) && isset ($userPassword) ){
            $response = $this->serviceBackEnd->loginIn($userEmail, $userPassword);
            if($response == "false"){
                return array('statusParam' => true, 'result' => 'null');
            }
            return array('statusParam' => true, 'result' => $response);
        }
        return array('statusParam' => false, 'msg' => 'errr params');
    }
    
    public function checkAccount($buildingNick, $userNick, $key){
        /*$statusParam = false;
        $msg = 'Error with Parameters';
        $isValidated = false;
        $name = '';
        if(isset($buildingNick) && isset($userNick) && isset($key)){
            $statusParam = true;
            $msg = 'OK';
            $response = $this->serviceBackEnd->checkAccount($buildingNick, $userNick, $key);
            if($response != 'false'){
                $isValidated = true;
                $name = $response;
            }
        }
        return array('statusParam' => $statusParam, 'isValidated' => $isValidated,
            'name' => $name, 'msg' => $msg);
         */
    }
    
    public function changePassword($idUser, $key, $previewPassword, $currentPassword){
        if(isset($idUser) && isset($key) && isset($previewPassword) && isset($currentPassword)){ 
            $response = $this->serviceBackEnd->changePassword($idUser, $key, $previewPassword, $currentPassword);
            return array('statusParam' => true, 'result' => $response, 'msg' => 'ok');
        }
        return array('statusParam' => false, 'msg' => 'error with params');
    }
    
}

?>
