CREATE VIEW vista_clientes_pedidos AS
SELECT c.nombre, p.producto, p.cantidad
FROM clientes c
INNER JOIN pedidos p ON c.id_cliente = p.id_cliente;

SELECT * FROM vista_clientes_pedidos;
