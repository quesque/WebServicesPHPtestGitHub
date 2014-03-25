<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class MonPDO{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=mrbs';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
        private static $monPdo;
        private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	MonPDO::$monPdo = new PDO(MonPDO::$serveur.';'.MonPDO::$bdd, MonPDO::$user, MonPDO::$mdp); 
		MonPDO::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		MonPDO::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(MonPDO::$monPdoGsb==null){
			MonPDO::$monPdoGsb= new MonPDO();
		}
		return MonPDO::$monPdoGsb;  
	}


/**
 * Retourne tous les types d'organismes
 
 * @return un tableau associatif 
*/
	public function getLesTypesOrganismes(){
		try{
                $req = "select * from type_organisme t order by id";
		$res = MonPDO::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
                }
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer les types d\'organismes';
                }
		return $lesLignes;
	}
/**
 * création des services
 */



}

ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0'); 
$wsdl='descriptionDeMesServicesWebBDD.wsdl';
$server = new SoapServer($wsdl);
$server->setClass("MesServicesBDD");
$server->handle();
?>