<?php
try {
			$db = new PDO("mysql:host=localhost;dbname=thintank","root","");
			$db->query('set NAMES utf8');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "connexion a la base de donner reussi";
		}
		catch (PDOException $e) {
			die ("Erreur numéro" . $e -> getcode() . " : " . $e->getMessage());
		}
	
	?>