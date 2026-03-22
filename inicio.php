<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /imobiliaria/auth/login.php");
    exit;
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
      <nav>
        <h1>Imobiliária</h1>
        <div class="menu">
          <a href="/imobiliaria/inicio.php">Início</a>
          <a href="/imobiliaria/imoveis/cadastrar.php">Cadastrar Imóvel</a>
          <?php if($_SESSION['tipo'] === 'admin'): ?>
            <a href="/imobiliaria/usuarios/cadastrar.php">Cadastrar Usuário</a>
          <?php endif; ?>
          <a href="/imobiliaria/auth/logout.php">Sair</a>
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