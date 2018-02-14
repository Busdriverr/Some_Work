<?php
$categorie="MES ALERTES";
$current="ALERTES AGRICOLES";

require_once("debut_page.php");

require_once("connexionBDD.php");

//$res = $bdd->query('SELECT nom_prod FROM capteurs where temperatureLimite - temperature <0 or  humiditeLimite - humidite <0 or  consoEauLimite - consoEau <0   ');
$res = $db->prepare('SELECT * FROM consoproduits where id_membre=:id');
$res->bindParam(":id",$_SESSION['id']);
$res->execute();
$tab = $res->fetchAll(PDO::FETCH_ASSOC);
//$count = 0;
$flag = False;
$count = 0;

foreach ($tab as $cle => $valeur){
	if($valeur['temperatureLimite'] - $valeur['temperature'] < 0 or $valeur['humiditeLimite'] - $valeur['humidite'] < 0 or $valeur['consoEauLimite'] - $valeur['consoEau'] < 0)
		$count = $count +1;
	//echo ($valeur['temperatureLimite'] - $valeur['temperature']) .'<br>';
	foreach ($valeur as $c => $v){
		
		if(count($v) >0)
			$flag = True;

		else
			$flag = False;
	}
		
}

$num = 1;
$test = 0;

?>
<main>
    <div id="sousmenu">
            <p><strong>MENU</strong></p>
            <hr color="#337ab7"/>
            <ul>
				<li><a href="mesalertes.php"><font size="4"> Mes Alertes </font></a></li>
                <li><a href="alerteagricole.php"><font size="4"><strong>Alertes agricoles </strong></font></a></li>
                <a href="alertesTemp.php">- Température</a><br/>
				<a href="alertesHumi.php">- Humidité</a><br/>
				<a href="alertesConsoEau.php">- Consommation d'eau </a>
                <li><a href="alertemecanique.php"><font size="4">Alertes mécaniques </font></a></li>
					<a href="alertesConsoEnergie.php">- Consommation d'énergie </a><br/>
					<a href="alertesPression.php">- Pression </a><br/>
                <a href="alertesTempMachine.php">- Température </a>
            </ul>
    </div>
    <div id="article">
				<h1> ALERTES AGRICOLES </h1>
				

			<hr color="#337ab7"/>
			<p> Grâce aux données des capteurs agricoles , nous pouvons vous notifié de la présence d'anomalie concernant vos produits. </p>
			<p> Vous pouvez voir les alertes de tous les produits par catégorie : <br>
			<a href="alertesTemp.php">[ Température ]</a> <br>
			<a href="alertesHum.php"> [ Humidité ] </a> <br> 
			<a href="alertesConsoEau.php">[ Consommation d'eau ] </a></p>
			
			<?php 
			if($flag == True){
				echo '<h1> Vous avez  ' . $count . ' produit(s) en Alerte !!! </h1>  </br>';
				echo '<hr color="#337ab7"/>';
				
// PARTIE POUR ALERTES TEMPERATURE ////////////////////////////////////////////////////////////////
				foreach ($tab as $cle => $valeur)
			{
				if($test == 0)
				{ 
					
		
					if($valeur['temperatureLimite'] - $valeur['temperature'] < 0)
					{
						echo '<p align="left"><img src="../Ressources/croixrouge.png"><font size="4"> Alerte température pour ce(s) produit(s): </font><br></p>';
						$test = 1;
					}
				}



				if($test == 1)
				{
					if($valeur['temperatureLimite'] - $valeur['temperature'] < 0){
						//echo  $num .') '.$valeur['nom_prod'] .'<br>'; 					si tu veux afficher avec les numéros
						//$num = $num +1;
						echo '<p align="left"> - '.$valeur['nom_prod'] . '</p>';								//si tu veux afficher avec les tirets
						$test = 1;
					}
				}		
			}
	
// PARTIE POUR ALERTES HUMIDITES ////////////////////////////////////////////////////////////////////
			$test = 0;
				echo '<hr color="#337ab7"/>';
				foreach ($tab as $cle => $valeur){	
		
				if($test == 0)
				{ 
					
					if($valeur['humiditeLimite'] - $valeur['humidite'] < 0)
					{
						echo '<p align="left"><img src="../Ressources/croixrouge.png"><font size="4"> Alerte humidité pour ce(s) produit(s): </font><br></p>';
						$test = 1;
					}
				}



				if($test == 1)
				{
					if($valeur['humiditeLimite'] - $valeur['humidite'] < 0){
						//echo  $num .') '.$valeur['nom_prod'] .'<br>'; 					si tu veux afficher avec les numéros
						//$num = $num +1;
						echo '<p align="left"> - '.$valeur['nom_prod'] . '</p>';								//si tu veux afficher avec les tirets
						$test = 1;

					}
				}
			}
			
			'<br>';
// PARTIE POUR ALERTES CONSOMMATION D'EAU /////////////////////////////////////////////////////////
				$test = 0;
				echo '<hr color="#337ab7"/>';
				foreach ($tab as $cle => $valeur){	
		
				if($test == 0){ 
					if($valeur['consoEauLimite'] - $valeur['consoEau'] < 0){
						echo '<p align="left"><img src="../Ressources/croixrouge.png"><font size="4"> Alerte surconsommation d\'eau pour ce(s) produit(s): </font><br></p>';
						$test = 1;
					}
				}



				if($test == 1){
					if($valeur['consoEauLimite'] - $valeur['consoEau'] < 0){
						//echo  $num .') '.$valeur['nom_prod'] .'<br>'; 					si tu veux afficher avec les numéros
						//$num = $num +1;
						echo '<p align="left"> - '.$valeur['nom_prod'] . '</p>';								//si tu veux afficher avec les tirets
						$test = 1;
					}
				}
			}
}

// PARTIE SI AUCUNE ALERTE ////////////////////////////////////////////////////////////////////////////
	else{
	echo '<p align="left"><img src="../Ressources/flecheverte.png"><font size="4"> Vous n\'avez pas d\'alertes! Votre champ se porte bien !</font></p>
			<hr color="#337ab7"/>
			<br> <p align="left"> D\'apres les dernières données extraites : </p>';
	echo '<p align="left"> - Aucune parcelle de votre champ ne nécessite une action de votre part </p>';
	}

?>
			
    </div>
</main>
<?php require_once("fin_page.php");?>