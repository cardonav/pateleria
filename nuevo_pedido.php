<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre_cliente' => $_POST['nombre_cliente'],
        'pastel_basico' => intval($_POST['pastel_basico']),
        'pastel_mediano' => intval($_POST['pastel_mediano']),
        'pastel_grande' => intval($_POST['pastel_grande']),
        'estado' => $_POST['estado']
    ];
    
    if (crearPedido($conn, $datos)) {
        $_SESSION['mensaje'] = "Pedido creado exitosamente";
        $_SESSION['tipo_mensaje'] = "success";
        header("Location: index.php");
        exit();
    } else {
        $error = "Error al crear el pedido";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido - Pastelería</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-plus-circle"></i> Nuevo Pedido</h1>
            <p>Complete los datos del pedido</p>
        </header>
        
        <div class="form-container">
            <div class="precios-info">
                <h4>Precios Actuales:</h4>
                <ul>
                    <li>Pastel Básico: $<?php echo PRECIO_BASICO; ?></li>
                    <li>Pastel Mediano: $<?php echo PRECIO_MEDIANO; ?></li>
                    <li>Pastel Grande: $<?php echo PRECIO_GRANDE; ?></li>
                </ul>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="nombre_cliente">Nombre del Cliente *</label>
                    <input type="text" id="nombre_cliente" name="nombre_cliente" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="pastel_basico">Cantidad Pastel Básico</label>
                    <input type="number" id="pastel_basico" name="pastel_basico" class="form-control" min="0" value="0">
                </div>
                
                <div class="form-group">
                    <label for="pastel_mediano">Cantidad Pastel Mediano</label>
                    <input type="number" id="pastel_mediano" name="pastel_mediano" class="form-control" min="0" value="0">
                </div>
                
                <div class="form-group">
                    <label for="pastel_grande">Cantidad Pastel Grande</label>
                    <input type="number" id="pastel_grande" name="pastel_grande" class="form-control" min="0" value="0">
                </div>
                
                <div class="form-group">
                    <label for="estado">Estado del Pedido</label>
                    <select id="estado" name="estado" class="form-control" required>
                        <option value="recepcionado">Recepcionado</option>
                        <option value="despachado">Despachado</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Pedido
                    </button>
                    <a href="index.php" class="btn btn-danger">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>