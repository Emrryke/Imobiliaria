<?php
session_start();
include("../conexao.php");

$usuarios = $conn->query("SELECT id, email FROM usuarios");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cadastrar Imóvel</title>
<link rel="stylesheet" href="../style.css">
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
          <a href="/imobiliaria/usuarios/cadastrar.php">Cadastrar Usuário</a>
        </div>
      </nav>
    </div>
  </div>
</header>

<main>
  <div class="wrapper">
    <div class="container mt-4">
      <h2 class="mb-4">Cadastrar Imóvel</h2>
      <form action="salvar.php" method="POST">
        Logradouro:<br>
        <input type="text" name="logradouro" required><br><br>

        Número:<br>
        <input type="text" name="numero" required><br><br>

        Bairro:<br>
        <input type="text" name="bairro" required><br><br>

        Complemento:<br>
        <input type="text" name="complemento"><br><br>

        Proprietário:<br>
        <select name="usuario_id" required>
            <option value="">Selecione o usuário</option>
          <?php while($u = $usuarios->fetch_assoc()): ?>
            <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['email']) ?></option>
          <?php endwhile; ?>
        </select>
        <br><br>
        
        <button type="submit">Cadastrar Imóvel</button>
      </form>
    </div>
  </div>
</main>
</body>
</html>