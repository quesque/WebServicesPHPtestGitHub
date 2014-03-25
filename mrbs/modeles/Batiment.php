<?php
include_once 'global/config.php';
include_once CHEMIN_LIB.'pdo2.php';

class Batiment {
    public $id;
    public $intitule;



function getNombatiment($id) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("SELECT description
                              FROM batiment
                              WHERE id = :id");
    $requete->bindValue(':id', $id);
    try{
        $requete->execute();
    
         $id = $requete->fetch();
         return $id['description'];
    }
     
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer le batiment';
                    return false;
                }
    
    
}


}
?>
