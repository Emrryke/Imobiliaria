<?php
session_start();
include __DIR__ . '/../conexao.php';

$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$complemento = $_POST['complemento'];

// Se admin escolhe o usuário, senão é sempre o próprio
if($_SESSION['tipo'] === 'admin' && isset($_POST['usuario_id'])){
    $usuario_id = (int)$_POST['usuario_id'];
} else {
    $usuario_id = $_SESSION['id'];
}

$stmt = $conn->prepare("INSERT INTO imoveis (logradouro, numero, bairro, complemento, usuario_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", 
    $logradouro, 
    $numero, 
    $bairro, 
    $complemento, 
    $usuario_id
);

if ($stmt->execute()) {
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}
?>