<?php
require_once 'conexion.php';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES (:usuario, :contrasena)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuario, ':contrasena' => $contrasena]);
        echo "<p>Usuario registrado exitosamente. <a href='login.html'>Inicia sesión aquí</a></p>";
    } catch (PDOException $e) {
        echo "<p>Error al registrar el usuario: " . $e->getMessage() . "</p>";
        echo "<p><a href='registro.html'>Volver al registro</a></p>";
    }
}
?>
