<?php
include_once 'global/config.php';
include_once CHEMIN_LIB.'pdo2.php';

class Organisme {
    public $id;
    public $intitule;



function lire_infos_organisme($id) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("SELECT nom
                              FROM organisme
                              WHERE id = :id");
    $requete->bindValue(':id', $id);
    try{
        $requete->execute();
    
         $id = $requete->fetch();
         return $id['nom'];
    }
     
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer l\'organisme';
                    return false;
                }
    
    
}

function charger_organismePourUnType($typeOrganisme){
   	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT id , nom as intitule FROM organisme
                                    WHERE type= :typeOrganisme");
	
        
        $requete->bindValue(':typeOrganisme', $typeOrganisme);
        
        try {
	$requete->execute();
        
        $tab = $requete->fetchAll(PDO::FETCH_CLASS, "Organisme");
     
	$requete->closeCursor();
        return $tab;
        }
        catch (Exception $e){
                    echo 'erreur. Impossible de récupérer l\'organisme';
                    return false;
        }
        
        
}




function charger_organisme(){
   	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT id , nom as intitule FROM organisme");
	
	$requete->execute();
        
        $tab = $requete->fetchAll(PDO::FETCH_CLASS, "Organisme");
     
	$requete->closeCursor();
        return $tab;
}
}
?>
