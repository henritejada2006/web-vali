<?php
// Configuración de conexión
$host = "localhost";
$dbname = "valinor";
$user = "henri";
$pass = "henri";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recoger datos del formulario
    $nombre       = $_POST['nombre'] ?? '';
    $tipo         = $_POST['tipo'] ?? '';
    $fecha        = $_POST['fecha'] ?? '';
    $hora         = $_POST['hora'] ?? '';
    $responsable  = $_POST['responsable'] ?? '';
    $asistentes   = $_POST['asistentes'] ?? []; // array de socios
    $invitados    = $_POST['dni_invitados'] ?? []; // array de DNIs

    // Insertar actividad
    $sql = "INSERT INTO actividades (nombre, tipo, fecha, hora_inicio, responsable) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $tipo, $fecha, $hora, $responsable]);

    // Obtener el ID de la actividad recién creada
    $actividad_id = $pdo->lastInsertId();

    // Insertar socios asistentes
    if (!empty($asistentes)) {
        $sqlSocio = "INSERT INTO actividad_socios (actividad_id, socio_id) VALUES (?, ?)";
        $stmtSocio = $pdo->prepare($sqlSocio);
        foreach ($asistentes as $socio) {
            $stmtSocio->execute([$actividad_id, $socio]);
        }
    }

    // Insertar invitados (DNIs)
    if (!empty($invitados)) {
        $sqlInv = "INSERT INTO actividad_invitados (actividad_id, dni_invitado) VALUES (?, ?)";
        $stmtInv = $pdo->prepare($sqlInv);
        foreach ($invitados as $dni) {
            if (!empty(trim($dni))) {
                $stmtInv->execute([$actividad_id, trim($dni)]);
            }
        }
    }

    echo "Actividad registrada correctamente.";
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}
?>
