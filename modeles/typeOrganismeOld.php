<?php
function lire_infos_typeOrganisme($id) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("SELECT intitule
                              FROM typeOrganisme
                              WHERE id = :id");
    $requete->bindValue(':id', $id);
    $requete->execute();
    
    $result = $requete->fetch(PDO::FETCH_ASSOC);
    if($result) {
        $requete->closeCursor();
        return $result;
    }
    return false;
}



function charger_typeOrganisme(){
   	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT id, intitule FROM type_Organisme");
	
	$requete->execute();
        $tab = $requete->fetchAll();
			
	$requete->closeCursor();
        return $tab;
}
?>
