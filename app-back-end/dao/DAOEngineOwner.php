<?php

/**
 * Description of DAOEngineProperty
 *
 * @author Mioficina.co
 */
include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineOwner {

    public static function deleteOwner($idOffice, $idUserProfile) {
        $sql = "UPDATE `owner` SET `is_removed` = 1 
                    WHERE `id_office` = '".$idOffice."' AND `id_profile` = '".$idUserProfile."'  ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->delete($sql);
        return $result;
    }
    
}
?>

