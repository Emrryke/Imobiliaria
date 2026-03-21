<?php

include("../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$cpf = $_POST['cpf'];
$sexo = $_POST['sexo'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$stmt = $conn->prepare("UPDATE pessoas SET 
    nome=?, 
    data_nascimento=?, 
    cpf=?, 
    sexo=?, 
    telefone=?, 
    email=? 
    WHERE id=?");

$stmt->bind_param("ssssssi",
    $nome,
    $data_nascimento,
    $cpf,
    $sexo,
    $telefone,
    $email,
    $id
);

if ($stmt->execute()) {
    header("Location: listar.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}

?>