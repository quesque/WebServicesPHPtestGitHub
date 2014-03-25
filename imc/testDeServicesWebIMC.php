<?php
//$adresseServeur = 'http://localhost/WebServicesPHP/WebServicesTP01/webServicesIMC.php?wsdl';

//$adresseServeur = 'http://192.168.10.27/WebServicesPHP/WebServicesTP01/webServicesIMC.php?wsdl';
//$adresseServeur = 'http://sio2.malrauxbethune.fr/ws/imc/webServicesIMC.php?wsdl';
$adresseServeur = 'http://servdev01.gsb.com/WebServices/imc/webServicesIMC.php?wsdl';
// on crée un objet SoapClient qui pourra ensuite appeler les méthodes disponibles
try {
$client = new SoapClient($adresseServeur);

// fonctions qui servent à découvrir les méthodes disponibles dans le web service, ainsi sur les types utilisés
var_dump($client->__getFunctions());
var_dump($client->__getTypes());

$poids = 70;
$taille = 160;

echo 'Si vous avez un poids de '.$poids .' kilos<br />';
echo 'et une taille de '.$taille .' centimetres <br />';

try {
    echo "Votre indice de masse corporelle est de  ";
    print($client->getImc($poids, $taille));
    
  }
  
  catch (SoapFault $exception) {
    echo $exception;
  }
}
catch (Exception $exception) {
    echo $exception;
  }


  

?>
