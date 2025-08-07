SELECT nombre
FROM clientes
WHERE id_cliente IN (SELECT id_cliente FROM pedidos WHERE cantidad > 1);

SELECT nombre, (SELECT COUNT(*) FROM pedidos WHERE pedidos.id_cliente = clientes.id_cliente) AS total_pedidos
FROM clientes;
