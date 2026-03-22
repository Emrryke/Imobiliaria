<?php
session_start();

// Só admin pode cadastrar novos usuários
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: /imobiliaria/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Usuário</title>
  <link rel="stylesheet" href="/imobiliaria/style.css">
</head>
<body>

<header>
  <div class="navbar">
    <div class="wrapper">
      <nav>
        <h1>Imobiliária</h1>
        <div class="menu">
          <a href="/imobiliaria/inicio.php">Início</a>
          <a href="/imobiliaria/usuarios/cadastrar.php">Cadastrar Usuário</a>
          <a href="/imobiliaria/logout.php">Sair</a>
        </div>
      </nav>
    </div>
  </div>
</header>

<main>
  <div class="wrapper">
    <div class="container mt-4">
      <h2 class="mb-4">Cadastrar Usuário</h2>

      <form action="salvar.php" method="POST">
        Nome:<br>
        <input type="text" name="nome" required><br><br>

        Data de nascimento:<br>
        <input type="date" name="data_nascimento"><br><br>

        CPF:<br>
        <input type="text" name="cpf"><br><br>

        Sexo:<br>
        <select name="sexo">
          <option value="">Selecione</option>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
        </select>
        <br><br>

        Telefone:<br>
        <input type="text" name="telefone"><br><br>

        Email:<br>
        <input type="email" name="email" required><br><br>

        Senha:<br>
        <input type="password" name="senha" required><br><br>

        Tipo:<br>
        <select name="tipo" required>
          <option value="">Selecione</option>
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
        <br><br>

        <button type="submit">Cadastrar</button>
      </form>
    </div>
  </div>
</main>

</body>
</html>