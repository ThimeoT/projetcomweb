function CarteNote({ date, matiere, note_obtenue, bareme }) {
    // permet d'afficher les informations d'une note encadrée
    return (
        <div style={{ border: "3px solid #ccc", margin: "10px", padding: "10px", borderRadius: "8px", borderColor: "#dddddd" }}>
            <div><strong>Date :</strong> {date}</div>
            <div><strong>Matière :</strong> {matiere}</div>
            <div><strong>Note :</strong> {note_obtenue} / {bareme}</div>
        </div>
    );
}
export default CarteNote;