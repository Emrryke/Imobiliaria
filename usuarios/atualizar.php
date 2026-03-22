<?php
session_start();
include("../conexao.php");

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: /imobiliaria/login.php");
    exit;
}

$id = $_POST['id'];
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$cpf = $_POST['cpf'];
$sexo = $_POST['sexo'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$tipo = $_POST['tipo'];
$senha = $_POST['senha'];

// Se o usuário digitou uma senha, atualizamos, senão mantemos a antiga
if (!empty($senha)) {
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE usuarios SET nome=?, data_nascimento=?, cpf=?, sexo=?, telefone=?, email=?, tipo=?, senha=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $nome, $data_nascimento, $cpf, $sexo, $telefone, $email, $tipo, $senha_hash, $id);
} else {
    $stmt = $conn->prepare("UPDATE usuarios SET nome=?, data_nascimento=?, cpf=?, sexo=?, telefone=?, email=?, tipo=? WHERE id=?");
    $stmt->bind_param("sssssssi", $nome, $data_nascimento, $cpf, $sexo, $telefone, $email, $tipo, $id);
}

if ($stmt->execute()) {
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}