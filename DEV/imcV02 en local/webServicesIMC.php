<?php


/**
 * Description of MesServices
 *
 */
class MesServices {
    
    /**
     * renvoie le calcul de l'imc en fonction du poids et de la taille
     * @param le poids en kilo
     * @param la taille en centimètres
     * @return l'imc
     */
    function getImc($poids, $taille)
    {
        $taille = $taille/100;
       $imc= ($poids / ($taille * $taille));
       
        return $imc;
    }
    
   
    
}
/**
 * création des services
 */

ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0'); 
$wsdl='imc.wsdl';
$server = new SoapServer($wsdl);
$server->setClass("MesServices");
$server->handle();

?>
