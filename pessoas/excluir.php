<?php
include __DIR__ . '/../conexao.php';

$id = $_GET['id'];

// Verifica se tem imóveis
$sql = "SELECT COUNT(*) as total FROM imoveis WHERE pessoa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Se tem imóveis e ainda não confirmou
if ($row['total'] > 0 && !isset($_GET['confirmar'])) {
    echo "
    <script>
        if(confirm('Esta pessoa possui imóveis. Deseja excluir tudo?')) {
            window.location.href = 'excluir.php?id=$id&confirmar=1';
        } else {
            window.location.href = '/imobiliaria/inicio.php';
        }
    </script>
    ";
    exit;
}

// Se confirmou OU não tem imóveis

// 1. Excluir imóveis
$sql = "DELETE FROM imoveis WHERE pessoa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

// 2. Excluir pessoa
$sql = "DELETE FROM pessoas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

// Redireciona
header("Location: /imobiliaria/inicio.php?msg=ok");
exit;
?>