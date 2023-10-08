<?php
session_start();
if (isset($_SESSION['login'])) {
    header("location: dashboard.php");    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistema de Constructora UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: url('https://cms.polypal.com/uploads/2021/02/indocadores-gestion-almacen-1920x864.png') no-repeat center center fixed; 
            background-size: cover;
            align-items: center; 
            justify-content: center; 
            padding-top: 60px; /* Altura de la navbar */
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .card {
            background-color: white; 
            border-radius: 15px;
            width: 100%;
            max-width: 700px;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">

<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema de Constructora UNACH</a>
    </div>
</nav>

<div class="content-wrap d-flex align-items-center justify-content-center">
    <div class="card mt-4">
        <div class="card-header text-center">
            Acceso de Usuarios
        </div>
        <div class="card-body">
            <?php
            // Muestra el mensaje de error si se establece el parámetro 'error'
            if (isset($_GET['error']) && $_GET['error'] == '1') {
                echo '<div class="alert alert-danger text-center" role="alert">Contraseña incorrecta. Inténtalo de nuevo.</div>';
            } else {
            }
            ?>
            <form action="controller/validar.php" method="post" class="px-4 py-2">
                <div class="form-group">
                    <label for="loginUsername">Usuario</label>
                    <input type="text" class="form-control" id="loginUsername" name="usuario">
                </div>
                <div class="form-group">
                    <label for="loginPassword">Contraseña</label>
                    <input type="password" class="form-control" id="loginPassword" name="contrasena">
                </div>
                <button type="submit" id="login" class="btn btn-primary w-100 mt-3">Ingresar</button>
            </form>
        </div>
    </div>
</div>

<footer class="footer py-3 bg-dark mt-auto">
    <div class="container">
        <p class="m-0 text-center text-white"><b>Equipo | Zuñiga Losada Emilia | Culebro Prado Pedro Octavio </b></p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/login.js"></script>
</body>
</html>
