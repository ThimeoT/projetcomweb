<?php
//connexion à zzz
$host = 'localhost'; //variables de connexion
$dbname = 'ttonon';
$username = 'ttonon';
$password = 'bddttonon';

// pour se connecter à xampp en local
// $host = 'localhost'; //variables de connexion
// $dbname = 'ttonon';
// $username = 'root';
// $password = '';
// $claire = password_hash("clairepwd",PASSWORD_DEFAULT);
// echo(password_verify("clairepwd",hash: $claire));
try {
$bdd = new PDO('mysql:host='. $host .';dbname='. $dbname .';charset=utf8',
$username, $password);
} catch(Exception $e) {
// Si erreur, tout arrêter
die('Erreur : '. $e->getMessage());
}

?>
