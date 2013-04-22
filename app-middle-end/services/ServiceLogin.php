<?php

/**
 * Description of ServiceLogin
 * Methods related to the Service Login
 * @author MiOficina.co
 */

header ('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
include_once getcwd().'/../model/ModelLogin.php';

/**
 * Verify the Name Service and calls the respective method
 */
if (isset($_REQUEST)) {
    $serviceLogin = new ServiceLogin();
    @$nameService = $_REQUEST['nameservice'];
    if ($nameService == 'run') {
        $serviceLogin->run();
    }else if($nameService == 'loginIn'){
        @$userEmail = $_REQUEST['userEmail'];
        @$userPassword = $_REQUEST['userPassword'];
        $serviceLogin->loginIn($userEmail, $userPassword);
    }else if($nameService == 'checkAccount'){
        /*@$nickUnit = $_REQUEST['nickUnit'];
        @$userUser = $_REQUEST['userUser'];
        @$key = $_REQUEST['key'];
        $serviceLogin->checkAccount($nickUnit, $userUser, $key);*/
    }else if($nameService == 'changePassword'){
        @$idUser = $_REQUEST['idUser'];
        @$key = $_REQUEST['key'];
        @$previewPassword = $_REQUEST['previewPassword'];
        @$currentPassword = $_REQUEST['currentPassword'];
        $serviceLogin->changePassword($idUser, $key, $previewPassword, $currentPassword);
    }
}

class ServiceLogin {
    
    private $modelLogin;

    /**
     * Constructor
     */
    public function __construct() {
        $this->modelLogin = new ModelLogin();
    }
    
    public function run(){
        echo json_encode( array('Status' => 'Running Rest WS Login') );
    }

    /**
     * Method that calls the loginIn method of the class Model Login and return
     * the result in json format
     * @param type $buildingNick
     * @param type $userNick
     * @param type $userPassword
     */
    public function loginIn($userEmail, $userPassword){
        echo json_encode( $this->modelLogin->loginIn($userEmail, $userPassword) );
    }
    
    public function checkAccount($buildingNick, $userNick, $key){
        echo json_encode( $this->modelLogin->checkAccount($buildingNick, $userNick, $key) );
    }    
    
    public function changePassword($idUser, $key, $previewPassword, $currentPassword){
        echo json_encode( $this->modelLogin->changePassword($idUser, $key, $previewPassword, $currentPassword));
    }
    
}

?>