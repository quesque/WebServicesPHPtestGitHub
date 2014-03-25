<?php
include_once 'global/config.php';
include_once CHEMIN_LIB.'pdo2.php';





function getNbReunionsNowPourUnOrganisme($idOrganisme) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("select count(*) as nb 
            from  mrbs_users u inner join mrbs_entry e on  u.name = e.create_by
            where u.organisme =:idOrganisme and date(from_unixtime(start_time)) = curdate()");
    
    $requete->bindValue(':idOrganisme', $idOrganisme);
    try{
        $requete->execute();
    
         $nbReunion = $requete->fetch();
         return $nbReunion['nb'];
    }
     
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer le nombre de réunion';
                    return false;
                }
    
    
}

function getSalleNowPourUnOrganisme($idOrganisme) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("select distinct room_id as id 
            from  mrbs_users u inner join mrbs_entry e on  u.name = e.create_by
            where u.organisme =:idOrganisme and date(from_unixtime(start_time)) = curdate()");
    
    $requete->bindValue(':idOrganisme', $idOrganisme);
    try{
        $requete->execute();
    
         $nbReunion = $requete->fetch();
         return $nbReunion['id'];
    }
     
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer la salle';
                    return false;
                }
    
    
}




?>
