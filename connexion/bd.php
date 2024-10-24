<?php
	#Demarer la session
	// Vérifiez si une session est déjà démarrée avant de démarrer une nouvelle session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
	try {
		$pdo=new PDO('mysql:dbname=blog; host=localhost', 'root', '');
	} catch (Exception $e) {
		print $e->getMessage();
	}


