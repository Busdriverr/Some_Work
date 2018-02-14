<?php require_once("connexionBDD.php") ;

var_dump($_POST['id_membre']);
var_dump($_POST['supprimerprod']);
$resultat = $db->prepare("SELECT * FROM consoproduits WHERE nom_prod=:nom_prod && id_membre=:id_membre");
$resultat->bindParam(":nom_prod",$_POST['supprimerprod']);
$resultat->bindParam(":id_membre",$_POST['id_membre']);
$resultat->execute();

$tab=$resultat->fetchAll(PDO::FETCH_ASSOC);
var_dump($tab);
foreach($tab as $cle=>$val)
$id_prod=$val['id_prod'];
var_dump($id_prod);

$res = $db->prepare("DELETE FROM consoproduits
WHERE id_prod=:id_prod");
$res->bindParam(":id_prod",$id_prod);
$res->execute();

header('Location:capteursagricoles.php ');
?>



