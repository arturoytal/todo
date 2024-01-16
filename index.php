<?php
include 'config.php';

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, task, completed FROM todo ORDER BY completed ASC, id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Tareas con Magd</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <h1>Lista de Tareas y tal</h1>
    <form action="add_task.php" method="post">
        <input type="text" name="task" placeholder="Añadir nueva tarea">
        <button type="submit">Agregar</button>
    </form>

    <ul>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<li>";
            $checked = $row["completed"] ? "checked" : "";
            echo "<input type='checkbox' $checked onclick='toggleTask(" . $row["id"] . ")'>";
            echo " " . $row["task"];
            echo " <a href='delete_task.php?id=" . $row["id"] . "'>Eliminar</a>";
            echo "</li>";
        }
    } else {
        echo "<li>No hay tareas</li>";
    }
    ?>
    </ul>

    <script>
    function toggleTask(taskId) {
        window.location.href = 'toggle_task.php?id=' + taskId;
    }
    </script>
</body>
</html>
