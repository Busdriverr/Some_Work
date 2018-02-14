<?php
$categorie="MES ALERTES";
$current="ALERTES HUMIDITES";
$current2="ALERTES AGRICOLES";
require_once("debut_page.php");
require_once("connexionBDD.php");

//$res = $bdd->query('SELECT nom_prod FROM capteurs where humiditeLimite - humidite <0 or  humiditeLimite - humidite <0 or  consoEauLimite - consoEau <0   ');
$res = $db->prepare('SELECT nom_prod FROM consoproduits where humiditeLimite - humidite <0 and id_membre=:id');
$res->bindParam(":id",$_SESSION['id']);
$res->execute();
$tab = $res->fetchAll(PDO::FETCH_ASSOC);
$flag = False;

foreach ($tab as $cle => $valeur){
	foreach ($valeur as $c => $v){
		if(count($v) >0)
			$flag = True;

		else
			$flag = False;
	}	
}

?>
<main>
    <div id="sousmenu">
            <p><strong>MENU</strong></p>
            <hr color="#337ab7"/>
            <ul>
				<li><a href="mesalertes.php"><font size="4"> Mes Alertes </font></a></li>
                <li><a href="alerteagricole.php"><font size="4">Alertes agricoles </font></a></li>
                <a href="alertesTemp.php">- Température</a><br/>
				<a href="alertesHumi.php"><strong>- Humidité</strong></a><br/>
				<a href="alertesConsoEau.php">- Consommation d'eau </a>
                <li><a href="alertemecanique.php"><font size="4">Alertes mécaniques </font></a></li>
					<a href="alertesConsoEnergie.php">- Consommation d'énergie </a><br/>
					<a href="alertesPression.php">- Pression </a><br/>
                <a href="alertesTempMachine.php">- Température </a>
            </ul>
    </div>
    <div id="article">
				<h1> ALERTES HUMIDITES</h1>
			<hr color="#337ab7"/>
			
				<?php 
				echo '<br>';
				if($flag == True){
					echo '<p align="left"><img src="../Ressources/croixrouge.png"><font size="4"> Alerte! Dépassement d\'humidité detecté pour le(s) produit(s) suivant(s): </font></p>';
					foreach ($tab as $cle => $valeur){
					foreach ($valeur as $c => $v){
					echo  '<p align="left"> - '. $v . '</p>';
							}
						}
					}

					else
						echo '<p align="left"><img src="../Ressources/flecheverte.png"><font size="4"> Votre champ se porte bien, vous n\'avez pas d\'alerte d\'humidité. </font></p>' ;
				?>
			
    </div>
</main>
<?php require_once("fin_page.php");?>
