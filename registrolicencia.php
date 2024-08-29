<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Licencias de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .form-control, .form-control:focus {
            border-radius: 10px;
            border-color: #ced4da;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Registro de Citas Nuevas</h2>
        <form action="regis.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="idcita" class="form-label">ID. Cita:</label>
                <input type="text" id="idcita" name="idcita" class="form-control" maxlength="20">
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" id="tipo" name="tipo" class="form-control" maxlength="50">
            </div>
            <div class="mb-3">
                <label for="comentariosadicionales" class="form-label">Comentarios Adicionales:</label>
                <textarea id="comentariosadicionales" name="comentariosadicionales" class="form-control" maxlength="500"></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_vigencia" class="form-label">Fecha Vigencia:</label>
                <input type="date" id="fecha_vigencia" name="fecha_vigencia" class="form-control">
            </div>
            <div class="mb-3">
                <label for="fecha_vigencia" class="form-label">Horario Vigencia:</label>
                <input type="time" id="horario" name="horario" class="form-control">
            </div>


            <div class="mb-3">
                <label for="fecha_vigencia" class="form-label">Fecha Cita:</label>
                <input type="date" id="fecha_cita" name="fecha_cita" class="form-control">
            </div>
            <div class="mb-3">
                <label for="fecha_vigencia" class="form-label">Hora Cita:</label>
                <input type="time" id="horacita" name="horacita" class="form-control">
            </div>


            <div class="mb-3">
                <label for="comentariosadicionales" class="form-label">Correo Electronico :</label>
                <input id="correo" name="correo" class="form-control" />
            </div>

            <div class="mb-3">
                <label for="identificacionsolicitud" class="form-label">Identificación de la solicitud  o numero de  caso:</label>
                <input id="identificacionsolicitud" name="identificacionsolicitud" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="numreferencia" class="form-label">NUMERO DE REFERENCIA DEL COMPROBANTE DE  PAGO:</label>
                <input id="numreferencia" name="numreferencia" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="contrase" class="form-label">Contraseña:</label>
                <input id="contrase" name="contrase" class="form-control" />
            </div>


            <div class="text-center">
                <input type="submit" value="Guardar" class="btn btn-custom">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
