<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Programadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar {
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .modal-content {
            border-radius: 15px;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .modal-body {
            font-size: 16px;
        }
        .text-center h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            padding: 30px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Citas Visa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!--ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contactar</a>
                    </li>
                </ul-->
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1>Citas Programadas</h1>
        </div>
        <div class="card">
            <div class="card-header text-center">
                <h5><i class="fas fa-calendar-alt"></i> Consultar Cita</h5>
            </div>
            <div class="card-body">
                <!-- Botón para abrir el primer modal -->
                <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#consultarCitaModal">
                    Consultar Cita
                </button>
            </div>
        </div>
    </div>

    <!-- Primer Modal para consultar cita -->
    <div class="modal fade" id="consultarCitaModal" tabindex="-1" aria-labelledby="consultarCitaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultarCitaModalLabel">Consultar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="consultaCitaForm" method="post">
                        <div class="mb-3">
                            <label for="idcita" class="form-label">ID CHECK</label>
                            <input type="text" class="form-control" id="idcita" name="idcita" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">DAY OF DATE</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <button type="submit" class="btn btn-custom">CHECK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Segundo Modal para mostrar el resultado -->
    <div class="modal fade" id="resultadoModal" tabindex="-1" aria-labelledby="resultadoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultadoModalLabel">Resultado de la Consulta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="resultadoModalBody">
                    <!-- Aquí se mostrará el resultado de la consulta -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#consultaCitaForm').on('submit', function(e) {
                e.preventDefault();

                var idcita = $('#idcita').val();
                var fecha = $('#fecha').val();

                $.ajax({
                    url: 'ver.php',
                    type: 'POST',
                    data: { idcita: idcita, fecha: fecha },
                    success: function(response) {
                        $('#resultadoModalBody').html(response);
                        $('#consultarCitaModal').modal('hide');
                        $('#resultadoModal').modal('show');
                    },
                    error: function() {
                        alert('Error en la consulta. Por favor, intenta de nuevo.');
                    }
                });
            });
        });
    </script>
</body>
</html>
