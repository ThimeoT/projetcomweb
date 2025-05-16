import { useState } from 'react';
import './App.css';

function MonBouton(props) {
    return (
        <button onClick={props.onClick}>
            {props.label}
        </button>
    );
}

function ConnexionEleve(props) {
    const [identifiant, setIdentifiant] = useState(""); // permet de récupérer l'id de l'élève
    const [motDePasse, setMotDePasse] = useState(""); // même chose pour le mot de passe
    const [message, setMessage] = useState(""); // gestion des messages d'erreur
    // pour chaque fonction on récupère la valeur de l'input associé
    const actualiserIdentifiant = (event) => setIdentifiant(event.target.value); 
    const actualiserMotDePasse = (event) => setMotDePasse(event.target.value);

    const seConnecter = () => {
        //console.log(identifiant, motDePasse); permettant de vérifier que l'on a bien rentré le bon mot de passe 
        const url = `https://ttonon.zzz.bordeaux-inp.fr/projetcomweb/API/index.php?methode=connexion&email=${identifiant}&mdp=${motDePasse}`;
        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    setMessage("Connexion réussie !");
                    props.ActualiserConnexion2({ connexion: data.success, prenom: data.user.prenom, profil: data.user, id: data.user.id }); // Harmonisation des noms
                } else {
                    setMessage("Échec de la connexion.");
                    props.ActualiserConnexion2({ connexion: false });
                }
            })
            .catch((error) => {
                console.error("Erreur :", error);
                setMessage("Erreur lors de la connexion.");
            });
    };

    return (
        <div className="connexion-container">
            <img src="/poulpe.png" alt="Poulpe mignon" className="poulpe" />
            <input
                id="emailInput"
                type="email"
                value={identifiant}
                onChange={actualiserIdentifiant} //attribut onChange qui aurait pu être codé avec un useEvent
                placeholder="Identifiant/Mail"
            />
            <br />
            <input
                id="mdpInput"
                type="password"
                value={motDePasse}
                onChange={actualiserMotDePasse} // même chose ici
                placeholder="Mot de passe"
            />
            <br />
            <br />
            <MonBouton label="Connexion" onClick={seConnecter} />
            <p>{message}</p>
        </div>
    );
}

export default ConnexionEleve;