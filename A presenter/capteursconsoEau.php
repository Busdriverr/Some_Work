<?php
$categorie="TABLEAU DE BORD";
$current="CONSO EAU";
$current2="CAPTEURS AGRICOLES";
require_once("debut_page.php");
?> 
<main>
 <div id="sousmenu">
            <p><strong>MENU</strong></p>
            <hr color="#337ab7"/>
            <ul>
				 <li><a href="tableaudebord.php"> <font size="4"> Tableau de Bord </font></a></li>
				<li><a href="formulaireproduit.php"> <font size="4"> Ajouter Produits   </font></a></li>
                <li><a href="formulairesupprimer.php"> <font size="4"> Supprimer Produits   </font></a></li>
				<li><a href="formulairemecanique.php"> <font size="4"> Ajouter Machines </font></a></li>
                <li><a href="formulairesupprimerMachine.php"> <font size="4"> Supprimer Machines   </font></a></li>              
                <li><a href="capteursagricoles.php"> <font size="4"> <strong> Capteurs Agricoles </strong> </font></a></li>
                <li><a href="capteursmecaniques.php"> <font size="4"> Capteurs Mécaniques</font></a></li>
            </ul>
    </div>
	<div id="article">
			<h1> CONSOMMATION D'EAU DES PRODUITS</h1>
			<hr color="#337ab7"/>
				<p> On a ici deux paramètres dans le graphe :</p>
				<p> Le premier [Consommation d'eau] vous indique combien vous avez arrosé en litres d'eau votre produit </p>
				<p> Le deuxieme paramètre [Consommation d'eau conseillé] vous indique quelle est la consommation d'eau à ne dépasser </p>
				<?php require_once("grapheCapteursAgriConso.php"); ?>
	</div>
</main>
<?php
require_once("fin_page.php");
?>