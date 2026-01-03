<?php
session_start();

// Configuración de la base de datos
define('DB_HOST', 'sql207.infinityfree.com');
define('DB_USER', 'if0_40817454');
define('DB_PASS', 'Iy59XK87XpG9Id');
define('DB_NAME', 'if0_40817454_pasteleria');

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