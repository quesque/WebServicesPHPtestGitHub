<?php
$adresseServeur = 'http://localhost/WebServicesPHP/DEV/test/webServicesTEST.php?wsdl';

//$adresseServeur = 'http://192.168.10.27/WebServicesPHP/WebServicesTP01/webServicesIMC.php?wsdl';
//$adresseServeur = 'http://sio2.malrauxbethune.fr/ws/imc/webServicesIMC.php?wsdl';
//$adresseServeur = 'http://servdev01.gsb.com/WebServices/imc/webServicesIMC.php?wsdl';
// on crée un objet SoapClient qui pourra ensuite appeler les méthodes disponibles
try {
$client = new SoapClient($adresseServeur);

// fonctions qui servent à découvrir les méthodes disponibles dans le web service, ainsi sur les types utilisés
var_dump($client->__getFunctions());
var_dump($client->__getTypes());


try {
    echo "réponse ";
    print($client->getTest());
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
}
catch (Exception $exception) {
    echo $exception;
  }


  

?>
