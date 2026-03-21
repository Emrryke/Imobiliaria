<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../conexao.php");

$id = $_POST['id'];
$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$complemento = $_POST['complemento'];
$pessoa_id = $_POST['pessoa_id'];

$stmt = $conn->prepare("UPDATE imoveis SET 
    logradouro=?, 
    numero=?, 
    bairro=?, 
    complemento=?, 
    pessoa_id=? 
    WHERE id=?");

$stmt->bind_param("ssssii",
    $logradouro,
    $numero,
    $bairro,
    $complemento,
    $pessoa_id,
    $id
);

if ($stmt->execute()) {
    header("Location: listar.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}
?>