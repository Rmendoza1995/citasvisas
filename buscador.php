<?php
session_start(); 
include("configuracion.php");

$filtro = isset($_POST['filtro']) ? $_POST['filtro'] : '';

$sql = "SELECT * FROM citasvisa";
if ($filtro) {
    $hoy = date('Y-m-d');
    switch ($filtro) {
        case 'reciente':
            $sql .= " WHERE fecha_vigencia >= '$hoy' limit 600";
            break;
        case 'proxima':
            $fechaProxima = date('Y-m-d', strtotime('+7 days'));
            $sql .= " WHERE fecha_vigencia BETWEEN '$hoy' AND '$fechaProxima' limit 600";
            break;
        case 'pasadas':
            $sql .= " WHERE fecha_vigencia < '$hoy' limit 600";
            break;
    }
}

$resultado = $link->query($sql);

if (!isset($_SESSION['usuario'])) {
    echo '<script type="text/javascript">
            alert("Usted No tiene Permitido el Acceso a esta parte.");
            window.location.href="registrousuarios/IniciarSesion.php";
          </script>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('registrousuarios/images/bg6.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Noto Sans', sans-serif;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1rem;
            color: #333;
        }
        th, td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            margin-bottom: 10px;
        }
        a {
            font-size: 18px;
            color: #007bff;
        }
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .form-select {
            display: inline-block;
            width: auto;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="cerrar_sesion.php" class="btn btn-primary">Cerrar Sesión</a>
            <a href="registrolicencia.php" class="btn btn-primary">Crear Nueva cita</a>
        </div>

        <form method="post" action="" class="mb-3">
            <div class="input-group">
                <input type="text" name="idcita" id="idcita" class="form-control" placeholder="ID. Cita" required>
                <button class="btn btn-primary">Buscar para editar</button>
            </div>
        </form>

        <!--form method="post" action="" class="mb-3">
            <div class="input-group">
                <input type="text" name="idcita" id="idcita2" class="form-control" placeholder="ID. Cita" required>
                <button class="btn btn-primary">Buscar compartir QR</button>
            </div>
        </form-->

        <form method="post" action="" class="mb-2">
            <div >
                <select class="form-select" id="fechaFiltro" name="filtro" onchange="this.form.submit()">
                    <option value="">Ver citas filtradas</option>
                    <option value="reciente" <?php if ($filtro == 'reciente') echo 'selected'; ?>>Citas Proximas +7 dias</option>
                    <option value="proxima" <?php if ($filtro == 'proxima') echo 'selected'; ?>>Citas Recientes 7 dias</option>
                    <option value="pasadas" <?php if ($filtro == 'pasadas') echo 'selected'; ?>>Citas Pasadas</option>
                </select>
            </div>
        </form>

        <h1 class="text-center">Lista de Citas Recientes</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>No. Cita</th>
                        <th>Tipo</th>
                        <th>Fecha Vigencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="citasTabla">
                    <?php
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['idcita'] . "</td>";
                        echo "<td>" . $fila['tipo'] . "</td>";
                        echo "<td class='fecha'>" . date('d/m/Y', strtotime($fila['fecha_vigencia'])) . "</td>";
                        echo "<td><a href='upd1.php?idcita=" . $fila['idcita'] . "'>Modificar</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    $link->close();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
