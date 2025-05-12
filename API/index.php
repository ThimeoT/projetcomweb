<?php
header("Access-Control-Allow-Origin: *"); // Autorise toutes les origines
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Méthodes autorisées
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // En-têtes autorisés

// echo password_hash("clairepwd",PASSWORD_DEFAULT);
require_once('connexionBDD.php');
require_once 'fonctions.php';

$url = explode('/', $_GET['url'] ?? '');

if ($url[0] === 'connexion' && isset($url[1]) && isset($url[2])) {
    $email =$url[1];
    $mdp = $url[2];
    $user = verifierConnexion($email, $mdp);
    
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
if ($url[0] === 'notes_eleve' && isset($url[1])) {
    $id =intval($url[1]);
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

envoiJSON([
    'success' => false,
    'message' => 'Route inconnue'
]);
//verifierConnexion("claire.lemoine@example.com","clairepwd")
?>
