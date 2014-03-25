<?php
$adresseServeur = 'http://localhost/WebServicesPHP/MesServices.php?wsdl';
//$adresseServeur = 'http://192.168.10.27/WebServicesPHP/MesServices.php?wsdl';

/*
 * TEST DU SERVICE getDigicode() serveur Web local OK / serveur distant OK
 */


  $client = new SoapClient($adresseServeur);
  var_dump($client->__getFunctions());
  var_dump($client->__getTypes());
  try {
    echo "le code est ";
    print($client->getDigicode());
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }


/*
 * TEST DU SERVICE getLesOrganismesWS serveur Web local OK / serveur distant OK
 */


 $client = new SoapClient($adresseServeur);
  try {
    echo "les organismes sont :<br />";
    $lesTypes = $client->getLesOrganismesWS(1);
   foreach ($lesTypes as $unType)
{
    $id = htmlentities($unType->id,null,"UTF-8");
    $intitule = htmlentities($unType->nom,null,"UTF-8");
    echo 'identifiant : '.$id.' intitule : '.$intitule.'<br />';
}
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }



/*
 * TEST DU SERVICE getLesTypesOrganismesWS serveur Web local OK / serveur distant OK
 * VERSION OBJET
 */
  
/*
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
  }*/

  /*
 * TEST DU SERVICE getLesTypesOrganismesWS serveur Web local OK / serveur distant OK
 */
  

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

/*
 * TEST DU SERVICE affecteDigicode serveur Web local OK / serveur distant OK
 * 
 */
  

 $client = new SoapClient($adresseServeur);
  try {
    echo "les infos sont ";
    //ATTENTION : tester avec un organisme qui a une réunion réservée aujourd'hui
    //TODO mettre une (ou plusieurs instructions) insert qui ajoute une réservation à la date du jour
    $lesTypes = $client->affecteDigicode(2);
  
    echo htmlentities($lesTypes[0],null,"UTF-8").'<br />'.
            ' salle : '.htmlentities($lesTypes[1],null,"UTF-8").'<br />'.
            'digicode : '.htmlentities($lesTypes[2],null,"UTF-8").'<br />';
   
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
  
  
/*
 * TEST DU SERVICE getLesReunionsWS() serveur Web local
 */


  $client = new SoapClient($adresseServeur);
  $idOrganisme =2;
  try {
    echo "le nombre de reunion pour l'organisme numero $idOrganisme est : ";
    print($client->getLesReunionsWS($idOrganisme));
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }

 

  

?>
