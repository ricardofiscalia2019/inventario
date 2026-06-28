<?php
require_once 'conexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $tipo = $_POST['tipo'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $sn = $_POST['sn'];
            $estado = $_POST['estado'];
            $asignado = $_POST['asignado'];
            $funcionario = $_POST['funcionario'] ?? null;
            $usuario = $_POST['usuario'];
            $edificio = $_POST['edificio'];
            $unidadFL = $_POST['unidadFL'];
            $piso = $_POST['piso'];
            $fechaAsignacion = !empty($_POST['fechaAsignacion']) ? $_POST['fechaAsignacion'] : null;
            $fechaBaja = !empty($_POST['fechaBaja']) ? $_POST['fechaBaja'] : null;
            $descripcion = $_POST['descripcion'];

            // Manejo de documento adjunto (acta)
            $archivoActa = $_FILES['documento'] ?? null;
            if ($archivoActa && isset($archivoActa['name']) && $archivoActa['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '/mnt/actas/';
                $nombreOriginal = basename($archivoActa['name']);
                $nombreSeguro = preg_replace('/[^A-Za-z0-9_\\.-]/', '_', $nombreOriginal);
                $timestamp = date('Ymd_His');
                $nombreFinal = $timestamp . '_' . $nombreSeguro;
                $destino = $uploadDir . $nombreFinal;
                @move_uploaded_file($archivoActa['tmp_name'], $destino);
            }

            $sql = "INSERT INTO productos (
                tipo, marca, modelo, sn, estado, asignado, funcionario, usuario, edificio, 
                unidad_fl, piso, fecha_asignacion, fecha_baja, descripcion
            ) VALUES (
                :tipo, :marca, :modelo, :sn, :estado, :asignado, :funcionario, :usuario, :edificio,
                :unidadFL, :piso, :fechaAsignacion, :fechaBaja, :descripcion
            )";

            $stmt = $pdo_inv->prepare($sql);

            $stmt->execute([
                ':tipo' => $tipo,
                ':marca' => $marca,
                ':modelo' => $modelo,
                ':sn' => $sn,
                ':estado' => $estado,
                ':asignado' => $asignado,
                ':funcionario' => $funcionario,
                ':usuario' => $usuario,
                ':edificio' => $edificio,
                ':unidadFL' => $unidadFL,
                ':piso' => $piso,
                ':fechaAsignacion' => $fechaAsignacion,
                ':fechaBaja' => $fechaBaja,
                ':descripcion' => $descripcion,
            ]);

            echo "       
            <div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>
            <h1 style='color: blue;'>Producto guardado exitosamente.</h1>
            <a href='../pages/agregar.php' 
            style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color:rgb(248, 117, 22) color: white; text-decoration: none; border-radius: 5px;'>
            Volver al formulario
            </a>
            </div>
            ";
    } catch (PDOException $e) {
        echo "Error al guardar el producto: " . $e->getMessage();
    }
} else {
    echo "Acceso no permitido.";
}
?>

