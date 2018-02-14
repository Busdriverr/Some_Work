<?php
 
require_once("connexionBDD.php");


 
// Récupération des variables nécessaires à l'activation
$id_cour = $_GET['id_cour'];
$cle_activation = $_GET['cle_activation'];
 
// Récupération de la clé correspondant au $login dans la base de données
$stmt = $db->prepare("SELECT cle_activation,actif FROM mooc_avenir WHERE id_cour like :id_cour ");
if($stmt->execute(array(':id_cour' => $id_cour)) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle_activation'];	// Récupération de la clé
    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
  }
 
 
// On teste la valeur de la variable $actif récupéré dans la BDD
if($actif == '1') // Si le compte est déjà actif on prévient
  {
     echo "Le compte est déjà actif !";
  }
else // Si ce n'est pas le cas on passe aux comparaisons
  {
     if($cle_activation == $clebdd) // On compare nos deux clés	
       {
          // Si elles correspondent on active le compte !	
          echo "Votre compte a bien été activé !";
 
          // La requête qui va passer notre champ actif de 0 à 1
          $stmt = $dbh->prepare("UPDATE mooc_avenir SET actif = 1 WHERE id_cour like :id_cour ");
          $stmt->bindParam(':id_cour', $id_cour);
          $stmt->execute();
       }
     else // Si les deux clés sont différentes on provoque une erreur...
       {
          echo "Erreur ! Le compte ne peut être activé...";
       }
  }
  
  ?>