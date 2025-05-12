import { useState } from 'react';
import ConnexionEleve from './ConnexionEleve.jsx';

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
          <h1>Bon retour parmis nous {prenomProfil} !</h1>
          <button onClick={() => Deconnecter()}>Se Déconnecter</button>
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