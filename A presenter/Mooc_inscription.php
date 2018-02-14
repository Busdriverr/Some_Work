<?php require_once("MoocConnexion.php");
$idMembre=$_POST['id_membre'];
$idcour=$_POST['id_cour'];
if($_POST['inscription']=='s\'inscrire'){//Applique la fonction inscription si le bouton recupérer est s'inscrire
	$m = new MoocConnexion();
	$m->inscription($idMembre,$idcour);
}
if($_POST['inscription']=='se désinscrire'){//Applique la fonction desinscription si le bouton recupérer est se désinscrire
	$m = new MoocConnexion();
	$m->desinscription($idMembre,$idcour);
}
header('Location: AfficherUnMooc.php?id_cour='.$idcour.'')//redirige directement vers le mooc precedent
?>
