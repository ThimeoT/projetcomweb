import { useEffect, useState } from 'react';
import CarteNote from './CarteNote';

function ListeNotes({ id_eleve }) {
    const [notes, setNotes] = useState([]); // contient la liste des notes
    const [message, setMessage] = useState(""); // permet d'afficher un message en cas d'erreur

    useEffect(() => {
        if (id_eleve === -1) return; // traitement de la valeur par défaut
        fetch(`https://ttonon.zzz.bordeaux-inp.fr/projetcomweb/API/index.php?methode=notes_eleve&id=${id_eleve}`)
            .then(reponse => reponse.json())
            .then(data => {
                if (data.success) { // si la propriété succes est true
                    // on filtre pour ne garder que la version objet (et pas les index numériques de la requête)
                    const notesPropres = data.notes.map(note => ({
                        date: note.date,
                        matiere: note.matiere,
                        note_obtenue: note.note_obtenue,
                        bareme: note.bareme
                    }));
                    setNotes(notesPropres);
                } else { // dans le cas où success est false
                    setMessage(data.message || "Aucune note trouvée.");
                }
            })
            .catch(() => setMessage("Erreur lors de la récupération des notes."));
    }, [id_eleve]);

    if (message) return <p>{message}</p>; // si le message d'erreur n'est pas vide on l'affiche

    return ( // sinon on affiche les notes
        <div>
            <h2>Liste des notes</h2>
            {notes.length === 0 && <p>Aucune note à afficher.</p>}
            {notes.map((note, index) => (
                <CarteNote
                    key={index}
                    date={note.date}
                    matiere={note.matiere}
                    note_obtenue={note.note_obtenue}
                    bareme={note.bareme}
                />
            ))}
        </div>
    );
}

export default ListeNotes;