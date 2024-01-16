<?php
include 'config.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $conn->real_escape_string($_POST['task']);

    // Asegúrate de que la columna y la tabla sean las correctas
    $sql = "INSERT INTO todo (task, completed) VALUES ('$task', 0)";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva tarea añadida.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: index.php");
exit();
?>
