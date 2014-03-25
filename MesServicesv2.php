<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'mrbs_maClasseAccesAuxDonnees.php';
/**
 * Description of MesServices
 *
 */
class MesServices {
    
    
    
    function getLesTypesOrganismesWS2()
    {
        $pdo = MonPDO::getPdoGsb();
        $lesTypesOrganisme = $pdo->getLesTypesOrganismes();

        
        return $lesTypesOrganisme;

    }
    
    
}
/**
 * création des services
 */

ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0'); 
$wsdl='descriptionDeMesServicesWebv6.wsdl';

$server = new SoapServer($wsdl);
$server->wsdl->addComplexType(
'typeOrganisme',
'complexType',
'struct',
'all',
'',
array(
'id'=> array('name'=>'id','type'=>'xsd:int','use'=>'optionnal'),
'initule'=> array('name'=>'initule','type'=>'xsd:string','use'=>'optionnal')
)
);

$server->wsdl->addComplexType(
'lesTypeOrganisme',
'complexType',
'array',
'',
'SOAP-ENC:Array',
array(),
array(
array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:typeOrganisme[]')
),
'tns:typeOrganisme'
);


$server->register("getLesTypesOrganismesWS2", array(), array('lesTypeOrganisme'=>'tns:lesTypesOrganisme'), $NAMESPACE);

?>
