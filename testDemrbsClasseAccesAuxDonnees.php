<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'mrbs_maClasseAccesAuxDonnees.php';
$pdo = MonPDO::getPdoGsb();

function testGetLesTypesOrganismes($pdo){
$lesTypesOrganisme = $pdo->getLesTypesOrganismes();

/*foreach ($lesTypesOrganisme as $unType)
{
    $id = $unType['id'];
    $intitule = $unType['intitule'];
    echo 'identifiant : '.$id.' intitulé : '.$intitule.'<br />';
}*/
foreach ($lesTypesOrganisme as $unType)
{
    $id = $unType->id;
    $intitule = $unType->intitule;
    echo 'identifiant : '.$id.' intitulé : '.$intitule.'<br />';
}

}


function testGetLesOrganismes($pdo, $idOrganisme){
$lesOrganismes = $pdo->getLesOrganismes($idOrganisme);

foreach ($lesOrganismes as $unOrganisme)
{
        $id = $unOrganisme['id'];
    $intitule = $unOrganisme['nom'];
    echo 'identifiant : '.$id.' intitulé : '.$intitule.'<br />';
}
}

function testGetLesReunions($pdo, $idOrganisme){
$lesReunions = $pdo->getLesReunions($idOrganisme);


        $nb = $lesReunions['nb'];
   
    echo 'nb de réunions pour cette organisme : '.$nb.'<br />';

}

function testAjoutDigicode($pdo,$idOrganisme){

  $lesInfos=  $pdo->ajoutDigicode($idOrganisme);
  echo 'digicode : ' .$lesInfos['digicode'] .'<br />';
  echo 'batiment : ' .$lesInfos['batiment'].'<br />';
  echo 'salle : '.$lesInfos['salle'].'<br />';

}



//testGetLesTypesOrganismes($pdo); //OK
////testGetLesOrganismes($pdo,1); //OK
//testGetLesOrganismes($pdo,3); //OK
//testGetLesReunions($pdo,2); //OK pour organisme qui a une réunion
//testGetLesReunions($pdo,1); //OK pour organisme qui n'a pas de réunion
 testAjoutDigicode($pdo, 2); //OK pour organisme qui a une réunion


?>
