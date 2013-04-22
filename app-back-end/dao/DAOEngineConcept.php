<?php

/**
 * Description of DAOEngineProperty
 *
 * @author Mioficina.co
 */
include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineConcept {

    public static function selectConceptsByTypePagging($idBuilding, $typeConcept, $min, $max) {
        $sql = "SELECT *
                    FROM `concept`
                            WHERE `id_building` = '".$idBuilding."'
                                AND `type_concept` = '".$typeConcept."' 
                                    LIMIT ".$min." , ".$max." ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            array_push($results, $row);
        }
        
        $sql2 = "SELECT COUNT(`id_concept`) FROM `concept` WHERE `id_building` = '".$idBuilding."' AND `type_concept` = '".$typeConcept."' ";

        $total = DAOEngineGlobal::getTotalRecords($sql2);
        return array('listConcepts' => $results, 'totalConcepts' => $total);
    }
    
    public static function selectConceptsByType($idBuilding, $typeConcept) {
        $sql = "SELECT *
                    FROM `concept`
                            WHERE `id_building` = '".$idBuilding."'
                                AND `type_concept` = '".$typeConcept."' ORDER BY `concept`.`name_concept` ASC ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            array_push($results, $row);
        }
        return $results;
    }
    
    public static function selectConceptById($idConcept){
        $sql = "SELECT * FROM `concept` WHERE `id_concept` = '".$idConcept."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }

    public static function insertConcept($nameConcept, $description, $idBuilding, $typeConcept){
        $sql = "INSERT INTO `concept` (`id_concept`, `name_concept`, `description`, `id_building`, `type_concept`) VALUES (NULL, '".$nameConcept."', '".$description."', '".$idBuilding."', '".$typeConcept."') ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->insert($sql);
    }
    
    public static function updateConcept($idConcept, $nameConcept, $description){
        $sql = "UPDATE `concept` SET `name_concept` = '".$nameConcept."', `description` = '".$description."' WHERE `concept`.`id_concept` = '".$idConcept."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->update($sql);
    }
    
}
?>

