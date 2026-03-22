<?php
session_start();
include("../conexao.php");

// Só admin pode salvar
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: /imobiliaria/login.php");
    exit;
}

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$cpf = $_POST['cpf'];
$sexo = $_POST['sexo'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$tipo = $_POST['tipo'];

$stmt = $conn->prepare("INSERT INTO usuarios (nome, data_nascimento, cpf, sexo, telefone, email, senha, tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nome, $data_nascimento, $cpf, $sexo, $telefone, $email, $senha, $tipo);

if ($stmt->execute()) {
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}