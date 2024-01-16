<?php
include 'config.php';

// Depurar los datos enviados a través del formulario
var_dump($_POST);

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $conn->real_escape_string($_POST['task']);

    $sql = "INSERT INTO tasks (task, completed) VALUES ('$task', 0)";

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
