<?php

/**
 * Description of DAOEngineUser
 * Methods related to the DAO Engine User
 * @author Mioficina.co
 */

include_once getcwd().'/../mysqlDBC/MysqlDBC.php';


class DAOEngineProfile {
    
    public static function selectProfileByUserTypeBuilding($idUser, $idUserType, $idBuilding){
        $sql = "SELECT *
                    FROM `profile`
                        WHERE `id_user` = '".$idUser."'
                            AND `id_user_type` = '".$idUserType."'
                            AND `id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    public static function insertProfile($idUser, $idUserType, $idBuilding){
        $sql = "INSERT INTO `profile` (`id_profile`, `id_user`, `id_user_type`, `id_building`, `is_removed`) VALUES (NULL, '".$idUser."', '".$idUserType."', '".$idBuilding."', '0');";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->insert($sql);
        return $result;
    }
    
    public static function updateProfileRemoved($isRemoved, $idProfile){
        $sql = "UPDATE `profile` SET `is_removed` = '".$isRemoved."' WHERE `profile`.`id_profile` = '".$idProfile."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->update($sql);
        return $result;
    }
    
    public static function deleteUserProfileByBuilding($idBuilding, $idUser){
        //$sql = "UPDATE `profile` SET `is_removed` = '1' WHERE `profile`.`id_user` = '".$idUser."' AND `profile`.`id_building` = '".$idBuilding."' ";
        $sql = "DELETE FROM `profile` WHERE `profile`.`id_user` = '".$idUser."' AND `profile`.`id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->delete($sql);
        return $result;
    }
    
}

?>