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

date_default_timezone_set('America/Bogota');
include_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineCommunication.php';
include_once getcwd().'/../utilities/Utilities.php';

class ModelCommunication{
    
    public function __construct() {}
    
    
    public function getCommunicationType($idBuilding){
        $rs = DAOEngineCommunication::selectCommunicationType($idBuilding);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $listAddresses){
        $date = date("Y-m-d H:i:s");
        $rs = DAOEngineCommunication::insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $date);
        if($rs != null){
            //send emails
            $arrayIdUsers = explode(';', $listAddresses);
            foreach ($arrayIdUsers as $idUser){
                if($idUser != ''){
                    DAOEngineCommunication::insertAddresses($rs, $idUser);
                }
            }
            return $rs;
        }
        return  _FALSE_;
    }
    
    public function getPathFolderFiles($idBuilding, $typeCommunication){
        $dataBuilding = DAOEngineGlobal::getDataBuilding($idBuilding);
        if($dataBuilding != null){
            $dataTypeCommunication = DAOEngineCommunication::selectCommunicationTypeById($typeCommunication);
            if($dataTypeCommunication != null){
                $date = date("Y-m");
                $dateComplete = date("Ymd");
                $key = substr(md5(time().rand()), 2, 8); //random
                return array('folder' => $dataBuilding['nick'] . '/' . $dataTypeCommunication['folder_name'] . '/' . $date . '/', 'date' => $dateComplete, 'key' => $key);
            }
        }
        return array('folder' => 'err');
    }
    
    public function insertFile($idCommunication, $name, $path){
        $date = date("Y-m-d H:i:s");
        $rs = DAOEngineCommunication::insertCommunicationFile($idCommunication, $name, $path, $date);
        if($rs != null){
            return $rs;
        }
        return  _FALSE_;
    }
    
}
?>
