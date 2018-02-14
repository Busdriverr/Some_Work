<?php

class MoocConnexion{
	private $db;
	
	public function __construct(){//fonction qui permet de se connecter a la base de donnée
		try {
			$this->db = new PDO("mysql:host=localhost;dbname=thintank","root","");
			$this->db->query('set NAMES utf8');
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "connexion a la base de donner reussi";
		}
		catch (PDOException $e) {
			die ("Erreur numéro" . $e -> getcode() . " : " . $e->getMessage());
		}
	}
	
	function get_Category() {// fonction qui return les categories
		$requete = $this->db->prepare('SELECT * FROM m_categorie');
		$requete->execute();
		$tab=$requete->fetchAll(PDO::FETCH_ASSOC);
		return( $tab);
	}		
	
	function get_IdCategory($nomCategory){// fonction qui return l' id d'une categories

	$requete = $this->db->prepare('SELECT id_mcategorie FROM m_categorie WHERE Category=:categorie');
	$requete->bindParam(':categorie',$nomCategory );
	$requete->execute();
	while($ligne=$requete->fetch(PDO::FETCH_NUM)){
		$id_categorie=$ligne[0];
	}
	return( $id_categorie);
	}
	
	
	
	function AjoutMooc($nom,$prenom,$email,$nomcour,$heure,$date,$description,$lienV,$id_categorie){// fonction qui rajoute un mooc a la base de donner + le mooc ne sera pas actif(actif=0) IL FAUT ATTENDRE LA CONFIRMATION PAR MAIL 
	$requete = $this->db->prepare("INSERT into mooc_avenir VALUES(default, :name, :prenom,:email,:nomcour,:date, :heure, :description,:lienvideo, :id_categorie, NULL, 0)");
	$requete->bindParam(':name',$nom );
	$requete->bindParam(':prenom',$prenom );
	$requete->bindParam(':email',$email );
	$requete->bindParam(':nomcour',$nomcour );
	$requete->bindParam(':date',$date );
	$requete->bindParam(':heure',$heure );
	$requete->bindParam(':description',$description );
	$requete->bindParam(':lienvideo',$lienV );
	$requete->bindParam(':id_categorie',$id_categorie);
	$requete->execute();
	}
	
	function ModifierMooc($nom,$prenom,$email,$nomcour,$heure,$date,$description,$lienV,$id_categorie,$id_cour){// fonction qui rajoute un mooc a la base de donner + le mooc ne sera pas actif(actif=0) IL FAUT ATTENDRE LA CONFIRMATION PAR MAIL 
	$requete = $this->db->prepare("UPDATE mooc_avenir SET VALUES(default, :name, :prenom,:email,:nomcour,:date, :heure, :description,:lienvideo, :id_categorie, NULL, 0) WHERE Id_cour=:id_cour");
	$requete->bindParam(':name',$nom );
	$requete->bindParam(':prenom',$prenom );
	$requete->bindParam(':email',$email );
	$requete->bindParam(':nomcour',$nomcour );
	$requete->bindParam(':date',$date );
	$requete->bindParam(':heure',$heure );
	$requete->bindParam(':description',$description );
	$requete->bindParam(':lienvideo',$lienV );
	$requete->bindParam(':id_categorie',$id_categorie);
	$requete->bindParam(':Id_cour',$Id_cour);
	$requete->execute();
	}
	
	
	function AnnulerMooc($id_cour){//SUPPRIME LE MOOC il est donc annulé
	$requete = $this->db->prepare("DELETE from cours WHERE Id_cour =:id_cour");
	$requete->bindParam(':id_cour',$id_cour );
	$requete->execute();
	}
	
	function VoirMooc(){// permer de retouner un tableau de tous les mooc 
	$requete = $this->db->prepare('SELECT * FROM mooc_avenir');
	$requete->execute();
	$tab=$requete->fetchAll(PDO::FETCH_ASSOC);
	return( $tab);
	}
	
	function VoirMoocTrierCategorie($id_categorie){// permer de retouner un tableau de tous les mooc trié selon une certaine categorie
	$requete = $this->db->prepare('SELECT * FROM mooc_avenir where id_categorie=:id_categorie');
	$requete->bindParam(':id_categorie',$id_categorie );
	$requete->execute();
	$tab=$requete->fetchAll(PDO::FETCH_ASSOC);
	return( $tab);
	}
	
	
	
	function DejaInscrit($id_membre,$id_cour){// permer de retouner un tableau de tous les mooc trié selon une certaine categorie
	$requete = $this->db->prepare('SELECT COUNT(*) as total FROM mooc_inscription Where Id_membre =:Id_membre && Id_cour =:Id_cour');
	$requete->bindParam(':Id_membre',$id_membre );
	$requete->bindParam(':Id_cour',$id_cour );
	$requete->execute();
	$tab=$requete->fetch(PDO::FETCH_ASSOC);
	return $tab['total'];
	}
	
	function inscription($idMembre,$idcour){//inscrit le membre et donc le lie au cour
	$requete = $this->db->prepare("INSERT into mooc_inscription VALUES(:idcour, :idMembre)");
	$requete->bindParam(':idcour',$idcour );
	$requete->bindParam(':idMembre',$idMembre );
	$requete->execute();
	}
	
	function desinscription($idMembre,$idcour){//desinscrit le membre et donc le retire du cour
	$requete = $this->db->prepare("DELETE from mooc_inscription WHERE Id_cour =:idcour && Id_membre =:idMembre");
	$requete->bindParam(':idcour',$idcour );
	$requete->bindParam(':idMembre',$idMembre );
	$requete->execute();
	}
	
	
	
	
}
?>
