<?php
require_once 'conexion_prov.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $tipo = $_POST['tipo'];
            if ($tipo === 'otro' && !empty($_POST['otroTipo'])) {
                $tipo = $_POST['otroTipo'];
        }
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $sn = $_POST['sn'];
        $mac = $_POST['mac'] ?? null;
        $hostname = $_POST['hostname'] ?? null;
        $estado = $_POST['estado'];
        $asignado = $_POST['asignado'];
        $funcionario = $_POST['funcionario'] ?? null;
        $usuario = $_POST['usuario'] ?? null;
        $edificio = $_POST['edificio'];
        $unidadFL = $_POST['unidadFL'];
        $piso = $_POST['piso'] ?? null;
        $fechaAsignacion = !empty($_POST['fechaAsignacion']) ? $_POST['fechaAsignacion'] : null;
        $fechaBaja = !empty($_POST['fechaBaja']) ? $_POST['fechaBaja'] : null;
        $descripcion = $_POST['descripcion'] ?? null;

        $sql = "INSERT INTO productos_prov (
                tipo, marca, modelo, sn, mac, hostname, estado, asignado, funcionario, usuario, edificio, 
                unidad_fl, piso, fecha_asignacion, fecha_baja, descripcion) 
                VALUES (
                :tipo, :marca, :modelo, :sn, :mac, :hostname, :estado, :asignado, 
                :funcionario, :usuario, :edificio, :unidadFL, :piso, :fechaAsignacion, 
                :fechaBaja, :descripcion
                )";

        $stmt = $pdo_prov->prepare($sql);
        $stmt->execute([
            ':tipo' => $tipo,
            ':marca' => $marca,
            ':modelo' => $modelo,
            ':sn' => $sn,
            ':mac' => $mac,
            ':hostname' => $hostname,
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
        <h2 style='color: green;'>Producto guardado exitosamente.</h2>
        <a href='../pages/agregar_prov.php' 
        style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color:rgb(248, 117, 22); color: white; text-decoration: none; border-radius: 5px;'>
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
