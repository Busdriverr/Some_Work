<?php
$categorie="VISIOCONFERENCES";
$current="DÉTAIL DE LA VISIO";
require_once("debut_page.php");

require_once("connexionBDD.php");//connexion a la base de donnees
require_once("MoocConnexion.php");//Permet de recuperer les fonctions s'appliquant au different MOOC
	$req = $db->prepare("SELECT * FROM mooc_avenir WHERE id_cour = :idcour");//recolte toute les informations du MOOC selectionner
	$req->bindParam(':idcour',$_GET['id_cour'] );
	$req->execute();
	 while($donnees=$req->fetch()){
        $nom=$donnees["nom"];
		$prenom=$donnees["prenom"];
		$email=$donnees["email"];
		$nom_cour=$donnees["nom_cour"];
		$date=$donnees["date"];
		$heure=$donnees["heure"];
		$description=$donnees["description"];
		$lienVideo=$donnees["lienvideo"];
		$id_categorie=$donnees["id_categorie"];
		
    } ?>

<main>
    <div id="sousmenu">
            <p><strong>MENU</strong></p>
            <hr color="#337ab7"/>
            <ul>
                <li><a href="visioconferences.php">Visioconférences à venir</a></li>
                <li><a href="AncienneVisio.php">Anciennes visioconférences</a></li>
                <li><a href="Ajoute_mooc.php">Planifier une visioconférence</a></li>
            </ul>
    </div>
    <div id="article">
        <h1>Détail de la visioconférence</h1>
        <hr color="#337ab7"/><br/>
        
        <div class="centrer">
		<table id="gauchedroite"><tr><td align="left"><strong><?php echo $nom_cour ?></strong></td><td align="right">
		<?php $m = new MoocConnexion();
			$DejaInscrit=$m->DejaInscrit($_SESSION['id'],$_GET['id_cour']);//Verifie si la personne est deja inscrite ou pas
			
			if($DejaInscrit==0){//0 pour false
				echo '<form name="mooc_ajout" action="Mooc_inscription.php" method="POST">';
                //Cree un bouton inscription qui envoi l'id du membre connecter et l'id du cour pour l'inscrire
				echo '<input type="hidden" name="id_membre" value="'.htmlspecialchars($_SESSION['id'], ENT_QUOTES).'">
				<input type="hidden" name="id_cour" value="'.htmlspecialchars($_GET['id_cour'], ENT_QUOTES).'">
				<input type="submit" name="inscription" value="S\'inscrire" /> </form>
				';
			}
			else{
				echo '<form name="mooc_ajout" action="Mooc_inscription.php" method="POST">';
                //Cree un bouton desinscription qui envoi l'id du membre connecter et l'id du cour pour le desinscrire
				echo '<input type="hidden" name="id_membre" value="'.htmlspecialchars($_SESSION['id'], ENT_QUOTES).'">
				<input type="hidden" name="id_cour" value="'.htmlspecialchars($_GET['id_cour'], ENT_QUOTES).'">
				<input type="submit" name="inscription" value="Se désinscrire" /></form>
				';
			}
			
			?> 
		</td></tr></table>
  <p class="justifier"><?php
  echo $description; ?></p>
		

	<div class="center">
	    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>

    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '360',
          width: '500',
          videoId: '<?php echo $lienVideo ; ?>',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 0000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
		
		</div>
		
		
		
        </div>
    </div>
</main>
<?php
require_once("fin_page.php");
?>