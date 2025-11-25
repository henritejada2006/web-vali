<?php
// Configuración de conexión
$host = "sql100.byethost7.com";
$dbname = "b7_40510877_valinor";
$user = "b7_40510877";
$pass = "4jyvgxcr";

try {
    // Conexión con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recoger datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $dni    = $_POST['dni'] ?? '';
    $cp     = $_POST['cp'] ?? '';

    // Validaciones básicas
    if (empty($nombre) || empty($dni) || empty($cp)) {
        die("Todos los campos son obligatorios.");
    }

    // Insertar invitado en la tabla
    $sql = "INSERT INTO invitados (nombre, dni, codigo_postal) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $dni, $cp]);

} catch (PDOException $e) {
    // Captura errores de SQL (por ejemplo, DNI duplicado)
    echo "Error en la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Invitado registrado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlace al CSS externo -->
    <link rel="stylesheet" href="../estilos/confirmacion.css">
</head>
<body>
    <div class="mensaje">
        <h1>✅ Invitado registrado correctamente</h1>
        <p>El invitado se ha guardado en la base de datos.</p>
        <a href="../index.html" class="boton">Ir al menú principal</a>
    </div>
</body>
</html>