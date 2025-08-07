SELECT clientes.nombre, pedidos.producto, pedidos.cantidad
FROM clientes
INNER JOIN pedidos ON clientes.id_cliente = pedidos.id_cliente;

SELECT nombre AS info, 'Cliente' AS tipo FROM clientes
UNION
SELECT c.nombre AS info, CONCAT('Pedido: ', p.producto, ', Cantidad: ', p.cantidad) AS tipo
FROM pedidos p
JOIN clientes c ON p.id_cliente = c.id_cliente;
