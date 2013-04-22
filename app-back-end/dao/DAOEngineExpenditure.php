<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOEngineExpenditure
 *
 * @author Mioficina.co
 */

include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineExpenditure {
    
    public static function getAllExpenditures($idBuilding, $dateIni, $dateFin, $idConcept, $min, $max){
        $sql = "SELECT * FROM `expenditure`, `concept`  WHERE `expenditure`.`id_building` = '".$idBuilding."' AND  `concept`.`id_concept` = `expenditure`.`id_concept` ";
        $sql2 = "SELECT COUNT(`id_expenditure`) FROM `expenditure` WHERE `id_building` = '".$idBuilding."' ";
        
        if(isset($idConcept) && !empty($idConcept) ){
            $sql .= " AND `expenditure`.`id_concept` = '".$idConcept."' ";
            $sql2 .= " AND `expenditure`.`id_concept` = '".$idConcept."' ";
        }
        if(isset($dateIni) && !empty($dateIni)){
            $sql .= " AND `date_expenditure` >= '".$dateIni."'";
            $sql2 .= " AND `date_expenditure` >= '".$dateIni."'";
        }
        if(isset($dateFin) && !empty($dateFin)){
            $sql .= " AND `date_expenditure` <= '".$dateFin."' ";
            $sql2 .= " AND `date_expenditure` <= '".$dateFin."' ";
        }
        $sql .= " ORDER BY `expenditure`.`id_expenditure` DESC ";
        if($min != -1 && $max != -1){
            $sql .= " LIMIT ".$min." , ".$max." ";
        }
        
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            array_push($results, $row);
        }
        $total = DAOEngineGlobal::getTotalRecords($sql2);
        return array('listExpenditures' => $results, 'totalExpenditures' => $total);
    }
        
    public static function getExpenditureById($idExpenditure){
        $sql = "SELECT * FROM `expenditure` WHERE  `id_expenditure` = '".$idExpenditure."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    public static function insertExpenditure($idBuilding, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description, $date){
        $numberExpenditure = DAOEngineExpenditure::getMaxNumExpenditure($idBuilding) + 1;
        $sql = "INSERT INTO `expenditure` (`id_expenditure`, `number_expenditure`, `id_building`, `id_concept`, `value`, `voucher`, `id_pay_type`, `id_supplier`, `date_expenditure`, `description_expenditure`, `date`)  VALUES (NULL, '".$numberExpenditure."', '".$idBuilding."', '".$idConcept."', '".$value."', '".$voucher."', '".$idPayType."', '".$idSupplier."', '".$dateExpenditure."', '".$description."', '".$date."'); ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->insert($sql);
    }
    
    public static function getMaxNumExpenditure($idBuilding){
        $sql = "SELECT MAX(`number_expenditure`) FROM `expenditure` WHERE `id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $sentence = $result->fetch_row();
        return $sentence[0];
    }
    
    public static function updateExpenditure($idExpenditure, $idConcept, $value, $voucher, $idPayType, $idSupplier, $dateExpenditure, $description){
        $sql = "UPDATE `expenditure` SET `id_concept` = '".$idConcept."', `value` = '".$value."', `voucher` = '".$voucher."', `id_pay_type` = '".$idPayType."', `id_supplier` = '".$idSupplier."', `date_expenditure` = '".$dateExpenditure."', `description_expenditure` = '".$description."' WHERE `expenditure`.`id_expenditure` = '".$idExpenditure."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->update($sql);
    }
    
    public static function deleteExpenditure($idExpenditure){
        $sql = "DELETE FROM `expenditure` WHERE `expenditure`.`id_expenditure` = '".$idExpenditure."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->delete($sql);
    }
    
}

?>
