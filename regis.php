<?php
include("configuracion.php");
session_start();

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$comentariosadicionales = $_POST['comentariosadicionales'];
$tipo = $_POST['tipo'];
$horario = $_POST['horario'];
$correo = $_POST['correo'];
$identificacionsolicitud = $_POST['identificacionsolicitud'];
$numreferencia = $_POST['numreferencia'];
$contrase = $_POST['contrase'];

$fecha_cita = $_POST['fecha_cita'];
$horacita = $_POST['horacita'];

$fecha_vigencia = $_POST['fecha_vigencia'];
$idcita = $_POST['idcita'];


// Preparar la consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO citasvisa (nombre, idcita, tipo, fecha_vigencia,horario, comentariosadicionales, usuarioregistro,Correo,identificacionsolicitud,numreferencia,contrase,fecha_cita, horacita) 
        VALUES ('$nombre', '$idcita', '$tipo','$fecha_vigencia','$horario' ,'$comentariosadicionales', '" . $_SESSION['usuario'] . "','$correo','$identificacionsolicitud','$numreferencia','$contrase','$fecha_cita','$horacita')";
// Ejecutar la consulta SQL
var_dump($sql);

if ($link->query($sql) === TRUE) {
    // Mensaje de alerta y redireccionamiento
    echo '<script>alert("Los datos se han guardado correctamente."); window.location.href = "buscador.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $link->error;

}

// Cerrar la conexión a la base de datos
$link->close();
?>
