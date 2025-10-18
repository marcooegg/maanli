import pprint
import json
import logging
from flask import Flask, request
from pymongo.mongo_client import MongoClient
from pymongo.server_api import ServerApi
from flask_cors import CORS
import psycopg
import psycopg2
from psycopg2.extras import RealDictCursor

_logger = logging.getLogger(__name__)

class JuriDatabaseConnector:

    def get_connection(self):
        conn = psycopg2.connect(
            dbname="mongo_db",
            user="mongo_user",
            password="mongo_user",
            host="localhost",
            port=5432
        )
        return conn

    # Ejemplo de uso:
    def test_connection(self):
        with self.get_connection() as conn:
            with conn.cursor() as cur:
                cur.execute("SELECT version();")
                res = cur.fetchone()
                print(res)
                return res
            
    def populate_table(self):
        with self.get_connection() as conn:
            with conn.cursor() as cur:
                with open("/home/marco/workspace/facu/maanli/parcial_2/mongo_db.sql", 'r') as f:
                    sql = f.read()
                for statement in sql.split(';'):
                    print(statement)
                    if statement.strip():
                        cur.execute(statement)
                        print("OK")
                conn.commit()
                cur.close()
                conn.close()

    def get_all(self, table: str) -> list:
        with self.get_connection() as conn:
            # with conn.cursor(row_factory=RealDictCursor) as cur:
            with conn.cursor(cursor_factory=RealDictCursor) as cur:
                cur.execute(f"SELECT * FROM {table}")
                res = cur.fetchall()
                res = [dict(r) for r in res]
                # res = cur.dictfetchall()
                print(f"{table} -> {res}")
                return res

    def get_all_productos(self) -> list:
        with self.get_connection() as conn:
            with conn.cursor(cursor_factory=RealDictCursor) as cur:
                query = """
                    SELECT 
                        p.id,
                        p.name, 
                        c.name AS categoria_id, 
                        pr.name AS proveedor_id,
                        p.precio,
                        p.stock
                    FROM producto p
                    INNER JOIN categoria c ON p.categoria_id = c.id
                    INNER JOIN proveedor pr ON p.proveedor_id = pr.id
                """
                cur.execute(query)
                res = cur.fetchall()
                res = [dict(r) for r in res]
                print(f"productos -> {res}")
                return res

    def add_producto(self, values):
        with self.get_connection() as conn:
            with conn.cursor() as cur:
                keys = values.keys()
                vals = list(values.values())
                columns = ', '.join(keys)
                placeholders = ', '.join(['%s'] * len(vals))
                print(keys)
                print(vals)
                print(columns)
                print(placeholders)
                query = f"""
                INSERT INTO producto ({columns})
                VALUES ({placeholders})
                RETURNING id;
                """
                print(query)
                cur.execute(query, vals)
                new_id = cur.fetchone()[0]
                print(new_id)
                conn.commit()
                return new_id


            


app = Flask(__name__)
CORS(app)

@app.route("/")
def hello_world():
    return "<p>Lorem ipsum</p>"



@app.route("/postgresDB")
def ping_postgress():
    conn = JuriDatabaseConnector()
    print(conn)
    try:
        res = conn.populate_table()
        return {
            "status": "OK",
            "result" : str(res)
        }
    except Exception as e:
        return {
            "status": "ERROR",
            "result" : str(e)
        }

@app.route("/mongoDB", methods=["POST"])
def ping_mongo():
    uri = "mongodb+srv://marcooegg:DzNatdxeh3g6U4sz@juricluster0.mmi5eyq.mongodb.net/?retryWrites=true&w=majority&appName=JuriCluster0"
    # Create a new client and connect to the server
    client = MongoClient(uri, server_api=ServerApi('1'))
    # Send a ping to confirm a successful connection
    try:
        res = client.admin.command('ping')
        return f"<p>Pinged your deployment. You successfully connected to MongoDB!{res}</p>"
    except Exception as e:
        print(e)
        return f"{e}"
    
@app.route("/mongoDB_add", methods=["POST"])
def add_mongo_product(**kwargs):
    data = request.get_json()
    if not data:
        raise ValueError("No JSON data provided in request")
    return _add_mongo_product(**data)

def _add_mongo_product(**kwargs):
    try: 
        uri = "mongodb+srv://marcooegg:DzNatdxeh3g6U4sz@juricluster0.mmi5eyq.mongodb.net/?retryWrites=true&w=majority&appName=JuriCluster0"
        client = MongoClient(uri, server_api=ServerApi('1'))
        db = client['tienda']
        collection = db['productos']
        collection.insert_one(kwargs)
        print(kwargs)
        return {
            "status": "success",
            "message" : "ok"
        }
    except Exception as e:
        return {
            "status": "Error",
            "message": e,
        }

def _get_mongo_products():
    try: 
        uri = "mongodb+srv://marcooegg:DzNatdxeh3g6U4sz@juricluster0.mmi5eyq.mongodb.net/?retryWrites=true&w=majority&appName=JuriCluster0"
        client = MongoClient(uri, server_api=ServerApi('1'))
        db = client['tienda']
        collection = db['productos']
        
        res = list(collection.find({}))
        return {
            "status": "success",
            "message": res
        }
    except Exception as e:
        return {
            "status": "Error",
            "message": e,
        }


@app.route("/get_proveedores", methods=["GET"])
def get_proveedores():
    conn = JuriDatabaseConnector()
    try:
        res = conn.get_all("proveedor")
        return {
            "status": "OK",
            "result": res
        }
    except Exception as e:
        return {
            "status": "ERROR",
            "result": str(e)
        }
        
@app.route("/get_categorias", methods=["GET"])
def get_categorias():
    conn = JuriDatabaseConnector()
    try:
        res = conn.get_all("categoria")
        return {
            "status": "OK",
            "result": res
        }
    except Exception as e:
        return {
            "status": "ERROR",
            "result": str(e)
        }

@app.route("/get_productos", methods=["GET"])
def get_productos():
    conn = JuriDatabaseConnector()
    try:
        res = conn.get_all_productos()
        uri = "mongodb+srv://marcooegg:DzNatdxeh3g6U4sz@juricluster0.mmi5eyq.mongodb.net/?retryWrites=true&w=majority&appName=JuriCluster0"
        client = MongoClient(uri, server_api=ServerApi('1'))
        db = client['tienda']
        collection = db['productos']
        mongo_products = list(collection.find({}))
        # Crear un dict para acceder rápido por id
        mongo_by_id = {prod.get("id"): prod for prod in mongo_products if "id" in prod}
        for rec in res:
            caracs = mongo_by_id.get(rec.get("id"), {}).get("caracteristicas", [])
            rec["caracteristicas"] = caracs
        print(res)
        return {
            "status": "OK",
            "result": res
        }
    except Exception as e:
        return {
            "status": "ERROR",
            "result": str(e)
        }

@app.route("/add_producto", methods=["POST"])
def add_producto(**kwargs):
    connector = JuriDatabaseConnector()
    values = request.get_json()
    caracs = []
    if values.get("caracteristicas"):
        caracs = values.pop("caracteristicas")
    res_id = connector.add_producto(values)
    print(res_id)
    values.update({"id": res_id, "caracteristicas": caracs})
    return _add_mongo_product(**values)
    