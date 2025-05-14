<?php
require_once("connexionBDD.php");
function envoiJSON($tab)
{
    header('Content-Type: application/json');
    $json = json_encode($tab, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
}

function verifierConnexion($email, $mdp)
{
    global $bdd;
    // Préparer la requête pour récupérer l'utilisateur par ID
    $requete = "SELECT id, nom, prenom, mail, mdp_hash FROM Eleve WHERE mail = ?";
    $reponse = $bdd->prepare($requete);
    $reponse->execute(array($email));

    // Vérifier si l'utilisateur existe
    $user = $reponse->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($mdp, $user['mdp_hash'])) {
        // on retire le mot de passe avec le hash
        unset($user['mdp_hash']);
        return $user; // retourne les données de l'utilisateur
    }
    return false; // soit l'utilisateur n'existe pas, soit le mot de passe est faux
}


function recupNotes($eleve_id)
{
    global $bdd;
    $requete = "SELECT 
                    m.nom AS matiere,
                    e.date,
                    r.note_obtenue,
                    r.bareme
                FROM Resultat r
                JOIN Evaluation e ON r.id_eval = e.id
                JOIN Matiere m ON e.id_matiere = m.id
                WHERE r.id_eleve = ?";
    $reponse = $bdd->prepare($requete);
    $reponse->execute([$eleve_id]);
    $notes=$reponse->fetchAll(PDO::FETCH_ASSOC);
    return $notes;

}
?>