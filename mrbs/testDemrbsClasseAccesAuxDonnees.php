<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include_once 'global/config.php';
include_once CHEMIN_MODELE.'TypeOrganisme.php';
include_once CHEMIN_MODELE.'Organisme.php';
include_once CHEMIN_MODELE.'Digicode.php';
include_once CHEMIN_MODELE.'Autres.php';
include_once CHEMIN_MODELE.'Batiment.php';
include_once CHEMIN_MODELE.'Mrbs_room.php';

function testGetLesTypesOrganismes(){
$TypeOrganisme = new TypeOrganisme();

$lesTypesOrganismes =$TypeOrganisme->charger_typeOrganisme();
foreach($lesTypesOrganismes as $unType)
{
    $id = $unType->id;
    $intitule = $unType->intitule;
    echo 'identifiant : '.$id.' intitulé : '.$intitule.'<br />';
}

}


function testGetLesOrganismes($typeOrganisme){
$Organisme = new Organisme();

$lesOrganismes =$Organisme->charger_organismePourUnType($typeOrganisme);
foreach($lesOrganismes as $unOrganisme)
{
    $id = $unOrganisme->id;
    $intitule = $unOrganisme->intitule;
    echo 'identifiant : '.$id.' intitulé : '.$intitule.'<br />';
}
}


function testGetLesReunions($idOrganisme){
$lesReunions = getNbReunionsNowPourUnOrganisme($idOrganisme);


       
   
    echo 'nb de réunions pour cette organisme : '.$lesReunions.'<br />';

}


function testAjoutDigicode($digicode){
$unObjetDigicode= new Digicode();

$ajoutOk =$unObjetDigicode->ajouter_digicode_dans_bdd($digicode);
  
echo $ajoutOk;
}

function testgetNomBatiment($id){
    $Batimpent = new Batiment();
    $leNomDuBatiment = $Batimpent->getNomBatiment($id);
    echo $leNomDuBatiment;
}

function testgetNomRoom($id){
    $unMrbsroom = new Mrbs_room();
    $numSalle = $unMrbsroom->getNomRoom($id);
    echo $numSalle;
}

function testGetLaSalle($idOrganisme){
    
    echo getSalleNowPourUnOrganisme($idOrganisme);
}




// testGetLesTypesOrganismes();
 //testGetLesOrganismes(1);
//$unDigicode = '123456';
 //testAjoutDigicode($unDigicode);

//créer une réunion pour l'organisme  à la date du jour avant de lancer le test
// utilisateur gaigar/mot de passe : passe appartient à organisme 1
// utilisateur glavork/mot de passe : passe appartient à organisme 2
 //testGetLesReunions(1);

 //testgetNomBatiment(1);

//testLireInfosroom(1);

//testGetLaSalle(1);

?>
