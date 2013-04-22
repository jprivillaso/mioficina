<?php

/**
 * Description of DAOEngineProperty
 *
 * @author Mioficina.co
 */
include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineSupplier {

    public static function selectSupplierByTypePagging($idBuilding, $min, $max) {
        $sql = "SELECT * FROM `supplier` WHERE `id_building` = '".$idBuilding."' ORDER BY `supplier`.`id_supplier` ASC LIMIT ".$min." , ".$max." ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            array_push($results, $row);
        }
        
        $sql2 = "SELECT COUNT(`id_supplier`) FROM `supplier` WHERE `id_building` = '".$idBuilding."' ";

        $total = DAOEngineGlobal::getTotalRecords($sql2);
        return array('listSuppliers' => $results, 'totalSuppliers' => $total);
    }
    
    public static function selectSuppliers($idBuilding) {
        $sql = "SELECT * FROM `supplier` WHERE `id_building` = '".$idBuilding."' ORDER BY `supplier`.`id_supplier` ASC ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            array_push($results, $row);
        }
        return $results;
    }
    
    public static function selectSupplierById($idSupplier){
        $sql = "SELECT * FROM `supplier` WHERE `id_supplier` = '".$idSupplier."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }

    public static function insertSupplier($idBuilding, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        $sql = "INSERT INTO `supplier` (`id_supplier`, `id_building`, `name_supplier`, `identification`, `nit_supplier`, `phone_supplier`, `address_supplier`, `email_supplier`) VALUES (NULL, '".$idBuilding."', '".$nameSupplier."', '".$IDSupplier."', '"."$nitSupplier"."', '".$phoneSupplier."', '".$addressSupplier."', '$emailSupplier') ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->insert($sql);
    }
    
    public static function updateConcept($idSupplier, $nameSupplier, $IDSupplier, $nitSupplier, $phoneSupplier, $addressSupplier, $emailSupplier){
        $sql = "UPDATE `supplier` SET `name_supplier` = '".$nameSupplier."', `identification` = '".$IDSupplier."', `nit_supplier` = '".$nitSupplier."', `phone_supplier` = '".$phoneSupplier."', `address_supplier` = '".$addressSupplier."', `email_supplier` = '".$emailSupplier."' WHERE `supplier`.`id_supplier` = '".$idSupplier."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->update($sql);
    }
    
}
?>

