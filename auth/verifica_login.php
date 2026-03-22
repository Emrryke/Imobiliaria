<?php
session_start();
include __DIR__ . '/../conexao.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = $_POST['senha'] ?? '';

if (!$email || !$senha) {
    header("Location: /imobiliaria/auth/login.php?erro=1");
    exit;
}

$stmt = $conn->prepare("SELECT id, email, senha, tipo FROM usuarios WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($user && password_verify($senha, $user['senha'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['usuario'] = $user['email'];
    $_SESSION['nome'] = $user['nome'];  // <-- adiciona o nome na sessão
    $_SESSION['tipo'] = $user['tipo'];
    header("Location: /imobiliaria/inicio.php");
    exit;
} 

else {
    header("Location: /imobiliaria/auth/login.php?erro=1");
    exit;
}