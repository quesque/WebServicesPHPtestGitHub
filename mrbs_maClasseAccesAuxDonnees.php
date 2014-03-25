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

include_once('TypeOrganisme.php');
include_once('Organisme.php');

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
 * Retourne le nombre de réunion pour l'organisme en fonction de l'heure
 * de demande
 * 
 * @param $idOrganisme
 * @return le nombre de réunion
*/
            
	public function getLesReunions($idOrganisme){
           
		$req = "select count(*) as nb 
            from  mrbs_users u inner join mrbs_entry e on  u.name = e.create_by
            where u.organisme =$idOrganisme and date(from_unixtime(start_time)) = curdate()";
		$res = MonPDO::$monPdo->query($req);
		
                 $laLigne = $res->fetch();
               
               
                    
               
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif tous
 * les organismes correspondants à un type

 *  * @param $idTypeOrganisme
 * @return l'id, le nom et le numéro de type sous la forme d'un tableau associatif 
*/
	public function getLesOrganismes ($idTypeOrganisme){
		$req = "select id,nom from organisme 
		where type ='$idTypeOrganisme'  
		order by nom";	
		$res = MonPDO::$monPdo->query($req);
		$lesLignes = $res->fetchAll(PDO::FETCH_CLASS, "OrganismeEnPHP");
		return $lesLignes; 
	}
        
      
/**
 * Retourne tous les types d'organismes
 
 * @return un tableau associatif 
*/
	public function getLesTypesOrganismes(){
		try{
                $req = "select * from type_organisme t order by id";
		$res = MonPDO::$monPdo->query($req);
		//$lesLignes = $res->fetchAll();
                
                
                //$res= MonPDO::$monPdo->prepare($req);
                //$res->execute();

               $lesLignes = $res->fetchAll(PDO::FETCH_CLASS, "TypeOrganismeEnPHP");
                
              /*$lesLignes[0]="association";
                $lesLignes[1]="ligue";
                 $lesLignes[2]="comité départemental";*/
                }
                catch (Exception $e){
                    echo 'erreur. Impossible de récupérer les types d\'organismes';
                }
		return $lesLignes;
	}
/**
 * Ajout du digicode
 * La vérification de l'existence d'une réunion pour l'organisme reçu en paramètre
 * doit avoir été faite au préalable
 * L'id organisme doit être correct
 * @param $idOrganisme
 * 
 * @return un tableau associatif contenant le digicode, le batiment et la salle
*/
	public function ajoutDigicode($idOrganisme){
		
		
                //gestion du digicode
                $lecode=rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9).''.rand(1,9);
                
                $req = "insert into digicode(digicodeActif, heureAttribution) 
		values('$lecode',current_time())";
                    try{
                            MonPDO::$monPdo->exec($req);
                    }
                    catch (Exception $e){
                        echo 'erreur pour insertion digicode';
                    }
                   
                
                
                $req = "select distinct b.description as batiment, r.room_name as salle
                from mrbs_room r inner join  batiment b on r.batiment = b.id 
                inner join mrbs_entry e on e.room_id=r.id 
                inner join mrbs_users u on u.name = e.create_by
                where u.organisme ='$idOrganisme' and date(from_unixtime(start_time)) = curdate() ";
              
		$res = MonPDO::$monPdo->query($req);
                $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
		        
                 
                    
                
                
		$lesLignes['digicode']=$lecode;	
		return $lesLignes; 
                
		
	}
        
 

}
?>