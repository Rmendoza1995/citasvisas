<?php
$nodoc = !empty($_POST['idcita']) ? $_POST['idcita'] : (!empty($_GET['idcita']) ? $_GET['idcita'] : NULL);

?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title>Actualizar datos</title>
<style>
    body {
        background-color: white; 
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    
    .container {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        max-width: 700px;
        width: 100%;
    }
    
    .container img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .container img.first-image {
        width: 230px;
        max-height: 230px;
        object-fit: cover;
        object-position: center;
    }
    
    .labelest {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
    display: block;
}

    
    .estiloinputs {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        color: #333;
        width:80%;
        margin-bottom: 15px;
        text-align: center;
    }
</style>
</head>
<body>
    <div class="container">
        <a href="buscador.php" class="btn btn-primary">Atras</a>
        <br><br> <?php
        date_default_timezone_set('America/Mexico_City');

        include("configuracion.php");

        // Consulta para obtener los datos de todos los usuarios
        $sql = "SELECT * FROM citasvisa WHERE idcita = '$nodoc'";
       
        $resultado = $link->query($sql);
        if ($resultado->num_rows > 0) {
       // Iterar sobre los resultados y mostrar cada campo como un elemento de la lista
while ($fila = $resultado->fetch_assoc()) {
    echo "<form method='POST' action='".$_SERVER["PHP_SELF"]."'>";
    echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>"; // Campo oculto para enviar el ID del registro
    echo "<input type='submit' class='btn btn-danger' name='eliminar' value='Eliminar'>";
    echo "</form>";


    echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
    echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>"; // Campo oculto para enviar el ID del registro

    echo "<span class='labelest'>Nombre:</span>";
    echo "<input type='text' name='nombre' class='estiloinputs' value='" . $fila['nombre'] . "' required><br>";
              
    echo "<span class='labelest'>No. Cita:</span>";
    echo "<input type='text'  name='idcita' class='estiloinputs' value='" . $fila['idcita'] . "' required><br>";
                
    echo "<span class='labelest'>tipo:</span>";
    echo "<input type='text' name='tipo' class='estiloinputs' value='" . $fila['tipo'] . "' ><br>";
                
    echo "<span class='labelest'>fecha vigencia:</span>";
    echo "<input type='text' name='fecha_vigencia' class='estiloinputs' value='" . $fila['fecha_vigencia'] . "' required><br>";
    echo "<span class='labelest'>Horario vigencia:</span>";
    echo "<input type='text' name='horario' class='estiloinputs' value='" . $fila['horario'] . "' required><br>";
            
    

    echo "<span class='labelest'>Horario CITA:</span>";
    echo "<input type='text' name='horacita' class='estiloinputs' value='" . $fila['horacita'] . "' required><br>";
    echo "<span class='labelest'>Horario CITA:</span>";
    echo "<input type='text' name='fecha_cita' class='estiloinputs' value='" . $fila['fecha_cita'] . "' required><br>";
        


    echo "<span class='labelest'>Comentarios Adicionales:</span>";
    echo "<textarea type='text' name='comentariosadicionales' class='estiloinputs' value='" . $fila['comentariosadicionales'] . "' >" . $fila['comentariosadicionales'] . "</textarea>";
    echo "</br>";

    echo "<span class='labelest'>Correo:</span>";
    echo "<input type='text' name='Correo' class='estiloinputs' value='" . $fila['Correo'] . "' required><br>";
    
    echo "<span class='labelest'>Identificacion de solicitud :</span>";
    echo "<input type='text' name='identificacionsolicitud' class='estiloinputs' value='" . $fila['identificacionsolicitud'] . "' required><br>";
    
    echo "<span class='labelest'>Numero referencia :</span>";
    echo "<input type='text' name='numreferencia' class='estiloinputs' value='" . $fila['numreferencia'] . "' required><br>";
    
    echo "<span class='labelest'>Contraseña:</span>";
    echo "<input type='text' name='contrase' class='estiloinputs' value='" . $fila['contrase'] . "' required><br>";
              
   
    echo "<input type='submit' class='btn btn-success' name='actualizar' value='Actualizar'>"; // Botón de actualizar
    echo "</form>";
}

        } else {
            echo "No se encontraron Visas Registradas.";
        }
        ?>
    </div>
    
    <?php

if (isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    
    // Consulta para eliminar el registro
    $sql_eliminar = "DELETE FROM citasvisa  WHERE id = $id";
var_dump( $sql_eliminar);
    if ($link->query($sql_eliminar) === TRUE) {
        echo "Registro eliminado correctamente.";
        echo "<script>alert('Registro eliminado correctamente.');
        window.location.href='buscador.php';
        </script>";
        // Redirigir o mostrar un mensaje, etc.
    } else {
        echo "Error al eliminar el registro: " . $link->error;
    }
}






    // Si se envió el formulario de actualización
    if(isset($_POST['actualizar'])) {
        // Obtener los datos del formulario
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $idcita = $_POST['idcita'];
        $tipo = $_POST['tipo'];
        $fecha_vigencia = $_POST['fecha_vigencia'];
        $comentariosadicionales = $_POST['comentariosadicionales'];
        $horario = $_POST['horario'];
        $correo = $_POST['correo'];
        $identificacionsolicitud = $_POST['identificacionsolicitud'];
        $numreferencia = $_POST['numreferencia'];
        $contrase = $_POST['contrase'];
    
        // Preparar la consulta de actualización
        $sql = "UPDATE citasvisa   SET 
                nombre='$nombre', 
                idcita	='$idcita', 
                tipo='$tipo', 
                fecha_vigencia='$fecha_vigencia', 
                horario='$horario', 
                Correo='$correo',
                identificacionsolicitud='$identificacionsolicitud',
                numreferencia='$numreferencia',
                contrase='$contrase',
                comentariosadicionales='$comentariosadicionales'           
                WHERE id=$id";
    
        // Ejecutar la consulta de actualización
        if ($link->query($sql) === TRUE) {
            echo "<script>alert('Los datos se han actualizado correctamente.');
            window.location.href='buscador.php';
            </script>";
        } else {
            echo "Error al actualizar los datos: " . $link->error;
        }
    }
    ?>
</body>
</html>
