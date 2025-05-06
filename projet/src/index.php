<?php
$host = 'localhost'; //variables de connexion
$dbname = 'ttonon';
$username = 'ttonon';
$password = 'bddttonon';
try {
$bdd = new PDO('mysql:host='. $host .';dbname='. $dbname .';charset=utf8',
$username, $password);
} catch(Exception $e) {
// Si erreur, tout arrêter
die('Erreur : '. $e->getMessage());
}
$requete = "SELECT * FROM Eleve";
$resultat = $bdd->query($requete);
$ligne = $resultat->fetchAll(); // On récupère la première ligne

// foreach( $ligne as $eleve) { // On affiche les résultats
//     echo $eleve['nom']."   ".$eleve['prenom']."<br>";
// } 






// verifierConnexion("claire.lemoine@example.com","clairepwd")
recupNotes(1);

?>




