<?php

// Conexión a la base de datos usando PDO
$host = 'localhost';
$db   = 'id21358317_miempresa';
$user = 'id21358317_adminep';
$pass = 'Cityunach*1';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error al conectarse con la base de datos: " . $e->getMessage());
}

// Verificando si el ID del producto ha sido enviado por GET
if(isset($_GET['idp'])) {
    $idp = $_GET['idp'];

    // Validaciones básicas 
    if(empty($idp)) {
        die('No se proporcionó ID del producto.');
    }

    // Eliminar producto de la base de datos usando sentencias preparadas de PDO
    try {
        $stmt = $pdo->prepare('DELETE FROM tb_productos WHERE idPro = ?');
        $stmt->execute([$idp]);
        
        // Redireccionar inmediatamente después de eliminar el producto
    header("Location: ../dashboard.php?deleted=true");
        exit();  // Asegurarte de que el script se detiene aquí
    } catch (PDOException $e) {
        echo "Error al eliminar el producto: " . $e->getMessage();
    }

} else {
    echo "No se proporcionó ID del producto.";
}

?>

