import { useState } from 'react'
import './App.css'

function MonBouton(props) {
    return (
        <button>
            {props.label}
        </button>
    );
}

function App() {
    const [identifiant, setIdentifiant] = useState("");
    const [motDePasse, setMotDePasse] = useState("");

    const gererIdentifiant = (e) => {
        setIdentifiant(e.target.value);
    };

    const gererMotDePasse = (e) => {
        setMotDePasse(e.target.value);
    };

    return (
        <>
            <input
                type="email"
                value={identifiant}
                onChange={gererIdentifiant}
                placeholder="Identifiant/Mail"
            />
            <br />
            <input
                type="password"
                value={motDePasse}
                onChange={gererMotDePasse}
                placeholder="Mot de passe"
            />
            <br /><br />
            <MonBouton label="Connexion" />
        </>
    );
}


export default App
