<?php

/**
 * Description of DAOEngineAccountant
 *
 * @author Mioficina.co
 */
include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineAccountant {

    public static function selectBuildingAccountant($idBuilding){
        $sql = "SELECT * FROM `building_accountant` WHERE `id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    public static function updateBuildingAccountant($idBuilding, $interestRate, $periodsElapsed){
        $sql = "UPDATE `building_accountant` SET `interest_rate` = '".$interestRate."', `periods_elapsed` = '".$periodsElapsed."' WHERE `building_accountant`.`id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->update($sql);
    }
    
    public static function selectOfficesAccountantPagging($idBuilding, $min, $max){
        $sql = "SELECT * FROM `office` WHERE `id_building` = '" . $idBuilding . "'  AND `is_removed` = 0 ORDER BY `id_office` ASC LIMIT " . $min . " , " . $max . " ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $id = $row['id_office'];
            $infoAccountant = DAOEngineAccountant::selectOfficeAccountantByOffice($id);
            array_push($results, array('infoOffice' => $row, 'accountant' => $infoAccountant));
        }
        $sql2 = "SELECT COUNT(`id_office`) FROM `office` WHERE `id_building` = '" . $idBuilding . "'  AND `is_removed` = 0 ORDER BY `id_office` ASC ";

        $total = DAOEngineGlobal::getTotalRecords($sql2);
        return array('listOffices' => $results, 'totalOffices' => $total);
    }
    
    public static function selectOfficeAccountantByOffice($idOffice){
        $sql = "SELECT * FROM `office_accountant` WHERE `id_office` = '".$idOffice."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    public static function selectOfficesAccountant($idBuilding){
        $sql = "SELECT * FROM `office` WHERE `id_building` = '" . $idBuilding . "'  AND `is_removed` = 0 ORDER BY `id_office` ASC ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $id = $row['id_office'];
            $infoAccountant = DAOEngineAccountant::selectOfficeAccountantByOffice($id);
            array_push($results, array('infoOffice' => $row, 'accountant' => $infoAccountant));
        }
        return $results;
    }
    
    public static function insertOfficeAccountant($idOffice, $admonValue){
        $sql = "INSERT INTO `office_accountant` (`id`, `id_office`, `admon_value`) VALUES (NULL, '".$idOffice."', '".$admonValue."') ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->insert($sql);
    }
    
    public static function updateOfficeAccountant($idOffice, $admonValue){
        $sql = "UPDATE `office_accountant` SET `admon_value` = '".$admonValue."' WHERE `office_accountant`.`id_office` = '".$idOffice."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->update($sql);
    }
    
}
?>

