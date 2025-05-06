<?php 
require_once "connexion.php";
require_once 'fonctions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    $eleve = recupEleves($bdd, $id);
    if ($eleve) {
        envoiJSON($eleve);
    } else {
        envoiJSON(["erreur" => "Élève introuvable"]);
    }
} else {
    envoiJSON(["erreur" => "ID non fourni"]);
}

?>


