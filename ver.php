<?php
include("configuracion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcita = $_POST['idcita'];
    $fecha = $_POST['fecha'];
    $identificaion = $_POST['identificaion'];
    $refece = $_POST['refece'];
    $contra = $_POST['contra'];

    $sql = "SELECT * FROM citasvisa WHERE idcita = ? AND identificacionsolicitud = ? AND numreferencia = ? AND contrase = ?";
    $stmt = $link->prepare($sql);

    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $link->error);
    }

    $stmt->bind_param('ssss', $idcita, $identificaion, $refece, $contra);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $citaEncontrada = false;
        $fecha_formateada = ""; // Para la fecha de vigencia
        $fechacita_formateada = ""; // Para la fecha de la cita CAS
        $fechaHoy = new DateTime();

        while ($fila = $resultado->fetch_assoc()) {
            // Formatear fecha de vigencia
            $timestamp_vigencia = strtotime($fila['fecha_vigencia']);
            $fecha_vigencia = new DateTime($fila['fecha_vigencia']);
            $fecha_cita = new DateTime($fila['fecha_cita']);

            $dia_vigencia = date('d', $timestamp_vigencia);
            $mes_vigencia = date('F', $timestamp_vigencia);
            $anio_vigencia = date('Y', $timestamp_vigencia);

            switch ($mes_vigencia) {
                case 'January': $mes_vigencia = 'Enero'; break;
                case 'February': $mes_vigencia = 'Febrero'; break;
                case 'March': $mes_vigencia = 'Marzo'; break;
                case 'April': $mes_vigencia = 'Abril'; break;
                case 'May': $mes_vigencia = 'Mayo'; break;
                case 'June': $mes_vigencia = 'Junio'; break;
                case 'July': $mes_vigencia = 'Julio'; break;
                case 'August': $mes_vigencia = 'Agosto'; break;
                case 'September': $mes_vigencia = 'Septiembre'; break;
                case 'October': $mes_vigencia = 'Octubre'; break;
                case 'November': $mes_vigencia = 'Noviembre'; break;
                case 'December': $mes_vigencia = 'Diciembre'; break;
            }

            $fecha_formateada = "$dia_vigencia $mes_vigencia $anio_vigencia";

            // Formatear fecha de la cita CAS
            $timestamp_cita = strtotime($fila['fecha_cita']);
            $dia_cita = date('d', $timestamp_cita);
            $mes_cita = date('F', $timestamp_cita);
            $anio_cita = date('Y', $timestamp_cita);

            switch ($mes_cita) {
                case 'January': $mes_cita = 'Enero'; break;
                case 'February': $mes_cita = 'Febrero'; break;
                case 'March': $mes_cita = 'Marzo'; break;
                case 'April': $mes_cita = 'Abril'; break;
                case 'May': $mes_cita = 'Mayo'; break;
                case 'June': $mes_cita = 'Junio'; break;
                case 'July': $mes_cita = 'Julio'; break;
                case 'August': $mes_cita = 'Agosto'; break;
                case 'September': $mes_cita = 'Septiembre'; break;
                case 'October': $mes_cita = 'Octubre'; break;
                case 'November': $mes_cita = 'Noviembre'; break;
                case 'December': $mes_cita = 'Diciembre'; break;
            }

            $fechacita_formateada = "$dia_cita $mes_cita $anio_cita";

            if ($fila['fecha_vigencia'] === $fecha) {
                $citaEncontrada = true;
                $mensaje = '';
                $icono = '';

                if ($fecha_vigencia < $fechaHoy) {
                    $mensaje = 'Cita pasada o caducada';
                    $icono = 'fas fa-exclamation-triangle text-warning';
                } else {
                    $mensaje = 'Scheduled Appointment';
                     $icono = 'fas fa-check-circle text-success';
                }

                echo '<div class="text-center">';
                echo '<i class="' . $icono . '" style="font-size: 48px;"></i>';
                echo '<h3><i class="fas fa-calendar-alt"></i> ' . $mensaje . '</h3>';
                echo '</div>';
                echo "<p><strong>Applicant's name:</strong> " . $fila['nombre'] . "</p>";
                echo "<p><strong>Type:</strong> " . $fila['tipo'] . "</p>";
                echo "<p><i style='color:green;' class='fas fa-calendar-alt'></i><strong style='color:black;'> Effective Date:</strong> " . $fecha_formateada . ", " . $fila['horario'] . " Local Time Mexico City.</p>";
                echo "<p><i style='color:green;' class='fas fa-calendar-alt'></i><strong style='color:black;'> Effective Date CAS:</strong> " . $fechacita_formateada . ", " . $fila['horacita'] . " Local Time Mexico City.</p>";
                echo "<hr>-<a target='_blank' href='https://maps.app.goo.gl/ysw8cpfgf2CvmLcW8'>How to get there?</a>";

                break;
            }
        }

        if (!$citaEncontrada) {
            $fechaRegistrada = new DateTime($fila['fecha_vigencia']);
            if ($fechaRegistrada < $fechaHoy) {
                echo '<p><i class="fas fa-exclamation-triangle text-warning" style="font-size: 24px;"></i> Passed or expired appointment</p>';
                echo "<p><strong>Effective Date:</strong> " . $fecha_formateada . ", " . $fila['horario'] . " Local Time Mexico City.</p>";
            } else {
                echo '<p>This appointment ID exists, but is scheduled for another date.</p>';
                echo '<p>Registered date: ' . $fecha_formateada . '</p>';
            }
        }

    } else {
        echo '<p>There are no appointments scheduled with that ID.</p>';
    }

    $stmt->close();
}
$link->close();
?>
