<?php

/**
 * Description of ModelConfigProfile
 * Methosd related to the Model Config Profile
 * @author MiOficina.co
 */

require_once getcwd().'/../dao/DAOEngineGlobal.php';
include_once getcwd().'/../dao/DAOEngineConfigProfile.php';

class ModelConfigProfile {

    /**
     * Method that calls getModules method of the DAOEngineConfigProfile class
     * @return array
     */
    public function getModules(){
        return DAOEngineConfigProfile::getModules();
    }

    /**
     * Method that select all the services depending of the idUser parameter
     * @param type $idUser
     * @return array
     */
    public function getServicesForUser($idBuilding, $idUserType){
        $listItemServices = DAOEngineConfigProfile::getListServices($idUserType, $idBuilding);
        $listDataServices = array();
        if($listItemServices != false){
            $arrayListItemExplode = explode(';', $listItemServices['list_id_services']);
            foreach ($arrayListItemExplode as $idService) {
                if($idService != ''){                    
                    array_push($listDataServices, DAOEngineConfigProfile::getDataForService($idService));
                }
            }
            return $listDataServices;
        }
        return array('servicesList' => false);
    }    
}

?>
