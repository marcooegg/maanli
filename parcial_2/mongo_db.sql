-- Borrar tablas si existen para recrear todo desde cero
DROP TABLE IF EXISTS producto CASCADE;
DROP TABLE IF EXISTS proveedor CASCADE;
DROP TABLE IF EXISTS categoria CASCADE;

CREATE TABLE IF NOT EXISTS categoria (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE categoria ADD CONSTRAINT categoria_code_unique UNIQUE (code);

CREATE TABLE IF NOT EXISTS proveedor (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS producto (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    categoria_id INT REFERENCES categoria(id),
    proveedor_id INT REFERENCES proveedor(id),
    precio INT,
    stock INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- INSERT INTO categoria (name, code) VALUES
--     ('Electrónica', 'ELEC'),
--     ('Ropa', 'ROPA'),
--     ('Hogar', 'HOGA'),
--     ('Libros', 'LIBR'),
--     ('Juguetes', 'JUGU');

-- Variables no existen en PostgreSQL, usar CTEs o subconsultas directas en los inserts

INSERT INTO proveedor (name) VALUES
    ('Proveedor A'),
    ('Proveedor B'),
    ('Proveedor C'),
    ('Proveedor D'),
    ('Proveedor E');

-- Variables no existen en PostgreSQL, usar subconsultas directas en los inserts


-- Notebook Lenovo IdeaPad
INSERT INTO categoria (name, code) VALUES ('Electrónica', 'ELEC');
INSERT INTO producto (name, categoria_id, proveedor_id, precio, stock)
VALUES ('Notebook Lenovo IdeaPad', (SELECT id FROM categoria WHERE code = 'ELEC'), (SELECT id FROM proveedor WHERE name = 'Proveedor A'), 750000, 15);

-- Remera de algodón
INSERT INTO categoria (name, code) VALUES ('Indumentaria', 'INDU');
INSERT INTO producto (name, categoria_id, proveedor_id, precio, stock)
VALUES ('Remera de algodón', (SELECT id FROM categoria WHERE code = 'INDU'), (SELECT id FROM proveedor WHERE name = 'Proveedor A'), 6500, 200);

-- Smart TV Samsung 50''
INSERT INTO producto (name, categoria_id, proveedor_id, precio, stock)
VALUES ('Smart TV Samsung 50"', (SELECT id FROM categoria WHERE code = 'ELEC'), (SELECT id FROM proveedor WHERE name = 'Proveedor B'), 420000, 8);

-- Zapatillas deportivas
INSERT INTO categoria (name, code) VALUES ('Calzado', 'CALZ');
INSERT INTO producto (name, categoria_id, proveedor_id, precio, stock)
VALUES ('Zapatillas deportivas', (SELECT id FROM categoria WHERE code = 'CALZ'), (SELECT id FROM proveedor WHERE name = 'Proveedor B'), 28000, 120);

-- Yerba Mate Orgánica
INSERT INTO categoria (name, code) VALUES ('Alimentos', 'ALIM');
INSERT INTO producto (name, categoria_id, proveedor_id, precio, stock)
VALUES ('Yerba Mate Orgánica', (SELECT id FROM categoria WHERE code = 'ALIM'), (SELECT id FROM proveedor WHERE name = 'Proveedor D'), 3200, 500);

-- Heladera con freezer
INSERT INTO categoria (name, code) VALUES ('Electrodomésticos', 'ELEM');
INSERT INTO producto (name, categoria_id, proveedor_id, precio, stock)
VALUES ('Heladera con freezer', (SELECT id FROM categoria WHERE code = 'ELEM'), (SELECT id FROM proveedor WHERE name = 'Proveedor A'), 610000, 5);
