<?php

include("../conexao.php");

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM pessoas WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: /imobiliaria/inicio.php?msg=sucesso");
    exit;
} else {
    echo "Erro ao excluir: " . $stmt->error;
}

?>