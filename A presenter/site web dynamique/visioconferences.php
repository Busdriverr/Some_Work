<?php
$categorie="VISIOCONFERENCES";
$current="VISIOCONFÉRENCES A VENIR";
require_once("debut_page.php");
require_once("MoocConnexion.php");
$m = new MoocConnexion();


$datejour = date('Ymd')+1;//date d'aujourdhui
?>
<main>
    <div id="sousmenu">
            <p><strong>MENU</strong></p>
            <hr color="#337ab7"/>
            <ul>
                <li><strong><a href="visioconferences.php">Visioconférences à venir</a></strong></li>
                <li><a href="AncienneVisio.php">Anciennes visioconférences</a></li>
                <li><a href="Ajoute_mooc.php">Planifier une visioconférence</a></li>
            </ul>
    </div>
    <div id="article">
        <h1>Visioconférences</h1>
        <hr color="#337ab7"/><br/>
        <div class="centrer">
		<form name="mooc_ajout" action="" method="GET">
		<label for="mooc_c"> Catégorie du MOOC ? </label><!--Liste deroulante qui affiche les differente categorie -->
				<select name="mooc_c">
					<option value=''> Choisissez une catégorie existante </option>
					<?php
						$tabCategory=$m->get_Category();
							foreach ($tabCategory as $c=>$v){
								echo "<option value='".$v['id_mcategorie']."'> ".$v['Category']." </option>";
							}
						
					?></select><button  type="submit">Trier</button> </form><br/>
		<?php 
		
					
					
			if(!isset($_GET['mooc_c']) || $_GET['mooc_c']==''){//si aucune categorie n'est choisie la fonction appelée affiche tout les cours
				$tab=$m->VoirMooc();
			}else{
				$tab=$m->VoirMoocTrierCategorie($_GET['mooc_c']);//sinon appeler la fonction qui trie par categorie et affiche les cours
			}
			
			echo '<table >';//tableau dans lequel s'affiche les Mooc sous forme |image.jpg| NOM | DATE | heure
				echo '<tr><td></td><td align="center"><strong>Nom</strong></td><td align="center"><strong>date</strong></td><td align="right"><strong>Heure</strong></td></tr>';
				foreach($tab as $c){
					if($c['actif']==1){//verifie que le Mooc a bien etait activer par le responsable.
						
						if($datejour<date("Ymd", strtotime($c['date']))){// verifie que la date du mooc n'est pas depasser
							
						echo '<form method="GET" action="AfficherUnMooc.php">';
					
						echo '<tr><td><img src="http://img.youtube.com/vi/'.$c['lienvideo'].'/default.jpg"/></td>
						<td align="left">'.$c['nom_cour'].'</td><td align="center">'.date("d/m/Y", strtotime($c['date'])).'</td><td align="right">'.$c['heure'].'</td>';
						echo '<input type="hidden" name="id_cour" value="'.$c['id_cour'].'">';
						echo '<td><input type="submit" value="Détail"></td></tr>';	//envoi vers AfficherUnMooc.php
						echo '</form>';
						}
					}
						}
						
						echo '</table>';	
			?>
			
		</div>
    </div>
</main>
<?php
require_once("fin_page.php");
?>