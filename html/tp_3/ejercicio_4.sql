CREATE TRIGGER before_insert_pedidos
BEFORE INSERT ON pedidos
FOR EACH ROW
BEGIN
    IF NEW.fecha_pedido IS NULL THEN
        SET NEW.fecha_pedido = CURDATE();
    END IF;
END;

CREATE TRIGGER after_update_pedidos
AFTER UPDATE ON pedidos
FOR EACH ROW
BEGIN
    INSERT INTO auditoria_pedidos (id_pedido, old_cantidad, new_cantidad, fecha_modificacion)
    VALUES (OLD.id_pedido, OLD.cantidad, NEW.cantidad, NOW());
END;

