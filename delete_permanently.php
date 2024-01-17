<?php
include 'config.php';

// Obtener el ID de la tarea a eliminar de manera permanente
$id = $_GET['id'];

// Crear conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta para eliminar la tarea
$stmt = $conn->prepare("DELETE FROM todo WHERE id = ?");
$stmt->bind_param("i", $id);

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {
    echo "Tarea eliminada permanentemente.";
} else {
    echo "Error al eliminar la tarea: " . $conn->error;
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();

// Redirigir de vuelta a index.php
header("Location: index.php");
exit;
?>
