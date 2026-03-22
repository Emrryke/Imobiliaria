<?php
session_start();
include __DIR__ . '/../conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Tipo vem do form, mas só admin logado pode criar outro admin
$tipo = 'usuario';
if(isset($_POST['tipo']) && $_POST['tipo'] === 'admin' && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'){
    $tipo = 'admin';
}

$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", 
    $nome,
    $email,
    $senha,
    $tipo
);

if ($stmt->execute()) {
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}
?>