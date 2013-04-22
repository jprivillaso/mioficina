<?php

/**
 * Description of DAOEngineProperty
 *
 * @author Mioficina.co
 */
include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineCommunication {

    public static function selectCommunicationType($idBuilding) {
        $sql = "SELECT * FROM `communication_type` ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            array_push($results, $row);
        }        
        return $results;
    }
    
    public static function selectCommunicationTypeById($idCommunication) {
        $sql = "SELECT * FROM `communication_type` WHERE `id_type` = '".$idCommunication."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return  $result->fetch_assoc();
    }
    
    public static function insertCommunication($idBuilding, $idUser, $idTypeCommunication, $subject, $data, $date){
        $sql = "INSERT INTO `communication` (`id_communication`, `id_building`, `communication_type`, `id_user`, `subject`, `body`, `date`, `can_reply`, `is_removed`) VALUES (NULL, '".$idBuilding."', '".$idTypeCommunication."', '".$idUser."', '".$subject."', '".$data."', '".$date."', '1', '0') ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->insert($sql);
    }
    
    public static function insertCommunicationFile($idCommunication, $name, $path, $date){
        $sql = "INSERT INTO `attachment` (`id_attachment`, `id_comunication`, `name`, `path`, `date`) VALUES (NULL, '".$idCommunication."', '".$name."', '".$path."', '".$date."') ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->insert($sql);
    }
    
    public static function insertAddresses($idCommunication, $idUser){
        $sql = "INSERT INTO `addressee` (`id_addressee`, `id_comunication`, `id_user`, `is_viewed`, `is_removed`) VALUES (NULL, '".$idCommunication."', '".$idUser."', '0', '0') ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->insert($sql);
    }
    
}
?>

