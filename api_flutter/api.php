<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "conexion.php";

// Debug: Log all incoming data
error_log("POST data: " . print_r($_POST, true));
error_log("Raw input: " . file_get_contents('php://input'));
error_log("Content-Type: " . (isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : 'not set'));

// Leer la acción enviada desde Flutter
$action = $_POST['action'] ?? '';

// Debug: Log the action received
error_log("Action received: " . $action);

switch ($action) {
    // CREATE
    case 'create':
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)");
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':password' => $password
        ]);
        echo json_encode(["status" => "ok", "message" => "Usuario creado"]);
        break;
    // READ
    case 'read':
        $stmt = $pdo->query("SELECT id, nombre, email FROM usuarios");
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($usuarios);
        break;
    // UPDATE
    case 'update':
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $stmt = $pdo->prepare("UPDATE usuarios SET nombre = :nombre WHERE id = :id");
        $stmt->execute([
            ':nombre' => $nombre,
            ':id' => $id
        ]);
        echo json_encode(["status" => "ok", "message" => "Usuario actualizado"]);
        break;
    // DELETE
    case 'delete':
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id]);
        echo json_encode(["status" => "ok", "message" => "Usuario eliminado"]);
        break;
    default:
        echo json_encode(["status" => "error", "message" => "Acción no válida"]);
        break;
}
?>