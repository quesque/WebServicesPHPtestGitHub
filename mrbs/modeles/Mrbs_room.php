<?php
include_once 'global/config.php';
include_once CHEMIN_LIB.'pdo2.php';

class Mrbs_room {
    public $id;
    public $intitule;



function getNomRoom($id) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("SELECT room_name
                              FROM mrbs_room
                              WHERE id = :id");
    $requete->bindValue(':id', $id);
    try{
        $requete->execute();
    
         $id = $requete->fetch();
         return $id['room_name'];
    }
     
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer la salle';
                    return false;
                }
    
    
}


}
?>
