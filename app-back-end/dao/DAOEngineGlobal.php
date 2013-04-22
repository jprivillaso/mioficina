<?php

/**
 * Description of DAOEngineGlobal
 *
 * @author MiOficina.co
 */

include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineGlobal {
    
    //ok
    public static function getDataUser($idUser){
        $sql = "SELECT * FROM `user` WHERE `id_user` = '".$idUser."'";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    //ok
    public static function getDataOwner($idUserProfile){
        $sql = "SELECT * FROM `owner` WHERE `id_profile` = '".$idUserProfile."'";
        $results = array();
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        while($row = $result->fetch_assoc()){
            array_push($results, $row);
        }
        return $results;
    }
    
    //ok
    public static function getDataOwnerByOffice($idOffice){
        $sql = "SELECT * FROM `owner` WHERE `id_office` = '".$idOffice."' AND `is_removed` = 0 ";
        $results = array();
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        while($row = $result->fetch_assoc()){
            array_push($results, $row);
        }
        return $results;
    }
    
    //ok
    public static function getDataProfileByIdProfile($idProfile){
        $sql = "SELECT * FROM `profile` WHERE `id_profile` = '".$idProfile."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    //pok
    public static function getDataProfileByIdUser($idUser){
        $sql = "SELECT * FROM `profile` WHERE `id_user` = '".$idUser."' ";
        $results = array();
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        while($row = $result->fetch_assoc()){
            array_push($results, $row);
        }
        return $results;
    }
    
    //ok
    public static function getDataUserByEmail($email){
        $sql = "SELECT * FROM `user` WHERE `email` = '".$email."'";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
            
    //ok
    public static function getDataIdUser($idUser){
        $sql = "SELECT * FROM `user` WHERE `id_user` = '".$idUser."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    //ok
    public static function getDataBuilding($idBuilding){
        $sql = "SELECT * FROM `building` WHERE `id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    //ok
    public static function getTotalRecords($sql){
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $sentence = $result->fetch_row();
        return $sentence[0];
    }
    
}

?>
