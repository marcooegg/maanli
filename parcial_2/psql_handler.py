import psycopg

class JuriDatabaseConnector:

    def get_connection(self):
        conn = psycopg.connect(
            dbname="mongo_db",
            user="mongo_user",
            password="mongo_user",
            host="localhost",
            port=5432
        )
        return conn

    # Ejemplo de uso:
    def test_connection(self):
        with get_connection() as conn:
            with conn.cursor() as cur:
                cur.execute("SELECT version();")
                res = cur.fetchone()
                print(res)
                return res
                