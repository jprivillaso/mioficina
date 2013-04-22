<?php

header('Content-type: text/html; charset=utf-8');
include_once getcwd() . '/../model/ModelCommunication.php';

// Define a destination

@$idBuilding = $_REQUEST['idBuilding'];
@$idTypeCommunication = $_REQUEST['idTypeCommunication'];
@$idCommunication = $_REQUEST['idCommunication'];


if (isset($idBuilding) && isset($idTypeCommunication) && isset($idCommunication)) {
    
    $modelCommunication = new ModelCommunication();
    $infoFolder = $modelCommunication->getPathFolderFiles($idBuilding, $idTypeCommunication);
    
    $targetFolder = '/static-office/uploads/' . $infoFolder['result']['folder'];
    
    if (!empty($_FILES)) {
        $tempFile = $_FILES['Filedata']['tmp_name'];
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
        $targetName = $_FILES['Filedata']['name'];
        $targetFile = rtrim($targetPath, '/') . '/' . $infoFolder['result']['date'] . '' . $infoFolder['result']['key'] . $_FILES['Filedata']['name'];
        $targetComplete = $targetFolder . '' . $infoFolder['result']['date'] . '' . $infoFolder['result']['key'] . $_FILES['Filedata']['name'];

        // Validate the file type
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'xlsm', 'pps', 'ppt', 'pptx', 'zip', 'rar'); // File extensions
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        
        if (in_array($fileParts['extension'], $fileTypes)) {
            if (is_dir($targetPath)) {
                //exist!
                move_uploaded_file($tempFile, $targetFile);
                $modelCommunication->insertFile($idCommunication, $targetName, $targetComplete);
                echo '1';
            } else {
                if (!mkdir($targetPath, 0777, true)) {
                    echo '0';
                } else {
                    move_uploaded_file($tempFile, $targetFile);
                    $modelCommunication->insertFile($idCommunication, $targetName, $targetComplete);
                    echo '1';
                }
            }
        } else {
            echo 'Invalid file type.';
        }
    }
}else{
    echo '-1';
}


?>