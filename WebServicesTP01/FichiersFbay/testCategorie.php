<?php

include 'global/config.php';
include CHEMIN_LIB.'pdo2.php';
include CHEMIN_MODELE.'Categorie.php';


function testRetourneIdCategorie($libelle)
{
$uneCategorie = new Categorie();
$test = $uneCategorie->retourne_id_Categorie($libelle);

echo 'l\'identifiant de la categorie est  '.$test .'</br>';

}

function testLireInfosCategorie($id)
{
$uneCategorie = new Categorie();
$test= $uneCategorie->lire_infos_categorie($id);
echo 'le libelle de la categorie est  '.$test.'</br>';
}


function testAjouterCategorie($id,$libelle)
{
$uneCategorie = new Categorie();
$uneCategorie->ajouter_categorie_dans_bdd($id, $libelle);
$test= $uneCategorie->lire_infos_categorie($id);
echo 'le libelle de la categorie est  '.$test.'</br>';
}

function testChargerCategorie()
{
    $uneCategorie = new Categorie();
$lesCategories =$uneCategorie->charger_categorie();
foreach($lesCategories as $uneCat)
{
    echo $uneCat->id.' '.$uneCat->libelle.'</br>';
}
}



//testChargerCategorie(); OK
//testAjouterCategorie('HG','HIGH GRET'); OK
//testLireInfosCategorie('HT'); OK
//testRetourneIdCategorie('HIGH GRET'); OK








 
 
?>
