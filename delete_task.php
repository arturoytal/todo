<?php
include 'config.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM todo WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Tarea eliminada.";
    } else {
        echo "Error al eliminar la tarea: " . $conn->error;
    }
}

$conn->close();
header("Location: index.php");
exit();
?>
