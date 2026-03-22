<?php
session_start();
include("conexao.php");

// Verifica login
if (!isset($_SESSION['usuario'])) {
    header("Location: /imobiliaria/auth/login.php");
    exit;
}

// -----------------
// LISTA DE USUÁRIOS
// -----------------
$usuarios = $conn->query("SELECT id, nome, email, tipo FROM usuarios");

// -----------------
// LISTA DE IMÓVEIS
// -----------------
if ($_SESSION['tipo'] === 'admin') {
    $sql = "SELECT i.*, u.nome AS usuario_nome, u.email AS usuario_email 
            FROM imoveis i 
            JOIN usuarios u ON i.usuario_id = u.id";
    $imoveis = $conn->query($sql);
} else {
    $id = $_SESSION['id'];
    $sql = "SELECT i.*, u.nome AS usuario_nome, u.email AS usuario_email 
            FROM imoveis i 
            JOIN usuarios u ON i.usuario_id = u.id 
            WHERE i.usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $imoveis = $stmt->get_result();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Início - Imobiliária</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="navbar">
    <div class="wrapper">
      <nav>
        <h1>Imobiliária</h1>
        <div class="menu">
          <a href="/imobiliaria/auth/logout.php">Sair</a>
          <a href="/imobiliaria/usuarios/cadastrar.php">Cadastrar Usuário</a>
          <a href="/imobiliaria/imoveis/cadastrar.php">Cadastrar Imóvel</a>
        </div>
      </nav>
    </div>
  </div>
</header>

<main>
<div class="wrapper">

  <?php if(isset($_GET['msg'])): ?>
    <div class="alert alert-success">Operação realizada com sucesso!</div>
  <?php endif; ?>

  <!-- LISTA DE USUÁRIOS -->
  <h2>Usuários</h2>
  <table class="table table-striped table-bordered table-hover">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Tipo</th>
      <th>Ações</th>
    </tr>
    <?php while($u = $usuarios->fetch_assoc()): ?>
      <tr>
        <td><?= intval($u['id']) ?></td>
        <td><?= htmlspecialchars($u['nome']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= htmlspecialchars($u['tipo']) ?></td>
        <td>
          <a href="/imobiliaria/usuarios/editar.php?id=<?= intval($u['id']) ?>" class="btn btn-primary btn-sm">Editar</a>
          <a href="/imobiliaria/usuarios/excluir.php?id=<?= intval($u['id']) ?>" class="btn btn-danger btn-sm">Excluir</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <!-- LISTA DE IMÓVEIS -->
  <h2>Imóveis</h2>
  <table class="table table-striped table-bordered table-hover">
    <tr>
      <th>ID</th>
      <th>Logradouro</th>
      <th>Número</th>
      <th>Bairro</th>
      <th>Complemento</th>
      <th>Proprietário</th>
      <th>Ações</th>
    </tr>
    <?php while($i = $imoveis->fetch_assoc()): ?>
      <tr>
        <td><?= intval($i['id']) ?></td>
        <td><?= htmlspecialchars($i['logradouro']) ?></td>
        <td><?= htmlspecialchars($i['numero']) ?></td>
        <td><?= htmlspecialchars($i['bairro']) ?></td>
        <td><?= htmlspecialchars($i['complemento']) ?></td>
        <td><?= htmlspecialchars($i['usuario_nome'] ?: $i['usuario_email']) ?></td>
        <td>
          <a href="/imobiliaria/imoveis/editar.php?id=<?= intval($i['id']) ?>" class="btn btn-primary btn-sm">Editar</a>
          <a href="/imobiliaria/imoveis/excluir.php?id=<?= intval($i['id']) ?>" class="btn btn-danger btn-sm">Excluir</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</div>
</main>
</body>
</html>