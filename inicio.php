<?php
session_start();
include __DIR__ . '/conexao.php';

if(isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];
    $resultado = $conn->prepare("SELECT nome FROM usuarios WHERE id = ?");
    $resultado->bind_param("i", $id_usuario);
    $resultado->execute();
    $res = $resultado->get_result();
    $usuario = $res->fetch_assoc();
    $nome_usuario = $usuario['nome'];
} else {
    $nome_usuario = null;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Início</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<header>
  <div class="navbar">
    <div class="wrapper">
      <nav style="display: flex; align-items: center; justify-content: space-between;">
        <h1>Imobiliária</h1>

        <div style="display: flex; align-items: center; gap: 15px;">
          <a href="/imobiliaria/inicio.php">Início</a>

          <?php 
          if(isset($_SESSION['id'])) {
              echo '<a href="/imobiliaria/imoveis/cadastrar.php">Cadastrar Imóvel</a>';
              echo '<a href="/imobiliaria/usuarios/cadastrar.php">Cadastrar Usuário</a>';

              $id_usuario = $_SESSION['id'];
              $resultado = $conn->prepare("SELECT nome FROM usuarios WHERE id = ?");
              $resultado->bind_param("i", $id_usuario);
              $resultado->execute();
              $res = $resultado->get_result();
              $usuario = $res->fetch_assoc();
              echo '<span class="navbar-user">Bem-vindo, ' . htmlspecialchars($usuario['nome']) . '</span>';
          }
          ?>
        </div>
      </nav>
    </div>
  </div>
</header>

<main>
  <div class="wrapper">
    <br>

    <!-- Lista de usuários só para admin -->
    <?php if($_SESSION['tipo'] === 'admin'): ?>
      <section>
        <?php include __DIR__ . '/usuarios/listar.php'; ?>
      </section>
      <br><br>
    <?php endif; ?>

    <!-- Lista de imóveis para todos -->
    <section>
      <?php include __DIR__ . '/imoveis/listar.php'; ?>
    </section>
  </div>
</main>
</body>
</html>