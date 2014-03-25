<?php
include_once 'global/config.php';
include_once CHEMIN_LIB.'pdo2.php';

class Digicode {
    public $id;
    public $digicodeActif;
    public $heureAttribution;


function ajouter_digicode_dans_bdd($digicode)
{
    $pdo = PDO2::getInstance();
    
    $requete = $pdo->prepare("insert into digicode(digicodeActif, heureAttribution) 
		values(:digicode,current_time())");
    
    
     $requete->bindValue(':digicode', $digicode);
    
    try{
           
                    
   
    
    $requete->execute(); 
    return true;
    }
                    catch (Exception $e){
                        echo 'erreur pour insertion digicode';
                        return false;
                    }
     
     
    
}


        
        






}
?>
