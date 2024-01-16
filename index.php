<?php
include 'config.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, task, completed FROM todo"; // Asegúrate de que 'todo' sea el nombre correcto de tu tabla
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Tareas</title>
</head>
<body>
    <h1>Lista de Tareas</h1>
    <form action="add_task.php" method="post">
        <input type="text" name="task" placeholder="Añadir nueva tarea">
        <button type="submit">Agregar</button>
    </form>

    <ul>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<li>";
            if ($row["completed"]) {
                echo "<s>" . $row["task"] . "</s>";
            } else {
                echo $row["task"];
            }
            echo " <a href='toggle_task.php?id=" . $row["id"] . "'>Marcar/Desmarcar</a>";
            echo " <a href='delete_task.php?id=" . $row["id"] . "'>Eliminar</a>";
            echo "</li>";
        }
    } else {
        echo "<li>No hay tareas</li>";
    }
    ?>
    </ul>

    <?php
    $conn->close();
    ?>
</body>
</html>
