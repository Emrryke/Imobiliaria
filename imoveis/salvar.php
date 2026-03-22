<?php
session_start();
include("../conexao.php");

$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$complemento = $_POST['complemento'];
$usuario_id = $_POST['usuario_id'];

$stmt = $conn->prepare("INSERT INTO imoveis (logradouro, numero, bairro, complemento, usuario_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $logradouro, $numero, $bairro, $complemento, $usuario_id);

if ($stmt->execute()) {
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}