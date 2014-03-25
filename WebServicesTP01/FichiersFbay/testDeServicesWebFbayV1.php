<?php
$adresseServeur = 'http://localhost/WebServicesPHP/WebServicesTP01/FichiersFbay/fbay.wsdl';
//$adresseServeur = 'http://192.168.10.27/WebServicesPHP/MesServices.php?wsdl';


/*
 * TEST DU SERVICE setCategorie
 */

function testWSsetCategorie($client)
{
 
  try {
    $id='AE';
    $libelle='essai d\'ajout';
    $client->setCategorie($id, $libelle);
     echo "<br />le libelle est ";
    print($client->getLibelleCategorie($id));
    
   
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
}


/*
 * TEST DU SERVICE getLesCategories 
 * 
 */
  
function testWSgetLesCategories($client)
{
 
  try {
     
    echo "les categories sont <br />";
    $lesCat = $client->getLesCategories();
    
   foreach ($lesCat as $uneCat)
{
   $id = htmlentities($uneCat->id,null,"UTF-8");
    $intitule = htmlentities($uneCat->libelle,null,"UTF-8");
    echo 'identifiant : '.$id.' intitule : '.$intitule.'<br />';
}
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
}

 


 /*
 * TEST DU SERVICE getLibelleCategorie() serveur Web local 
 */
  function testWSgetLibelleCategorie($client)
  {
  try {
    echo "le libelle est ";
    print($client->getLibelleCategorie('HT'));
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
  }
  
  

  $client = new SoapClient($adresseServeur);
  var_dump($client->__getFunctions());
  var_dump($client->__getTypes());
  
  testWSgetLesCategories($client);
  //testWSgetLibelleCategorie($client);
  //testWSsetCategorie($client);
 


  

?>
