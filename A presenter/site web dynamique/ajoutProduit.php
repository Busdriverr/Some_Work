<?php require_once("connexionBDD.php") ;


$res = $db->prepare("Insert into consoproduits VALUES (DEFAULT,:nom,:temp,:tempLim,:hum,:humLim,:consoEau,:consoEauLim,:id_membre )");
$res->bindParam(":nom",$_POST['nom']);
$res->bindParam(":temp",$_POST['temperature']);
$res->bindParam(":tempLim",$_POST['temperatureLimite']);
$res->bindParam(":hum",$_POST['humidite']);
$res->bindParam(":humLim",$_POST['humiditeLimite']);
$res->bindParam(":consoEau",$_POST['consoEau']);
$res->bindParam(":consoEauLim",$_POST['consoEauLimite']);
$res->bindParam(":id_membre",$_POST['id_membre']);
$res->execute();

header('Location:capteursagricoles.php ');
?>




































?>

