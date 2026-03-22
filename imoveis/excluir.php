<?php
session_start();
include("../conexao.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("DELETE FROM imoveis WHERE id=?");
$stmt->bind_param("i", $id);

if($stmt->execute()){
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
}else{
    echo "Erro: " . $stmt->error;
}