<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'mrbs_maClasseAccesAuxDonnees.php';
include_once 'TypeOrganisme.php';
/**
 * Description of MesServices
 *
 */
class MesServices {
    
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
    
    /**
     * appel de la méthode getLesTypesOrganismes de la classe MPDO
     *
     * @return les types d'organismes sous forme de tableau
     */
    function getLesTypesOrganismesWS()
    {
        $pdo = MonPDO::getPdoGsb();
        $lesTypesOrganisme = $pdo->getLesTypesOrganismes();

        
        return $lesTypesOrganisme;

    }
    
     function getLesOrganismesWS($idOrganisme)
    {
        $pdo = MonPDO::getPdoGsb();
        $lesTypesOrganisme = $pdo->getLesOrganismes($idOrganisme);
        return $lesTypesOrganisme;

    }
    
    
    function affecteDigicode($idOrganisme){
        
         $pdo = MonPDO::getPdoGsb();
         $lesInfos=  $pdo->ajoutDigicode($idOrganisme);
         return $lesInfos;
    }
    
    function getLesreunionsWS($idOrganisme){
        
         $pdo = MonPDO::getPdoGsb();
         $lesReunions = $pdo->getLesReunions($idOrganisme);
         $nb = $lesReunions['nb'];
         return $nb;
    }
    
}
/**
 * création des services
 */

ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0'); 
$wsdl='descriptionDeMesServicesWebv5.wsdl';
//$classmap=array('typeOrganismeInWSDL'=>'TypeOrganismeEnPHP');
//$options= array('classmap'=>$classmap);
//$server = new SoapServer($wsdl,$options);
$server = new SoapServer($wsdl);
$server->setClass("MesServices");
$server->handle();

?>
