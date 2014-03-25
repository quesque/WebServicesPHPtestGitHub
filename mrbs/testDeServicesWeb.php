<?php
$adresseServeur = 'http://localhost/WebServicesPHP/mrbs/MesServicesOO.php?wsdl';
//$adresseServeur = 'http://192.168.10.27/WebServicesPHP/MesServices.php?wsdl';



function testAccesMesServicesOO ($adresseServeur)
{
  $client = new SoapClient($adresseServeur);
  var_dump($client->__getFunctions());
  var_dump($client->__getTypes());
}

  
  function testGetDigicode($adresseServeur){
  $client = new SoapClient($adresseServeur);
  try {
    echo "le code est ";
    print($client->getDigicode());
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
  }

/*
 * TEST DU SERVICE getLesOrganismesWS serveur Web local OK / serveur distant OK
 */

function testGetLesOrganismesWS($adresseServeur){
 $client = new SoapClient($adresseServeur);
  try {
    echo "les organismes sont :<br />";
    $lesTypes = $client->getLesOrganismesWS(1);
  foreach ($lesTypes as $unType)
    {
    $id = htmlentities($unType->id,null,"UTF-8");
    $intitule = htmlentities($unType->intitule,null,"UTF-8");
    echo 'identifiant : '.$id.' intitule : '.$intitule.'<br />';
    }
  }
  
  catch (SoapFault $exception) {
    echo $exception->__toString();
  }

}

/*
 * TEST DU SERVICE getLesTypesOrganismesWS serveur Web local OK / serveur distant OK
 * VERSION OBJET
 */
  
function testGetLesTypesOrganismesWS($adresseServeur){
 $client = new SoapClient($adresseServeur);
  try {
     
    echo "les types d'organismes sont <br />";
    $lesTypes = $client->getLesTypesOrganismesWS();
   foreach ($lesTypes as $unType)
{
   $id = htmlentities($unType->id,null,"UTF-8");
    $intitule = htmlentities($unType->intitule,null,"UTF-8");
    echo 'identifiant : '.$id.' intitule : '.$intitule.'<br />';
}
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
}

  
/*
 * TEST DU SERVICE affecteDigicode serveur Web local OK / serveur distant OK
 * 
 */
  
function testAffecteDigicode($adresseServeur,$idOrganisme) {
 $client = new SoapClient($adresseServeur);
  try {
   
    //ATTENTION : tester avec un organisme qui a une réunion réservée aujourd'hui
    //TODO mettre une (ou plusieurs instructions) insert qui ajoute une réservation à la date du jour
    $lesTypes = $client->affecteDigicode($idOrganisme);
  
    if ($lesTypes[2] == "accès non autorisé") {
        echo 'Pas de réunion. Accès non autorisé';
    }
    else {
         echo "les infos sont <br />";
//    echo htmlentities($lesTypes['batiment'],null,"UTF-8").'<br />'.
//            ' salle : '.htmlentities($lesTypes['salle'],null,"UTF-8").'<br />'.
//            'digicode : '.htmlentities($lesTypes['digicode'],null,"UTF-8").'<br />';
     echo htmlentities($lesTypes[0],null,"UTF-8").'<br />'.
            ' salle : '.htmlentities($lesTypes[1],null,"UTF-8").'<br />'.
            'digicode : '.htmlentities($lesTypes[2],null,"UTF-8").'<br />';
    }
   
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
}
  
/*
 * TEST DU SERVICE getLesReunionsWS() serveur Web local
 */
function testGetLesReunions($adresseServeur,$idOrganisme){
  $client = new SoapClient($adresseServeur);
 
  try {
    echo "le nombre de reunion pour l'organisme numero $idOrganisme est : ";
    print($client->getLesReunionsWS($idOrganisme));
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }

}



testAccesMesServicesOO($adresseServeur);
//testGetLesTypesOrganismesWS($adresseServeur);
//testGetDigicode($adresseServeur);
//testGetLesOrganismesWS($adresseServeur);
// RESTE A TESTER AFFECTEDIGICODE

//créer une réunion pour l'organisme  à la date du jour avant de lancer le test
// utilisateur gaigar/mot de passe : passe appartient à organisme 1
// utilisateur glavork/mot de passe : passe appartient à organisme 2
//testGetLesReunions($adresseServeur, 1);
testAffecteDigicode($adresseServeur, 2);
testAffecteDigicode($adresseServeur, 3);
?>
