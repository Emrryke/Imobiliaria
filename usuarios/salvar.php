<?php
session_start();
include __DIR__ . '/../conexao.php';

// Campos obrigatórios
$nome = trim($_POST['nome']);
$cpf = trim($_POST['cpf']);
$sexo = $_POST['sexo'];
$data_nascimento = $_POST['data_nascimento'];
$email = trim($_POST['email']);
$senha = $_POST['senha'];

// Campos opcionais
$telefone = !empty($_POST['telefone']) ? trim($_POST['telefone']) : null;

// Tipo de usuário: só admin logado pode criar outro admin
$tipo = 'usuario';
if(isset($_POST['tipo']) && $_POST['tipo'] === 'admin' && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'){
    $tipo = 'admin';
}

// Validação dos campos obrigatórios
if(empty($nome) || empty($cpf) || empty($sexo) || empty($data_nascimento) || empty($email) || empty($senha)){
    $_SESSION['erro'] = "Preencha todos os campos obrigatórios!";
    header("Location: /imobiliaria/usuarios/cadastrar_usuario.php");
    exit;
}

// Hash da senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Prepared statement
$stmt = $conn->prepare("INSERT INTO usuarios (nome, cpf, sexo, data_nascimento, email, senha, telefone, tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", 
    $nome,
    $cpf,
    $sexo,
    $data_nascimento,
    $email,
    $senha_hash,
    $telefone,
    $tipo
);

if ($stmt->execute()) {
    $_SESSION['sucesso'] = "Usuário cadastrado com sucesso!";
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    $_SESSION['erro'] = "Erro ao cadastrar usuário: " . $stmt->error;
    header("Location: /imobiliaria/usuarios/cadastrar_usuario.php");
    exit;
}

$stmt->close();
$conn->close();
?>