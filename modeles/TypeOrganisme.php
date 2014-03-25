<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypeOrganisme
 *
 * @author LAM
 */
class TypeOrganisme {
    //put your code here
    public $id;
    public $intitule;
    
    
    
    
    function lire_infos_typeOrganisme($id) {
    
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("SELECT intitule
                              FROM typeOrganisme
                              WHERE id = :id");
    $requete->bindValue(':id', $id);
    try{
        $requete->execute();
    
         $id = $requete->fetch();
         return $id['intitule'];
    }
     
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer l\'organisme';
                    return false;
                }
}



function charger_typeOrganisme(){
   	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT id, intitule FROM type_Organisme");
	
	$requete->execute();
        $tab = $requete->fetchAll(PDO::FETCH_CLASS, "TypeOrganisme");
			
	$requete->closeCursor();
        return $tab;
        
        
       
        
        
}
    
}

?>
