<?php
include '../config/config.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // Cambia el estado de 'completed' de la tarea
    $sql = "UPDATE todo SET completed = NOT completed WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Estado de la tarea actualizado.";
    } else {
        echo "Error al actualizar la tarea: " . $conn->error;
    }
}

$conn->close();
header("Location: index.php");
exit();
?>
