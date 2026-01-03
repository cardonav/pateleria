<?php
// Función para obtener todos los pedidos
function obtenerPedidos($conn) {
    $sql = "SELECT * FROM pedidos ORDER BY fecha_pedido DESC";
    $result = $conn->query($sql);
    
    $pedidos = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $pedidos[] = $row;
        }
    }
    return $pedidos;
}

// Función para obtener un pedido por ID
function obtenerPedidoPorId($conn, $id) {
    $sql = "SELECT * FROM pedidos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

// Función para crear un nuevo pedido
function crearPedido($conn, $datos) {
    $total = calcularTotal($datos['pastel_basico'], $datos['pastel_mediano'], $datos['pastel_grande']);
    
    $sql = "INSERT INTO pedidos (nombre_cliente, pastel_basico, pastel_mediano, pastel_grande, estado, total) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiisd", 
        $datos['nombre_cliente'],
        $datos['pastel_basico'],
        $datos['pastel_mediano'],
        $datos['pastel_grande'],
        $datos['estado'],
        $total
    );
    
    return $stmt->execute();
}

// Función para actualizar un pedido
function actualizarPedido($conn, $id, $datos) {
    $total = calcularTotal($datos['pastel_basico'], $datos['pastel_mediano'], $datos['pastel_grande']);
    
    $sql = "UPDATE pedidos SET 
            nombre_cliente = ?,
            pastel_basico = ?,
            pastel_mediano = ?,
            pastel_grande = ?,
            estado = ?,
            total = ?
            WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiisdi", 
        $datos['nombre_cliente'],
        $datos['pastel_basico'],
        $datos['pastel_mediano'],
        $datos['pastel_grande'],
        $datos['estado'],
        $total,
        $id
    );
    
    return $stmt->execute();
}

// Función para eliminar un pedido
function eliminarPedido($conn, $id) {
    $sql = "DELETE FROM pedidos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Función para obtener estadísticas
function obtenerEstadisticas($conn) {
    $stats = [];
    
    // Total de pedidos
    $sql = "SELECT COUNT(*) as total_pedidos FROM pedidos";
    $result = $conn->query($sql);
    $stats['total_pedidos'] = $result->fetch_assoc()['total_pedidos'];
    
    // Pedidos recepcionados
    $sql = "SELECT COUNT(*) as recepcionados FROM pedidos WHERE estado = 'recepcionado'";
    $result = $conn->query($sql);
    $stats['recepcionados'] = $result->fetch_assoc()['recepcionados'];
    
    // Pedidos despachados
    $sql = "SELECT COUNT(*) as despachados FROM pedidos WHERE estado = 'despachado'";
    $result = $conn->query($sql);
    $stats['despachados'] = $result->fetch_assoc()['despachados'];
    
    // Total de ventas
    $sql = "SELECT SUM(total) as ventas_totales FROM pedidos";
    $result = $conn->query($sql);
    $stats['ventas_totales'] = $result->fetch_assoc()['ventas_totales'] ?? 0;
    
    // Total de pasteles vendidos por tipo
    $sql = "SELECT SUM(pastel_basico) as total_basico, 
                   SUM(pastel_mediano) as total_mediano,
                   SUM(pastel_grande) as total_grande 
            FROM pedidos";
    $result = $conn->query($sql);
    $pasteles = $result->fetch_assoc();
    $stats['pasteles_vendidos'] = $pasteles;
    
    return $stats;
}
?>