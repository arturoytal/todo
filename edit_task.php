<?php
// Suponiendo que estás usando PDO para la conexión a la base de datos
$pdo = new PDO('mysql:host=tu_host;dbname=tu_base_de_datos', 'usuario', 'contraseña');
$stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = ?");
$stmt->execute([$_GET['id']]);
$tarea = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualizar la tarea
    $stmt = $pdo->prepare("UPDATE tareas SET tarea = ? WHERE id = ?");
    $stmt->execute([$_POST['tarea'], $_GET['id']]);
    header('Location: index.php');
    exit;
}
?>

<form action="" method="post">
    <input type="text" name="tarea" value="<?php echo htmlspecialchars($tarea['tarea']); ?>">
    <button type="submit">Guardar Cambios</button>
</form>
