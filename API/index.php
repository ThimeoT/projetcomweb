<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once('connexionBDD.php');
require_once 'fonctions.php';

// Utilisation des paramètres GET classiques
$methode = $_GET['methode'] ?? '';
if ($methode === 'connexion' && isset($_GET['email']) && isset($_GET['mdp'])) {
    $email = $_GET['email'];
    $mdp = $_GET['mdp'];
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

if ($methode === 'notes_eleve' && isset($_GET['id'])) {
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

envoiJSON([
    'success' => false,
    'message' => 'Route inconnue'
]);
?>