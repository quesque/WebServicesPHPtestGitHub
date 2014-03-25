<?php

include 'global/config.php';
include CHEMIN_LIB.'pdo2.php';
include CHEMIN_MODELE.'Objet.php';




function testLireInfosObjetsParCategorie($id)
{
$unObjet = new Objet();
$lesObjets= $unObjet->charger_objet_par_categorie($id);
foreach($lesObjets as $unO)
{
    echo $unO->id.' '.$unO->libelle.'</br>';
}
}






testLireInfosObjetsParCategorie('HT')









 
 
?>
