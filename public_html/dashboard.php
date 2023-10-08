<?php
session_start();
if (!isset($_SESSION['login']))
    header("location: index.php");    
?>
<html>
<head>
    <title>Sistema de Almacén UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f5f7;
        }
        .navbar {
            font-size: 1.25rem;
            background-color: #343a40;
        }
        .content-wrap {
            flex: 1;
            padding: 20px;
        }
        .footer {
            flex-shrink: 0;
        }
        table {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
        .modal-content {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="d-flex flex-column h-100">

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema de Almacén UNACH</a>
        
        <!-- Dropdown menu -->
        <div class="btn-group">
            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['nomusuario']; ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" aria-disabled="true" href="#"><?php echo $_SESSION['nomusuario']; ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="cerrar.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="content-wrap">
    <center>
        <br><br><br><br>
        <form action="dashboard.php" method="GET">
            <div class="form-group">
                <label><b>Buscar producto por precio mayor a:</b></label>
                <input type="text" name="pre" class="form-control" style="width: 200px; display: inline;" />
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>
        
        <br><br>
        <hr>
        <br><br>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Nuevo Producto
        </button>
        <?php
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '<div class="alert alert-success text-center mt-3" role="alert">Producto agregado exitosamente.</div>';
}

if (isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
    echo '<div class="alert alert-warning text-center mt-3" role="alert">Producto eliminado exitosamente.</div>';
}

?>

        <br><br>

        <?php
            include('conexion.php');
            $con = conectaDB();
            if(isset($_GET['pre'])==true)        
                $sql ="select idPro,Nombre,Precio from tb_productos where Precio > ".$_GET['pre'];
            else
                $sql ="select idPro,Nombre,Precio from tb_productos";
            
            echo "<table class='table' style='width:570px;'>";
            echo "<thead class='table-dark'>";
            echo "<th>Nombre</th>";
            echo "<th>Precio</th>";
            echo "<th></th>";
            echo "</thead>";
            echo "<tbody>";
            
            $resultado = mysqli_query($con,$sql);  
            while($fila = mysqli_fetch_row($resultado)){
        
                echo "<tr>";
                    echo "<td>".$fila[1]."</td>";
                    echo "<td>".$fila[2]."</td>";
                    echo "<td><a href='controller/eliminar.php?idp=".$fila[0]."'><img src='iconoeliminar.png' width='20' heigth='20'></a></td>";
                echo "</tr>";
            
            }
            
            echo "</tbody> </table>";
        ?>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¡El producto ha sido guardado con éxito!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="controller/insertar.php" method="post" id="productForm">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Nombre del producto</label>
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Precio</label>
                                <input type="number" step="0.01" class="form-control" id="productPrice" name="productPrice" required>
                            </div>
                            <div class="mb-3">
                                <label for="productStock" class="form-label">Existencia</label>
                                <input type="number" class="form-control" id="productStock" name="productStock" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" form="productForm">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
        
    </center>
</div>

<footer class="footer bg-dark text-white text-center py-3">
    <p>© 2023 Sistema de Almacén UNACH. Todos los derechos reservados.</p>
</footer>

</body>
</html>

