<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.html');
    exit();
}

$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

if ($usuario === 'admin_sur' && $contrasena === 'admin_sur') {
    $_SESSION['usuario'] = usuario;
    header('Location: index.php');
    exit;
} else {
    echo "<script>
        alert('Usuario o contraseña incorrectos');
        window.location.href='../login.html';
    </script>";
}
?>
