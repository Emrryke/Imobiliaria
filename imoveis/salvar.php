<?php
session_start();
include __DIR__ . '/../conexao.php';

// Recebe os dados do formulário
$logradouro = trim($_POST['logradouro']);
$numero     = trim($_POST['numero']);
$bairro     = trim($_POST['bairro']);
$complemento = trim($_POST['complemento']);

// Se admin escolhe o usuário, senão é sempre o próprio
if($_SESSION['tipo'] === 'admin' && isset($_POST['usuario_id'])){
    $usuario_id = (int)$_POST['usuario_id'];
} else {
    $usuario_id = $_SESSION['id'];
}

// Validação dos campos obrigatórios
if(empty($logradouro) || empty($numero) || empty($bairro) || empty($usuario_id)){
    $_SESSION['erro'] = "Preencha todos os campos obrigatórios!";
    header("Location: /imobiliaria/imoveis/cadastrar.php"); // ajuste conforme a página de formulário
    exit;
}

// Prepared statement para inserir
$stmt = $conn->prepare("INSERT INTO imoveis (logradouro, numero, bairro, complemento, usuario_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", 
    $logradouro, 
    $numero, 
    $bairro, 
    $complemento, 
    $usuario_id
);

if ($stmt->execute()) {
    $_SESSION['sucesso'] = "Imóvel cadastrado com sucesso!";
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}
?>