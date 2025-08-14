# app.py
from flask import Flask, request, jsonify
from flask_cors import CORS
from datetime import datetime
import sqlite3

app = Flask(__name__)
CORS(app)

DB_NAME = "juri_mobile.db"

def init_db():
    conn = sqlite3.connect(DB_NAME)
    cur = conn.cursor()
    cur.execute("""
    CREATE TABLE IF NOT EXISTS notas (
        id TEXT PRIMARY KEY,
        titulo TEXT,
        contenido TEXT,
        actualizado_en TEXT
    )
    """)
    conn.commit()
    conn.close()

@app.route("/pull", methods=["GET"])
def pull():
    last_sync = request.args.get("last_sync", "")
    conn = sqlite3.connect(DB_NAME)
    cur = conn.cursor()
    if last_sync:
        cur.execute("SELECT * FROM notas WHERE actualizado_en > ?", (last_sync,))
    else:
        cur.execute("SELECT * FROM notas")
    rows = cur.fetchall()
    conn.close()

    notas = []
    for r in rows:
        notas.append({
            "id": r[0],
            "titulo": r[1],
            "contenido": r[2],
            "actualizado_en": r[3]
        })
    return jsonify({"notas": notas})

@app.route("/push", methods=["POST"])
def push():
    data = request.get_json()
    notas = data.get("notas", [])

    conn = sqlite3.connect(DB_NAME)
    cur = conn.cursor()

    for nota in notas:
        cur.execute("SELECT actualizado_en FROM notas WHERE id = ?", (nota["id"],))
        existing = cur.fetchone()
        if not existing:
            # No existe → insertar
            cur.execute("""
                INSERT INTO notas (id, titulo, contenido, actualizado_en)
                VALUES (?, ?, ?, ?)
            """, (
                nota["id"], nota["titulo"], nota["contenido"], nota["actualizado_en"]
            ))
        else:
            # Existe → comparar fecha
            if nota["actualizado_en"] > existing[0]:
                cur.execute("""
                    UPDATE notas SET titulo = ?, contenido = ?, actualizado_en = ?
                    WHERE id = ?
                """, (
                    nota["titulo"], nota["contenido"], nota["actualizado_en"], nota["id"]
                ))

    conn.commit()
    conn.close()
    return jsonify({"status": "ok"})


@app.route("/")
def hello_world():
    return "<p>Hola Mundo!</p>"

if __name__ == "__main__":
    init_db()
    app.run(debug=True, host="0.0.0.0", port=5000)
