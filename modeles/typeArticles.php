<?php
require_once 'pdo2.php';
//while($ligne = $lestypesArticles->fetch(PDO::FETCH_OBJ)) {
//			$code = $ligne->code;
//			$nom = $ligne->nom;
//			
//
//          echo  "$code . $nom. <br/>";
//}
function getInfosTypeArticles(){
		$req = "SELECT * FROM typearticle"; 
		$rs = PDO::getInstance()->query($req);
                while ($donnees =$rs->fetch())
		{
                    $resultat=$donnees['code']." ".$donnees['nom'];
                }
                return $resultat;
                $rs->closeCursor();
        }

function ajouterTypeArticle($code,$nom){
    $req="INSERT INTO `typearticle` (
code,nom)
VALUES ('$code', '$nom')";
    PDO2::getInstance()->exec($req);
    echo "Le type d'article ".$nom." à bien été ajouté";
}

function modifierTypeArticle($code,$nom){
    $req="UPDATE INTO typearticle
    SET nom='$nom'
    WHERE code='$code'";
    PDO2::getInstance()->exec($req);
    echo"Le type d'article numéro ".$code."à bien été modifié";
}

function supprimerArticle($code){
    $req="DELETE FROM typearticle WHERE code='$code'";
    PDO2::getInstance()->query($req);
    echo"Le type d'article numéro".$code."à bien été supprimé";
}

?>