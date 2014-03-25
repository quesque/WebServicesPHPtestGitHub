<?php

class Objet {
    public $id;
    public $libelle;



function charger_objet_par_categorie($id) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("SELECT idObjet as id, description as libelle
                              FROM objet
                              WHERE idCategorie = :id");
    $requete->bindValue(':id', $id);
    try{
        $requete->execute();
    
        $tab = $requete->fetchAll(PDO::FETCH_CLASS, "Objet");
     
	$requete->closeCursor();
        return $tab;
    }
     
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer les objets pour cette catégorie';
                    return false;
                }
    
    
}



}
?>
