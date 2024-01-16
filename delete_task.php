<?php
include 'config.php';

$id = $_GET['id'];

// Crear conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Marcar la tarea como eliminada
$stmt = $conn->prepare("UPDATE todo SET is_deleted = 1 WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Tarea marcada como eliminada.";
} else {
    echo "Error al actualizar la tarea: " . $conn->error;
}

$stmt->close();
$conn->close();

// Redirigir de vuelta a index.php
header("Location: index.php");
exit;
?>
