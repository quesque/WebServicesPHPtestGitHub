<?php

/*
 * FAIRE LES INCLUDE DES CLASSES A UTILISER
 */
include_once 'global/config.php';
include_once CHEMIN_MODELE.'TypeOrganisme.php';
include_once CHEMIN_MODELE.'Organisme.php';
include_once CHEMIN_MODELE.'Digicode.php';
include_once CHEMIN_MODELE.'Autres.php';
include_once CHEMIN_MODELE.'Batiment.php';
include_once CHEMIN_MODELE.'Mrbs_room.php';
/**
 * Description of MesServices
 *
 */
class MesServices {
    
    
    function getLesTypesOrganismesWS()
    {
        $TypeOrganisme = new TypeOrganisme();
        $lesTypesOrganismes = $TypeOrganisme->charger_typeOrganisme();
        return $lesTypesOrganismes;
    }
    
    
    
    /**
     * affecte un digicode
     *
     * @return le digicode sous la forme de 6 chiffres
     */
    function getDigicode()
    {
       $lecode=rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
       
        return $lecode;
    }
    
   
    
     function getLesOrganismesWS($idOrganisme)    
    {
        $Organisme = new Organisme();
        $lesOrganismes =$Organisme->charger_organismePourUnType($idOrganisme);
        return $lesOrganismes;

    }
    
    
    function affecteDigicode($idOrganisme){
         
       
         $lecode=rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
         
         $Digicode = new Digicode();
         $digicodeOk=  $Digicode->ajouter_digicode_dans_bdd($lecode);
         if ($digicodeOk)
         {
             //recuperer id salle dans autres
             $idSalle = getSalleNowPourUnOrganisme($idOrganisme);
             
             if ($idSalle != false) {
                 //recuperer nom salle
                 $Salle = new Mrbs_room();
                 $nomSalle = $Salle->getNomRoom($idSalle);
                 if ($nomSalle != false){
                     //recuperer nom batiment
                     $Batiment = new Batiment();
                     $nomBatiment = $Batiment->getNombatiment($idSalle);
                     if ($nomBatiment==false){
                         $nomBatiment="obtention batiment impossible";
                     }
                 }
                 else {
                     $nomSalle="obtention salle impossible";
                    $nomBatiment="obtention batimentimpossible";
                 }
             
             }
             else {
                 $nomSalle="obtention salle impossible";
                 $nomBatiment="obtention batimentimpossible";
             }
                 
             
         }
         else {
             $lecode="obtention digicode impossible";
             $nomSalle="obtention salle impossible";
             $nomBatiment="obtention batimentimpossible";
         }
             
         
          
//         $lesInfos['digicode']=$lecode;
//         $lesInfos['batiment']=$nomBatiment;
//         $lesInfos['salle']=$nomSalle;
          $lesInfos[2]=$lecode;
        $lesInfos[0]=$nomBatiment;
         $lesInfos[1]=$nomSalle;
         return $lesInfos;
         
    }
    
    
    function getLesreunionsWS($idOrganisme){
         $lesReunions = getNbReunionsNowPourUnOrganisme($idOrganisme);
         return $lesReunions;
    }
    
     
    
    
    
}
/**
 * création des services
 */

ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0'); 
$wsdl='descriptionDeMesServicesWebvOO.wsdl';
$server = new SoapServer($wsdl);
$server->setClass("MesServices");
$server->handle();

?>
