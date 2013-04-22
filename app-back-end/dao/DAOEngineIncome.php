<?php

/**
 * Description of DAOEngineIncome
 *
 * @author Mioficina.co
 */
include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineIncome {

    public static function getAllIncomes($idBuilding, $dateIni, $dateFin, $idConcept, $min, $max) {
        $sql = "SELECT * FROM `income`, `concept`  WHERE `income`.`id_building` = '".$idBuilding."' AND  `concept`.`id_concept` = `income`.`id_concept` ";
        $sql2 = "SELECT COUNT(`id_income`) FROM `income` WHERE `id_building` = '".$idBuilding."' ";
        if(isset($idConcept) && !empty($idConcept) ){
            $sql .= " AND `income`.`id_concept` = '".$idConcept."' ";
            $sql2 .= " AND `income`.`id_concept` = '".$idConcept."' ";
        }
        if(isset($dateIni) && !empty($dateIni)){
            $sql .= " AND `date_income` >= '".$dateIni."'";
            $sql2 .= " AND `date_income` >= '".$dateIni."'";
        }
        if(isset($dateFin) && !empty($dateFin)){
            $sql .= " AND `date_income` <= '".$dateFin."' ";
            $sql2 .= " AND `date_income` <= '".$dateFin."' ";
        }
        $sql .= " ORDER BY `income`.`id_income` DESC ";
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
        return array('listIncomes' => $results, 'totalIncomes' => $total);
    }
    
    public static function insertIncome($idBuilding, $idConcept, $idInnvoice, $dateIncome, $valueIncome, $payType, $fromIncome, $descriptionIncome, $date ){
        $numberIncome = DAOEngineIncome::getMaxNumIncome($idBuilding) + 1;
        $sql = "INSERT INTO `income` (`id_income`, `number_income`, `id_building`, `id_concept`, `id_innvoice`, `date_income`, `value`, `id_pay_type`, `from`, `description_income`, `date`)  VALUES (NULL, '".$numberIncome."', '".$idBuilding."', '".$idConcept."', '".$idInnvoice."', '".$dateIncome."', '".$valueIncome."', '".$payType."', '".$fromIncome."', '".$descriptionIncome."', '".$date."') ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->insert($sql);
    }
    
    public static function getMaxNumIncome($idBuilding){
        $sql = "SELECT MAX(`number_income`) FROM `income` WHERE `id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $sentence = $result->fetch_row();
        return $sentence[0];
    }
    
    public static function selectIncome($idIncome){
        $sql = "SELECT * FROM `income` WHERE `id_income` = '".$idIncome."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    public static function updateIncome($idIncome, $idConcept, $idInnvoice, $dateIncome, $value, $payType, $from, $description){
        $sql = "UPDATE `income` SET `id_concept` = '".$idConcept."', `id_innvoice` = '".$idInnvoice."', `date_income` = '".$dateIncome."', `value` = '".$value."', `id_pay_type` = '".$payType."', `from` = '".$from."', `description_income` = '".$description."' WHERE `income`.`id_income` = '".$idIncome."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->update($sql);
    }
    
    public static function deleteIncome($idIncome){
        $sql = "DELETE FROM `income` WHERE `income`.`id_income` = '".$idIncome."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->delete($sql);
    }
    
}
?>

