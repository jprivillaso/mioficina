<?php

/**
 * Description of DAOEngineUser
 * Methods related to the DAO Engine User
 * @author Mioficina.co
 */

include_once getcwd().'/../mysqlDBC/MysqlDBC.php';


class DAOEngineUser {

    public static function getUsersByBuilding($idBuilding, $userType, $numPage, $sizePage){
        $sql = '';
        $sql2 = '';
        if($userType == NULL){
            $sql = "SELECT *
                        FROM `profile` , `user`
                            WHERE `user`.`id_user` = `profile`.`id_user`
                                AND `profile`.`id_building` = '".$idBuilding."'
                                     AND `profile`.`is_removed` = 0
                                        GROUP BY `user`.`id_user` ";
            if(isset($numPage)){
                $sql .= " LIMIT ".($numPage * $sizePage).", ".(($numPage * $sizePage) + $sizePage )." ";
            }
            
            $sql2 = "SELECT COUNT(`user`.`id_user`) FROM `profile` , `user` WHERE `user`.`id_user` = `profile`.`id_user` AND `profile`.`id_building` = '".$idBuilding."' AND `profile`.`is_removed` = 0 GROUP BY `user`.`id_user` ";
        }else{
            $sql = "SELECT *
                        FROM `profile` , `user`
                            WHERE `user`.`id_user` = `profile`.`id_user`
                                AND `profile`.`id_building` = '".$idBuilding."'
                                     AND `profile`.`is_removed` = 0 AND `profile`.`id_user_type` = '".$userType."'
                                        GROUP BY `user`.`id_user` ";
            if(isset($numPage)){
                $sql .= " LIMIT ".($numPage * $sizePage).", ".(($numPage * $sizePage) + $sizePage )." ";
            }
            
            $sql2 = "SELECT COUNT(`user`.`id_user`) FROM `profile` , `user` WHERE `user`.`id_user` = `profile`.`id_user` AND `profile`.`id_building` = '".$idBuilding."' AND `profile`.`is_removed` = 0 AND `profile`.`id_user_type` = '".$userType."' GROUP BY `user`.`id_user` ";
        }
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while($row = $result->fetch_assoc()){
            array_push($results, $row);
        }
        $totalRecords = DAOEngineGlobal::getTotalRecords($sql2);
        return array('listUsers' => $results, 'totalUsers' => $totalRecords);
    }
    
    public static function getUsersByBuildingNoOwner($idBuilding, $idOffice, $userType){
        $infoAllUsers = DAOEngineUser::getUsersByBuilding($idBuilding, $userType);
        $listUsers = $infoAllUsers['listUsers'];
        $dataOwnersOffice = DAOEngineGlobal::getDataOwnerByOffice($idOffice);
        $results = array();
        foreach ($listUsers as $itemUser){
            $flag = true;
            foreach($dataOwnersOffice as $itemOwner){
                if($itemUser['id_profile'] == $itemOwner['id_profile']){
                    $flag = false;
                    break;
                }
            }
            if($flag){
                array_push($results, $itemUser);
            }
        }
        return $results;
    }
    
    public static function selectUserByType($idBuilding, $userType){
        $sql = "SELECT * FROM `profile` , `user` WHERE `profile`.`id_user` = `user`.`id_user` AND `profile`.`id_user_type` = '".$userType."' AND `user`.`id_building` = '".$idBuilding." '";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while($row = $result->fetch_assoc()){
            array_push($results, $row);
        }        
        return $results;
    }
    
    public static function selectTypeUserById($idTypeUser){
        $sql = "SELECT * FROM `usertype` WHERE `id_usertype` = '".$idTypeUser."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        return $result->fetch_assoc();
    }

    public static function getAllUserType($idBuilding){
        $sql ="SELECT * FROM `usertype`";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $results = array();
        while($row = $result->fetch_assoc()){
            array_push($results, $row);
        }        
        return $results;
    }
    
    public static function getInfoUserByEmail($email, $idBuilding){
        $sql = "SELECT * FROM `user` WHERE `email` = '".$email."' AND `is_removed` = 0 ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->select($sql);
        $resultUserData = $result->fetch_assoc();
        if($resultUserData != null){
            $idUser = $resultUserData['id_user'];
            $dataProfileByIdUser = DAOEngineGlobal::getDataProfileByIdUser($idUser);
            if(isset($idBuilding)){
                foreach($dataProfileByIdUser as $itemDataProfile){
                    if($itemDataProfile['id_building'] == $idBuilding){
                        return array('userData' => $resultUserData, 'dataProfile' => $dataProfileByIdUser, 'userInBuilding' => true);
                    }
                }
                return array('userData' => $resultUserData, 'dataProfile' => $dataProfileByIdUser, 'userInBuilding' => false);
            }
            return array('userData' => $resultUserData, 'dataProfile' => $dataProfileByIdUser);
        }
        return null;        
    }

    public static function insertUser($identification, $idBuilding, $name, $nick, $password, $email, $key, $homePhone, $celPhone, $officePhone){
        //To insert a new user into the user table
        $sql = "INSERT INTO `user` (`id_user`, `id_building`, `identification`, `name`, `nick`, `password`, `email`, `key`, `is_validated`, `home_phone`, `cel_phone`, `office_phone`, `is_removed`) VALUES (NULL, '".$identification."', '".$idBuilding."', '".$name."', '".$nick."', '".$password."', '".$email."', '".$key."', '0', '".$homePhone."', '".$celPhone."', '".$officePhone."', '0');";        
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->insert($sql);
        return $result;
    }

    public static function updateUser($idUser, $identification, $name, $email, $homePhone, $celPhone, $officePhone){
        $sql = "UPDATE `user` SET `identification` = '".$identification."', `name`='".$name."', `email`='".$email."', `home_phone`= '".$homePhone."', `cel_phone` = '".$celPhone."', `office_phone`= '".$officePhone."' WHERE `id_user` = '".$idUser."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->update($sql);
        return $result;
    }
    
    public static function updateUserMe($idUser, $identification, $name, $nick, $email, $homePhone, $celPhone, $officePhone){
        $sql = "UPDATE `user` SET `identification` = '".$identification."', `name`='".$name."', `nick`='".$nick."', `email`='".$email."', `home_phone`= '".$homePhone."', `cel_phone` = '".$celPhone."', `office_phone`= '".$officePhone."' WHERE `id_user` = '".$idUser."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->update($sql);
        return $result;
    }
    
    public static function deleteUser($idUser){
        $sql = "UPDATE `user` SET `is_removed` = '1' WHERE `user`.`id_user` = '".$idUser."' ";
        $mysqlDBC = new MysqlDBC();
        $result = $mysqlDBC->update($sql);
        return $result;
    }
    
    
    public static function insertUserType($name, $idUser){
        /*$datasUser = DAOEngineGlobal::getDataIdUser($idUser);
        $idBuilding = $datasUser['id_building']        
        $sql = "INSERT INTO `usertype`(`name`, `idUnit`) VALUES
                    ('".$name."','".$idBuilding."')";
        return $query = mysql_query($sql);*/
    }
}

?>