<?php

// Datos para el QR
$nodoc = !empty($_POST['idcita']) ? $_POST['idcita'] : (!empty($_GET['idcita']) ? $_GET['idcita'] : NULL);
$enlace = "https://proyectosviews.000webhostapp.com/index.php?idcita=" . urlencode($nodoc); // Eliminar las comillas simples y codificar la URL

// Incluir la librería PHP QR Code
require "phpqrcode/qrlib.php";

// Directorio donde se almacenarán los códigos QR generados
$dir = 'qrcodes/';

// Si el directorio no existe, crearlo
if (!file_exists($dir)) {
    mkdir($dir);
}

// Nombre del archivo QR (puedes personalizarlo según tus necesidades)
$nombreArchivo = $dir . 'qr_code_' . $nodoc . '.png';
$tamañoModulo = 5;

QRcode::png($enlace, $nombreArchivo, QR_ECLEVEL_L, 10, $tamañoModulo);
echo '        <a href="buscador.php" class="btn btn-primary" style="font-size:20px;">Atras</a><br>';
echo "Comparte el QR con el cliente : verifica si funciona ,Enlace creado:  ", $enlace,'<br>';

// Mostrar el código QR en una etiqueta img
echo '<center><img width="300px" src="'.$nombreArchivo.'" alt="Código QR">';
echo '<br>';
echo '<a href="'.$nombreArchivo.'" download="qr_code_'. $nodoc .'.png" style="font-size:20px;">Descargar QR</a>';

?>
