<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'global/config.php';
include CHEMIN_LIB.'pdo2.php';
include CHEMIN_MODELE.'Categorie.php';
include CHEMIN_MODELE.'Objet.php';
$uneCategorie = new Categorie();

/**
 * Description of MesServices
 *
 */
class MesServices {
    
    
    
    /**
     * appel de la méthode 
     *
     * @return 
     */
    function getLibelleCategorie($id)
    {
       $uneCategorie = new Categorie();
        $laCategorie = $uneCategorie->lire_infos_categorie($id);
        
        return $laCategorie;

    }
    
    
     function setCategorie($id, $libelle)
    {
       $uneCategorie = new Categorie();
        $laCategorie = $uneCategorie->ajouter_categorie_dans_bdd($id, $libelle);
        
        return $laCategorie;

    }
    
     function getLesCategories()
    {
       $uneCategorie = new Categorie();
       $lesCategories = $uneCategorie->charger_categorie();
        
        return $lesCategories;

    }
    
    //ne pas fournir cette fonction dans la première version des ws
     function getLesObjetsParCategorie($id)
    {
       $unObjet = new Objet();
       $lesObjets = $unObjet->charger_objet_par_categorie($id);
        
        return $lesObjets;

    }
    
    
    
}
/**
 * création des services
 */

ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0'); 
$wsdl='fbay.wsdl';
$server = new SoapServer($wsdl);
$server->setClass("MesServices");
$server->handle();

?>
