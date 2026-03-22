<?php
session_start();
include "conexao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($senha, $user['senha'])) {
    $_SESSION['usuario'] = $user['email'];
    header("Location: /imobiliaria/inicio.php");
    exit;
} else {
    header("Location: /imobiliaria/login.php?erro=1");
    exit;
}