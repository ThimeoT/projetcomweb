import { useState } from 'react';
import ConnexionEleve from './ConnexionEleve.jsx';
import ListeNotes from './ListeNotes.jsx';

function App() {
  const [connexion, setConnexion] = useState(false);
  const [prenomProfil, setPrenomProfil] = useState("");
  const [idProfil, setIdProfil] = useState(-1);

  const ActualiserConnexion = (objet) => {
    setConnexion(objet.connexion); // Utilise la propriété `success`
    console.log("État de connexion :", objet.connexion);
    if (objet.connexion) {
      console.log(objet.profil)
      setPrenomProfil(objet.prenom); // Utilise la propriété `nom`
      setIdProfil(objet.id);
    }
  };
  const Deconnecter = () => {
    setConnexion(false)
    setPrenomProfil("")
  }

  return (
    <>
    
      {connexion ? (
        <>
          <h1>Bon retour parmi nous {prenomProfil} !</h1>
          <button onClick={() => Deconnecter()}>Se Déconnecter</button>
          <ListeNotes id_eleve={idProfil}/>
        </>
      ) : (
        <>
          <h1>Bienvenue</h1>
          <ConnexionEleve ActualiserConnexion2={ActualiserConnexion} />
        </>
      )}
    </>
  );
}

export default App;