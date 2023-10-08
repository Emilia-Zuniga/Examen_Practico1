<?php
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
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Recogemos el usuario y contraseña del POST
$usuarioIngresado = $_POST['usuario'];
$contrasenaIngresada = $_POST['contrasena'];

// Verificamos en la base de datos
$stmt = $pdo->prepare("SELECT * FROM tb_usuarios WHERE NomUser = :usuario AND Passwd = :contrasena");
$stmt->bindParam(':usuario', $usuarioIngresado);
$stmt->bindParam(':contrasena', $contrasenaIngresada);
$stmt->execute();

// Si encontramos un registro que coincida, iniciamos sesión y redireccionamos
if ($stmt->fetch()) {
    session_start();
    $_SESSION['login'] = "true";
    $_SESSION['nomusuario'] = $usuarioIngresado;
    header("location: ../dashboard.php");
} else {
    header("location: ../index.php?error=1");
}

?>
