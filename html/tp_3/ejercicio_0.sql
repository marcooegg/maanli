CREATE TABLE clientes (
    id_cliente INT PRIMARY KEY,
    nombre VARCHAR(100)
);
CREATE TABLE pedidos (
    id_pedido INT PRIMARY KEY,
    id_cliente INT,
    producto VARCHAR(100),
    cantidad INT,
    fecha_pedido DATE,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);
CREATE TABLE auditoria_pedidos (
    id_auditoria INT PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT,
    old_cantidad INT,
    new_cantidad INT,
    fecha_modificacion DATETIME
);
