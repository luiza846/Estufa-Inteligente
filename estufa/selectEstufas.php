<?php
session_start();

try {
    $pdo = new PDO("mysql:host=estufa.mysql.dbaas.com.br;port=3306;dbname=estufa", "estufa", "Hunter231020@#");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro na conexão: ' . $e->getMessage()]);
    exit;
}

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['error' => 'Usuário não está autenticado.']);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

$sqlEmail = "SELECT email FROM usuario WHERE id_usuario = :id_usuario";
$stmtEmail = $pdo->prepare($sqlEmail);
$stmtEmail->bindParam(':id_usuario', $id_usuario);
$stmtEmail->execute();
$emailUsuario = $stmtEmail->fetch(PDO::FETCH_ASSOC);

if (!$emailUsuario) {
    echo json_encode(['error' => 'Usuário não encontrado.']);
    exit;
}

$email = $emailUsuario['email'];

$sqlEstufas = "SELECT id_produto, n_serie FROM produto WHERE email_produto = :email";
$stmtEstufas = $pdo->prepare($sqlEstufas);
$stmtEstufas->bindParam(':email', $email);
$stmtEstufas->execute();
$estufas = $stmtEstufas->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($estufas);
?>
