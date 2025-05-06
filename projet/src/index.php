<?php
$host = 'localhost'; //variables de connexion
$dbname = 'ttonon';
$username = 'ttonon';
$password = 'bddttonon';
try {
    echo "5";
$bdd = new PDO('mysql:host='. $host .';dbname='. $dbname .';charset=utf8',
$username, $password);
} catch(Exception $e) {
// Si erreur, tout arrêter
die('Erreur : '. $e->getMessage());
}
$requete = "SELECT * FROM Eleve";
echo "1";



$resultat = $bdd->query($requete);
echo "2";
$ligne = $resultat->fetchAll(); // On récupère la première ligne
echo "3";
foreach($eleve as $ligne){
    echo $eleve['nom']."   ".$eleve['prenom']."<br>";
} 
echo "4";
?>

<h1>Bonjour ah</h1>