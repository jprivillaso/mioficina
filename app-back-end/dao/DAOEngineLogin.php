<?php

/**
 * Description of DAOEngineLogin
 * methods related to the DAO Engine Login
 * @author MiOficina.co
 */
include_once getcwd().'/../mysqlDBC/MysqlDBC.php';

class DAOEngineLogin {

    /**
     * Method that select datas from a user to log in
     * @param type $buildingNick
     * @param type $userNick
     * @param type $userPassword
     * @return array
     */
    public static function LoginIn($userEmail, $userPassword){
        $sql = "SELECT * FROM `user` WHERE `password` = '".$userPassword."' AND `email` = '".$userEmail."' AND `is_removed` = '0' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $arrayResults = array();
        while($row = $result->fetch_assoc()){
            //each building
            $idUser = $row['id_user'];
            $idBulding = $row['id_building'];
            $profiles = DAOEngineLogin::getListProfiles($idUser);
            array_push($arrayResults, array('dataUser' => $row, 'infoBuilding' => DAOEngineLogin::getDataBuilding($idBulding), 'profiles' => $profiles));
        }
        return $arrayResults;
    }
    
    //ok
    public static function getListProfiles($idUser){
        $listProfiles = DAOEngineGlobal::getDataProfileByIdUser($idUser);
        $results = array();
        foreach ($listProfiles as $profile) {
            $idUserType = $profile['id_user_type'];
            $infoUserType = DAOEngineLogin::getInfoTypeUser($idUserType);
            array_push($results, array('profile' => $profile, 'userType' => $infoUserType));
        }
        return $results;
    }


    /*public static function getBuldingsProfileByUser($idUser){
        $sql = "SELECT *
                    FROM `profile`
                        WHERE `id_user` = '".$idUser."'
                            GROUP BY `id_building` ";
        $results = array();
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        while($row = $result->fetch_assoc()){
            $idBuilding = $row['id_building'];
            array_push($results, DAOEngineLogin::getInfoBuldingProfileByIdBuilding($idUser, $idBuilding));
        }
        return $results;
    }
    
    public static function getInfoBuldingProfileByIdBuilding($idUser, $idBuilding){
        $sql = "SELECT * FROM `profile` WHERE `id_user` = '".$idUser."' AND `id_building` = '".$idBuilding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while($row = $result->fetch_assoc()){
            $idTypeUser = $row['id_user_type'];
            $idProfile = $row['id_profile'];
            array_push($results, array('idProfile' => $idProfile, 'dataTypeUser' => DAOEngineLogin::getInfoTypeUser($idTypeUser)));
        }
        return array('dataBuilding' => DAOEngineLogin::getDataBuilding($idBuilding), 'typeUser' => $results);
    }*/
    
    
    //ok
    public static function getDataBuilding($idBulding){
        $sql = "SELECT * FROM `building` WHERE `id_building` = '".$idBulding."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    //ok
    public static function getInfoTypeUser($idTypeUser){
        $sql = "SELECT * FROM `usertype` WHERE `id_usertype` = '".$idTypeUser."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }
    
    public static function changePassword($email, $password){
        $sql = "UPDATE `user` SET `password` = '".$password."' WHERE `user`.`email` = '".$email."' ";
        $mysqlDBC = new MysqlDBC();
        return $mysqlDBC->update($sql);
    }
            
    public static function checkAccount($buildingNick, $userNick, $key){
        /*
        $idUnit = DAOEngineRegister::getFieldByUnit($nickUnit, 'idUnit');
        $sql = "SELECT *
                    FROM `user`
                        WHERE `idUnit` = '".$idUnit."'
                            AND `nick` = '".$userUser."'
                            AND `key` = '".$key."' ";
        $query = mysql_query($sql);
        $name = mysql_result($query, 0, 'name');
        $idUser = mysql_result($query, 0, 'idUser');
        if($name != false){
           $sql2 = "UPDATE `user` SET `isValidated` = '1' WHERE `user`.`idUser` = '".$idUser."' ";
           mysql_query($sql2);
        }
         * 
         */
        //return $name;
    }
    
}

?>
