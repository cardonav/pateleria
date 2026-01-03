<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

if (eliminarPedido($conn, $id)) {
    $_SESSION['mensaje'] = "Pedido eliminado exitosamente";
    $_SESSION['tipo_mensaje'] = "success";
} else {
    $_SESSION['mensaje'] = "Error al eliminar el pedido";
    $_SESSION['tipo_mensaje'] = "danger";
}

header("Location: index.php");
exit();
?>