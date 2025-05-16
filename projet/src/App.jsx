import { useState } from 'react';
import ConnexionEleve from './ConnexionEleve.jsx';
import ListeNotes from './ListeNotes.jsx';

function App() {
  const [connexion, setConnexion] = useState(false); // sert à actualiser le composant ConnexionEleve
  const [prenomProfil, setPrenomProfil] = useState(""); // sert à actualiser le message d'affichage principal
  const [idProfil, setIdProfil] = useState(-1); // sert à actualiser le composant ListeNotes

  const ActualiserConnexion = (objet) => {
    setConnexion(objet.connexion); // actualise l'état de la connexion en true ou false selon la propriété de l'objet
    console.log("État de connexion :", objet.connexion);
    if (objet.connexion) { // si on est connecté
      console.log(objet.profil)
      setPrenomProfil(objet.prenom); // Utilise la propriété `prenom`
      setIdProfil(objet.id);
    }
  };
  const Deconnecter = () => {
    setConnexion(false)
    setPrenomProfil("")
  }

  return (
    <>
    
      {connexion ? (// si on est connecté, on affiche le message le bouton de déconnexion et les notes
        <> 
          <h1>Bon retour parmi nous {prenomProfil} !</h1>
          <button onClick={() => Deconnecter()}>Se Déconnecter</button>
          <ListeNotes id_eleve={idProfil}/>
        </>
      ) : ( // sinon on affiche le message d'accueil et le formulaire de connexion
        <>
          <h1>Bienvenue</h1>
          <ConnexionEleve ActualiserConnexion2={ActualiserConnexion} />
        </>
      )}
    </>
  );
}

export default App;