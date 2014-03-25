<?php

class Categorie {
    public $id;
    public $libelle;



function lire_infos_categorie($id) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("SELECT libelleCategorie
                              FROM categorie
                              WHERE idCategorie = :id");
    $requete->bindValue(':id', $id);
    try{
        $requete->execute();
    
         $id = $requete->fetch();
         return $id['libelleCategorie'];
    }
     
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer les types d\'organismes';
                    return false;
                }
    
    
}



function ajouter_categorie_dans_bdd($id, $libelle)
{
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("INSERT INTO categorie Values(
    :id,
    :libelle
    )");
    $requete->bindValue(':id', $id);
    $requete->bindValue(':libelle', $libelle);
    $requete->execute(); 

}



function charger_categorie(){
   	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT idCategorie as id , libelleCategorie as libelle FROM categorie");
	
	$requete->execute();
        
        $tab = $requete->fetchAll(PDO::FETCH_CLASS, "Categorie");
     
	$requete->closeCursor();
        return $tab;
}
}
?>
