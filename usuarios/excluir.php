<?php
session_start();
include("../conexao.php");

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: /imobiliaria/login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Antes de excluir, removemos todos os imóveis do usuário
$stmt = $conn->prepare("DELETE FROM imoveis WHERE usuario_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Agora excluímos o usuário
$stmt = $conn->prepare("DELETE FROM usuarios WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: /imobiliaria/inicio.php?msg=ok");
exit;