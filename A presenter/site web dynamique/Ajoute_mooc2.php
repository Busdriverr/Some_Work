<?php
$categorie="VISIOCONFERENCES";
$current="none";
require_once("debut_page.php");  
require_once("MoocConnexion.php");?>
<?php


if ( isset($_POST['submit'])){//verifie que les donnée on bien etait saisie
$nom =  $_POST['nom'];
$prenom =$_POST['prenom'];
$email =$_POST['email'];
$nomcour=$_POST['nomCour'];
$heure =$_POST['heure'];
$date = date("d/m/Y", strtotime($_POST['date'])); //transforme la date en format JJ/MM/YYYY
$dateSql=$_POST['date'];//laisse la date sous format SQL YYYY/MM/JJ
$description=$_POST['description'];
$lienV=$_POST['url_video'];//lien de la video complet
$debut_id = explode("v=",$lienV,2);// permet de 
$id_et_fin_url = explode("&",$debut_id[1],2);//recuperer
$id = $id_et_fin_url[0]; //L'id de la video


		$categorie=$_POST['mooc_c'] ;
		$m = new MoocConnexion();
		$id_categorie=$m->get_IdCategory($categorie);//prend l'id de la categorie donner par le client
		$s = new MoocConnexion();
		$s->AjoutMooc($nom,$prenom,$email,$nomcour,$heure,$dateSql,$description,$id,$id_categorie);//ajout le mooc a la base de donnée
		

		header("Refresh: 3;URL=Mooc_demandeActivation.php?log=$id");}//redirige vers la page Mooc_demandeActivation.php
		?> 
<main>
    <div id="sousmenu">
            <p><strong>MENU</strong></p>
            <hr color="#337ab7"/>
            <ul>
                <li><a href="visioconferences.php">Visioconférences à venir</a></li>
                <li><a href="AncienneVisio.php">Anciennes visioconférences</a></li>
                <li><strong><a href="Ajoute_mooc.php">Planifier une visioconférence</a></strong></li>
            </ul>
    </div>
    <div id="article">
        <h1>Planifier une visioconférence</h1>
            <hr color="#337ab7"/><br/>
            <div class="centrer">
                <p class="justifier"> Veuillez patienter vous allez être redirigé.</p>
        </div>
		</div>
		
</main>
<?php
require_once("fin_page.php");
?>