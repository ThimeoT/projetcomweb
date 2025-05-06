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

function envoiJSON($tab){
    header('Content-Type: application/json');
    //print_r($tab);
    $json = json_encode($tab, JSON_UNESCAPED_UNICODE);
    echo $json;
}

function recupNotes($eleve_id){
    // récupère les notes d'un élève
    
    global $bdd;
    $requete = "SELECT Eleve.id 
    AS id_eleve,
    Eleve.nom,
    Eleve.prenom,
    Matiere.nom AS matiere,
    Evaluation.date,
    Resultat.note_obtenue,
    Resultat.bareme,
    Resultat.type_bareme
    FROM Resultat
    JOIN Eleve ON Resultat.id_eleve = Eleve.id
    JOIN Evaluation ON Resultat.id_eval = Evaluation.id
    JOIN Matiere ON Evaluation.id_matiere = Matiere.id
    WHERE Eleve.id = $eleve_id";
    $resultat = $bdd->query($requete);
    $ligne = $resultat->fetchAll();
    envoiJSON($ligne);

}

function verifierConnexion($email,$mdp){
    // vérifie la connexion d'un élève
    // retourne vrai ou faux
    // Récupération des données envoyées par l'utilisateur

    // Préparer la requête
    global $bdd;
    $requete = "SELECT id, nom, prenom, mail, mdp_hash FROM Eleve WHERE mail = :email";
    $stmt = $bdd->prepare($requete);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Vérifier si l'email existe
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo password_hash("clairepwd", PASSWORD_DEFAULT);
    if ($user) {
        // Vérifier le mot de passe
        if (password_verify($mdp, $user['mdp_hash'])) {
            echo "Connexion réussie !";
            // Rediriger ou commencer une session
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Email non trouvé.";
    }

}


// verifierConnexion("claire.lemoine@example.com","clairepwd")
recupNotes(1);

?>




