<?php
// Configuración de conexión
$host = "localhost";
$dbname = "valinor";
$user = "henri";
$pass = "henri";

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

    echo "Invitado registrado correctamente.";
} catch (PDOException $e) {
    // Captura errores de SQL (por ejemplo, DNI duplicado)
    echo "Error en la base de datos: " . $e->getMessage();
}
?>
