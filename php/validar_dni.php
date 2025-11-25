<?php
// Configuración de conexión
$host = "sql100.byethost7.com";
$dbname = "b7_40510877_valinor";
$user = "b7_40510877";
$pass = "4jyvgxcr";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dni = $_POST['dni'] ?? '';

    if (empty($dni)) {
        echo json_encode(["existe" => false]);
        exit;
    }

    $sql = "SELECT COUNT(*) FROM invitados WHERE dni = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$dni]);
    $existe = $stmt->fetchColumn() > 0;

    echo json_encode(["existe" => $existe]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
