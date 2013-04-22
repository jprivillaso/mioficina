<?php

/**
 * Description of DAOEngineConfigProfile
 * Methods related to the DAO Engine Config Profile
 * @author MiOficina.co
 */

include_once getcwd().'/../mysqlDBC/MysqlDBC.php';

class DAOEngineConfigProfile {

    /**
     * Method that selects all the modules
     * @return array
     */
    public static function getModules(){
        $sql = "SELECT * FROM `module` ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while($row = $result->fetch_assoc()){
            array_push($results, $row);
        }
        return $results;
    } 

    /**
     * Method that selects all the services depending of idUserType and
     * idBuilding parameters
     * @param type $idUserType
     * @param type $idBuilding
     * @return array
     */
    public static function getListServices($idUserType, $idBuilding){
        $sql = "SELECT *
                    FROM `permission`
                        WHERE `id_usertype` = '".$idUserType."'
                                AND `id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }

    /**
     * Method that selects services depending of idService parameter
     * @param type $idService
     * @return array
     */
    public static function getDataForService($idService){
        $sql = "SELECT *
                    FROM `service`
                        WHERE `id_service` = '".$idService."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }

    /**
     * Method that selects all default services
     * @return array 
     */
    public static function getDefaultDataForService(){
        $sql = "SELECT *
                    FROM `service`
                        WHERE `is_default` = '1' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while($row = $result->fetch_assoc()){
            array_push($results, $row);
        }
        return $results;
    }
    
}

?>