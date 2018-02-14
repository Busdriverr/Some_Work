<?php
$categorie="VISIOCONFERENCES";
$current="none";
require_once("debut_page.php");  
require_once("MoocConnexion.php");
require_once("connexionBDD.php");


// Récupération des variables nécessaires au mail de confirmation	
$resultat = $db->prepare("SELECT * FROM mooc_avenir WHERE lienvideo=:lienvideo");
$resultat->bindParam(':lienvideo', $_GET['log']);
$resultat->execute();
$tab=$resultat->fetchAll(PDO::FETCH_ASSOC);

foreach($tab as $c){// Récupération des variables nécessaires au mail de confirmation	
$id_cour=$c['id_cour'];
$email=$c['email'];
$nom=$c['nom'];
$nomcour=$c['nom_cour'];
$date=$c['date'];
$heure=$c['heure'];}

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
                <p> Félicitations, vous venez de créer votre visioconférence !<br>
                    Elle sera intitulée <?php echo $nomcour;?> et sera diffusée le <? echo $date;?> à <?php echo $heure;?><br>
                    Pour finalisez la procedure veuillez attendre L'approuvement d'un responsable.</p>

                <p> Si vous souhaitez annuler ou modifier un Mooc merci de nous contacter à travers le formulaire de <a href="formulairedecontact.php">contact</a> de site.</p>
                </div>
		</div>
		
		<?php  // ENVOI DU MAIL AU RESPONSABLE POUR QU'IL ACTIVE LE MOOC
 
// Génération aléatoire d'une clé
$cle_activation = md5(microtime(TRUE)*100000);
 
 
// Insertion de la clé dans la base de données (à adapter en INSERT si besoin)
$stmt = $db->prepare("UPDATE mooc_avenir SET cle_activation=:cle_activation WHERE id_cour like :id_cour");
$stmt->bindParam(':cle_activation', $cle_activation);
$stmt->bindParam(':id_cour', $id_cour);
$stmt->execute();
 
 
// Préparation du mail contenant le lien d'activation
$destinataire = "admin@gmail.com";//donner le mail de l'admin qui aura les droit de rajouter un mooc ou d'en supprimer
$sujet = "Demande d'activation pour Mooc" ;
$entete = "From:".$email." ";
 
// Le lien d'activation est composé du login(log) et de la clé(cle)
$message = 'Demande d\'activation pour la visioconférence de Mr'.$nom.',

elle portera sur'.$nomcour.' 
Pour activer l\'activer, veuillez cliquer sur le lien ci-dessous
ou le copier/coller dans votre navigateur internet.
 
localhost/energiculteur/PHP/Mooc_activation.php?log='.urlencode($id_cour).'&cle='.urlencode($cle_activation).'
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
//il faut utiliser le bon url du site avec https et non localhost !!!
 
    
    
    
mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
 
//...	
// Fermeture de la connexion	
//...
// Votre code
//...?>
		
</main>
<?php
require_once("fin_page.php");
?>