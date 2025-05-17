<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once('connexionBDD.php');
require_once 'fonctions.php';

// Utilisation des paramètres GET classiques
$methode = $_GET['methode'] ?? ''; //on détermine ce que l'utilisateur veut récupérer
// si il veut se connecter et que les champs de connexion sont renseignés
if ($methode === 'connexion' && isset($_GET['email']) && isset($_GET['mdp'])) {
    $email = $_GET['email'];
    $mdp = $_GET['mdp'];
    $user = verifierConnexion($email, $mdp);
    // on effectue la requête et on renvoie le résultat de cette dernière
    if ($user) {
        envoiJSON([
            'success' => true,
            'message' => 'Connexion réussie',
            'user' => $user
        ]);
    } else {
        envoiJSON([
            'success' => false,
            'message' => 'Identifiants invalides'
        ]);
    }
    exit;
}
// si on cherche à 'écupérer les notes et que l'id de l'élève est renseigné
if ($methode === 'notes_eleve' && isset($_GET['id'])) { // même chose que pour la connexion
    $id = intval($_GET['id']);
    $notes = recupNotes($id);
    if ($notes) {
        envoiJSON([
            'success' => true,
            'notes' => $notes
        ]);
    } else {
        envoiJSON([
            'success' => false,
            'message' => 'Identifiant invalide'
        ]);
    }
    exit;
}
// dans le cas où le lien ne contient aucun type de requête renseigné donc la route est inconnue
envoiJSON([
    'success' => false,
    'message' => 'Route inconnue'
]);
?>