<?php
$adresseServeur = 'http://www.ducros-express.fr/webService/surchargeCarburant/surchargeCarburant.wsdl';

// on crée un objet SoapClient qui pourra ensuite appeler les méthodes disponibles
$client = new SoapClient($adresseServeur);

// fonctions qui servent à découvrir les méthodes disponibles dans le web service, ainsi sur les types utilisés
//var_dump($client->__getFunctions());
//var_dump($client->__getTypes());


try {
    echo "le taux de surcharge carburant est de ";
    print($client->getSurchargeCarburant());
    var_dump($client->__getFunctions());
    var_dump($client->__getTypes());
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }


  

?>
