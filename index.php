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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <h1>Lista de Tareas y tal</h1>
    <form action="add_task.php" method="post">
        <input type="text" name="task" id="taskInput" placeholder="Añadir nueva tarea">
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
            echo " &nbsp; - &nbsp; <a href='delete_task.php?id=" . $row["id"] . "'><i class='fas fa-trash'></i></a>";
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
        
        <script>
            window.onload = function() {
                 document.getElementById('taskInput').focus();
        };
        </script>
        
        <?php
$changelog = file_get_contents('CHANGELOG.md');
$version = ''; // Variable para almacenar la versión

// Expresión regular para encontrar la versión
if (preg_match_all('/\#\# \[\d+\.\d+\.\d+\]/', $changelog, $matches)) {
    // Obtener la última versión (la primera en el archivo)
    $version = explode(' ', $matches[0][0])[1];
    $version = trim($version, '[]'); // Eliminar los corchetes
}
?>

<footer>
    <p>Versión: <?php echo $version; ?></p>
</footer>



</body>
</html>
