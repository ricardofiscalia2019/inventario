<?php
session_start();
require_once 'conexion.php';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    try {
        $sql = "SELECT contrasena FROM usuarios WHERE usuario = :usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuario]);
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioData && $contrasena === $usuarioData['contrasena']) {
            $_SESSION['usuario'] = $usuario;
            header("Location: ../index.php");
            exit();
        } else {
            echo "<p>Usuario o contraseña incorrectos. <a href='../login.html'>Intenta de nuevo</a></p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error al iniciar sesión: " . $e->getMessage() . "</p>";
        echo "<p><a href='../login.html'>Volver al inicio de sesión</a></p>";
    }
}
?>