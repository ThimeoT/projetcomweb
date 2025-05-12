<?php
require_once("connexionBDD.php");
function envoiJSON($tab)
{
    header('Content-Type: application/json');
    //print_r($tab);
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
        // Ne jamais renvoyer le hash
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
                FROM resultat r
                JOIN evaluation e ON r.id_eval = e.id
                JOIN matiere m ON e.id_matiere = m.id
                WHERE r.id_eleve = ?";
    $stmt = $bdd->prepare($requete);
    $stmt->execute([$eleve_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>