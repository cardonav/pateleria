CREATE DATABASE IF NOT EXISTS pasteleria;
USE pasteleria;

-- Tabla de pedidos
CREATE TABLE pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_cliente VARCHAR(100) NOT NULL,
    pastel_basico INT DEFAULT 0,
    pastel_mediano INT DEFAULT 0,
    pastel_grande INT DEFAULT 0,
    estado ENUM('recepcionado', 'despachado') DEFAULT 'recepcionado',
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) DEFAULT 0
);

-- Insertar datos de ejemplo
INSERT INTO pedidos (nombre_cliente, pastel_basico, pastel_mediano, pastel_grande, estado, total) VALUES
('María González', 2, 1, 0, 'despachado', 45.00),
('Juan Pérez', 1, 0, 1, 'recepcionado', 55.00),
('Ana Rodríguez', 3, 2, 1, 'recepcionado', 110.00);

-- Tabla de precios (opcional, para facilitar cambios de precios)
CREATE TABLE precios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipo_pastel VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

INSERT INTO precios (tipo_pastel, precio) VALUES
('pastel_basico', 15.00),
('pastel_mediano', 25.00),
('pastel_grande', 40.00);