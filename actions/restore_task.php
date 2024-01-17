<?php
include '/config/config.php';

// Obtener el ID de la tarea a restaurar
$id = $_GET['id'];

// Crear conexión
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta para restaurar la tarea
$stmt = $conn->prepare("UPDATE todo SET is_deleted = 0 WHERE id = ?");
$stmt->bind_param("i", $id);

// Ejecutar la consulta y verificar si fue exitosa
if ($stmt->execute()) {
    echo "Tarea restaurada con éxito.";
} else {
    echo "Error al restaurar la tarea: " . $conn->error;
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();

// Redirigir de vuelta a index.php
header("Location: index.php");
exit;
?>
