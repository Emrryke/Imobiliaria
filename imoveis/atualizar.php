<?php
session_start();
include("../conexao.php");

$id = $_POST['id'];
$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$complemento = $_POST['complemento'];
$usuario_id = $_POST['usuario_id'];

$stmt = $conn->prepare("UPDATE imoveis SET logradouro=?, numero=?, bairro=?, complemento=?, usuario_id=? WHERE id=?");
$stmt->bind_param("ssssii", $logradouro, $numero, $bairro, $complemento, $usuario_id, $id);

if($stmt->execute()){
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
}else{
    echo "Erro: " . $stmt->error;
}