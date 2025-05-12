import { useEffect, useState } from 'react';

function CarteNote({ date, matiere, note_obtenue, bareme }) {
    return (
        <div style={{ border: "1px solid #ccc", margin: "10px", padding: "10px", borderRadius: "8px" }}>
            <div><strong>Date :</strong> {date}</div>
            <div><strong>Matière :</strong> {matiere}</div>
            <div><strong>Note :</strong> {note_obtenue} / {bareme}</div>
        </div>
    );
}
export default CarteNote;