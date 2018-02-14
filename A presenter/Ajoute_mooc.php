<?php
$categorie="VISIOCONFERENCES";
$current="PLANIFIER UNE VISIOCONFÉRENCE";
require_once("debut_page.php");
require_once("MoocConnexion.php");
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
			<form name="mooc_ajout" action="Ajoute_mooc2.php" method="POST"><!--formulaire d'ajout du mooc-->
			 <table align="center">
			  <tr><td align="left">Nom</td><td>: </td>
			  <td><input type="text" name="nom" required /></td></tr>
			  <tr><td align="left">Prénom</td><td>: </td>
			  <td><input type="text" name="prenom" required /></td></tr>
			  <tr><td align="left">Email</td><td>: </td>
			  <td><input required type="text" name="email" required /></td></tr>
			  <tr><td align="left">Nom de la visio</td><td>: </td>
			  <td><input required type="text" name="nomCour" required /></td></tr>
			  <tr><td align="left">Catégorie</td><td>: </td>
			  <td><select required name="mooc_c">	<!--liste Deroulante avec les categorie-->		
			<?php 
			$m = new MoocConnexion();
			$tab=$m->get_Category();
				foreach($tab as $cle=>$val)
					echo '<OPTION>'.$val['Category'].'</OPTION>';
					?></select></td></tr><!--fin de la liste-->
			  <tr><td align="left">Date et heure de la visio</td><td>: </td>
			  <td><input required type="date" name="date"><input required type="time" name="heure"required /></td></tr>
			  <tr><td align="left">Lien de la vidéo (Youtube)</td><td>: </td>
			  <td><input type="url" name="url_video" class="form-control" maxlength="150" placeholder="URL (https://)" required /></td></tr>
              <tr><td align="left">Description de la visio</td><td colspan=2 align="left">: </td></tr>
              <tr><td colspan=3><textarea id="entier" name="description"  placeholder="Ajoutez une brève description de votre visioconférence"></textarea></td></tr>
			  </table>
			  <!--<label align="left"> Description de la visio : </label><br/>
			<textarea name="description"  placeholder="Ajoutez une brève description de votre visioconférence" size="75" style="height:250px;"></textarea><br/><br/>-->
			<input type="submit" name="submit" value="Créer la visioconférence"/>
		</form>
		</div>
    </div>
</main>
<?php
require_once("fin_page.php");
?>