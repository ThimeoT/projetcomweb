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
    const [identifiant, setIdentifiant] = useState("");
    const [motDePasse, setMotDePasse] = useState("");
    const [message, setMessage] = useState("");

    const actualiserIdentifiant = (event) => setIdentifiant(event.target.value);
    const actualiserMotDePasse = (event) => setMotDePasse(event.target.value);

    const seConnecter = () => {
        console.log(identifiant, motDePasse);
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
                onChange={actualiserIdentifiant}
                placeholder="Identifiant/Mail"
            />
            <br />
            <input
                id="mdpInput"
                type="password"
                value={motDePasse}
                onChange={actualiserMotDePasse}
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