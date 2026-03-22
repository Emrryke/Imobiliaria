<?php
session_start();
include __DIR__ . '/../conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Campos adicionais opcionais
$data_nascimento = !empty($_POST['data_nascimento']) ? $_POST['data_nascimento'] : null;
$telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : null;

// Tipo vem do form, mas só admin logado pode criar outro admin
$tipo = 'usuario';
if(isset($_POST['tipo']) && $_POST['tipo'] === 'admin' && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'){
    $tipo = 'admin';
}

// Ajuste na query para incluir os novos campos
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo, data_nascimento, telefone) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", 
    $nome,
    $email,
    $senha,
    $tipo,
    $data_nascimento,
    $telefone
);

if ($stmt->execute()) {
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro: " . $stmt->error;
}
?>