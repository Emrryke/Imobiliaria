<?php

  include("../conexao.php");

  $nome = $_POST['nome'];
  $data_nascimento = $_POST['data_nascimento'];
  $cpf = $_POST['cpf'];
  $sexo = $_POST['sexo'];
  $telefone = $_POST['telefone'];
  $email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO pessoas 
(nome, data_nascimento, cpf, sexo, telefone, email) 
VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", 
    $nome,
    $data_nascimento,
    $cpf,
    $sexo,
    $telefone,
    $email
);

  if ($stmt->execute()) {
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}

?>