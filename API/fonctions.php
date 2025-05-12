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
    // récupère les notes d'un élève

    global $bdd;
    $requete = "SELECT Eleve.id AS id_eleve,
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
    return envoiJSON($ligne);
}
?>