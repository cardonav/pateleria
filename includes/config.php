<?php
session_start();

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pasteleria');

// Precios de los pasteles
define('PRECIO_BASICO', 15.00);
define('PRECIO_MEDIANO', 25.00);
define('PRECIO_GRANDE', 40.00);

// Conexión a la base de datos
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Verificar conexión
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }
    
    // Establecer charset
    $conn->set_charset("utf8");
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

// Función para calcular el total
function calcularTotal($basico, $mediano, $grande) {
    return ($basico * PRECIO_BASICO) + ($mediano * PRECIO_MEDIANO) + ($grande * PRECIO_GRANDE);
}
?>