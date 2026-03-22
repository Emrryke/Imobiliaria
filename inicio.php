<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /imobiliaria/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
          <a href="/imobiliaria/pessoas/cadastrar.php">Cadastrar Pessoa</a>
          <a href="/imobiliaria/logout.php">Sair</a>
        </div>
      </nav>
    </div>
  </div>
</header>

<main>
  <div class="wrapper">
    <br>

    <section>
      <?php include 'pessoas/listar.php'; ?>
    </section>

    <br><br>

    <section>
      <?php include 'imoveis/listar.php'; ?>
    </section>
  </div>
</main>

</body>
</html>