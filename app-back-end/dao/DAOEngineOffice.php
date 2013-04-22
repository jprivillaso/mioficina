<?php

/**
 * Description of DAOEngineProperty
 *
 * @author Mioficina.co
 */
include_once getcwd() . '/../mysqlDBC/MysqlDBC.php';

class DAOEngineOffice {

    /**
     * @Description: This method returns all the offices associated with 
     * a building
     * @param type $id_user
     * @param type $numPage
     * @param type $sizePage
     * @return array
     */
    public static function getOfficesByBuilding($idBuilding, $numPage, $sizePage) {
        $sql = "SELECT * FROM `office`
                    WHERE `id_building` = '" . $idBuilding . "' 
                        AND `is_removed` = 0
                            ORDER BY `id_office` ASC
                                LIMIT " . ($numPage * $sizePage) . " , " . (($numPage * $sizePage) + $sizePage ) . " ";

        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            array_push($results, $row);
        }

        $sql2 = "SELECT COUNT(`id_office`) FROM `office` WHERE `id_building` = '" . $idBuilding . "' AND `is_removed` = 0";

        $total = DAOEngineGlobal::getTotalRecords($sql2);
        return array('listOffices' => $results, 'totalOffices' => $total);
    }

    public static function getDataOffice($idOffice) {
        $sql = "SELECT * FROM `office`
                    WHERE `id_office` = '" . $idOffice . "'";

        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }

    public static function getUserByOffice($idOffice, $idTypeUser) {
        $resultOwners = DAOEngineGlobal::getDataOwnerByOffice($idOffice);
        $results = array();
        foreach ($resultOwners as $itemOwner) {
            $idProfile = $itemOwner['id_profile'];
            $dataProfile = DAOEngineGlobal::getDataProfileByIdProfile($idProfile);
            if ($dataProfile['id_user_type'] == $idTypeUser) {
                $idUser = $dataProfile['id_user'];
                $sql = "SELECT * FROM `user` 
                            WHERE `id_user` = '" . $idUser . "'";
                $mysqlDBC = new MysqlDBC();
                $result = $mysqlDBC->select($sql);
                array_push($results, array('idOffice' => $idOffice, 'dataProfile' => $dataProfile, 'dataUser' => $result->fetch_assoc()));
            }
        }
        return $results;
    }

    public static function getOfficeByUser($idUserProfile) {
        $dataOwners = DAOEngineGlobal::getDataOwner($idUserProfile);
        $results = array();
        foreach ($dataOwners as $item) {
            $idOffice = $item['id_office'];
            $sql = "SELECT * FROM `office` 
                        WHERE `id_office` = '".$idOffice."' 
                            AND `is_removed` = 0";
            $mysqlDBC = new MysqlDBC();
            $result = $mysqlDBC->select($sql);
            array_push($results, $result->fetch_assoc());
        }
        return $results;
    }

    public static function updateOffice($idOffice, $description, $isOccupied, $dimensions, $phone, $officeNumber) {

        $sql = "UPDATE `office` SET `description` = '" . $description . "' 
        , `is_occupied` = '" . $isOccupied . "', `dimensions` = '" . $dimensions . "',
            `phone` = '" . $phone . "', `office_number` = '" . $officeNumber . "'
                    WHERE `id_office` = '" . $idOffice . "'";

        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->update($sql);
        return $result;
    }

    public static function insertOffice($idBuilding, $description, $isOccupied, $dimensions, $phone, $officeNumber) {
        $sql = "INSERT INTO `office`(`description`,`phone`,`is_occupied`,`dimensions`,`id_building`,`office_number`, `is_removed`)
                    VALUES ('".$description."', '".$phone."', '".$isOccupied."', '".$dimensions."', '".$idBuilding."' , '".$officeNumber."', '0')";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->insert($sql);
        return $result;
    }

    public static function deleteOffice($idOffice) {
        $sql = "UPDATE `office` SET `is_removed` = 1 
                    WHERE `id_office` = '" . $idOffice . "'";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->delete($sql);
        return $result;
    }

}
?>

