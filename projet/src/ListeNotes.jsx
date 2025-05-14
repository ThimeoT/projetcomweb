import { useEffect, useState } from 'react';
import CarteNote from './CarteNote';

function ListeNotes({ id_eleve }) {
    const [notes, setNotes] = useState([]);
    const [message, setMessage] = useState("");

    useEffect(() => {
        if (id_eleve === -1) return;
        fetch(`https://ttonon.zzz.bordeaux-inp.fr/projetcomweb/API/index.php?methode=notes_eleve&id=${id_eleve}`)
            .then(reponse => reponse.json())
            .then(data => {
                if (data.success) {
                    // On filtre pour ne garder que la version objet (et pas les index numériques)
                    const notesPropres = data.notes.map(note => ({
                        date: note.date,
                        matiere: note.matiere,
                        note_obtenue: note.note_obtenue,
                        bareme: note.bareme
                    }));
                    setNotes(notesPropres);
                } else {
                    setMessage(data.message || "Aucune note trouvée.");
                }
            })
            .catch(() => setMessage("Erreur lors de la récupération des notes."));
    }, [id_eleve]);

    if (message) return <p>{message}</p>;

    return (
        <div>
            <h2>Liste des notes</h2>
            {notes.length === 0 && <p>Aucune note à afficher.</p>}
            {notes.map((note, idx) => (
                <CarteNote
                    key={idx}
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