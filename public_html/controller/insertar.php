<?php
$host = 'localhost';
$db   = 'id21358317_miempresa';
$user = 'id21358317_adminep';
$pass = 'Cityunach*1';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Corrección aquí
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];


try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Extraer datos del formulario
$productName  = $_POST['productName'];
$productPrice = $_POST['productPrice'];
$productStock = $_POST['productStock'];

// Validaciones básicas
if(empty($productName) || empty($productPrice) || empty($productStock)) {
    die('Por favor completa todos los campos.');
}

// Insertar datos en la base de datos
try {
    $stmt = $pdo->prepare('INSERT INTO tb_productos (Nombre, Precio, Ext) VALUES (?, ?, ?)');
    $stmt->execute([$productName, $productPrice, $productStock]);
    header("Location: ../dashboard.php?success=true");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
