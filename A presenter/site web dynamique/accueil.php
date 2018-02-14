<?php
//HEADER + NAV
$categorie="ACCUEIL";
$current="none";
require_once("debut_page.php");

//CONTENU DE LA PAGE
?>
<main>
    <div id="article">
        <h1>Energiculteur ? Qu'est-ce que c'est ?</h1>
        <hr color="#337ab7"/>
        <br/>
            <p class="justifier">
            Energiculteur est la plateforme d'aide à la décision du monde agricole. Notre objectif principal est l'optimisation des installations liées à l'énergie grâce à des prestations de conseil et d'entraide.<br/><br/>
            Des mesures via des capteurs de tous vos postes consommant de l'énergie seront envoyées sur votre espace personnel. Les informations pourront ensuite être consultées sur votre PC, smartphone ou votre tablette. Cela vous permettra d'avoir une analyse en temps réel de vos consommations pour mieux les optimiser.<br/><br/>
            Notre plateforme est aussi utilisée par des professionnels qui apportent leurs connaissances et leurs conseils via des vidéos et des commentaires.<br/><br/>
            Enfin vous pouvez vendre, échanger, acheter du matériel agricole via notref interface d'échange.<br/><br/>
            N'hésitez plus, Energiculteur est la solution à vos problématiques de décision !
            </p>
        <div class="centrer">
            <iframe id="video" width="640" height="360" src="https://www.youtube.com/embed/fQ_-6obzRHo" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
</main>
<?php
// FOOTER
require_once("fin_page.php");
?>