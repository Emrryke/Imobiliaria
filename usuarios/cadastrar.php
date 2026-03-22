<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/imobiliaria/style.css">
  <title>Cadastrar Usuário</title>
</head>
<body>

<div class="wrapper">
  <div class="container mt-4">
    <h2>Cadastrar Usuário</h2>

    <form action="salvar.php" method="POST">
      Nome:<br>
      <input type="text" name="nome" required><br><br>

      Email:<br>
      <input type="email" name="email" required><br><br>

      Senha:<br>
      <input type="password" name="senha" required><br><br>

      Data de nascimento:<br>
      <input type="date" name="data_nascimento"><br><br>

      Telefone:<br>
      <input type="text" name="telefone"><br><br>

      <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
        Tipo de usuário:<br>
        <select name="tipo">
          <option value="usuario">Usuário</option>
          <option value="admin">Administrador</option>
        </select>
        <br><br>
      <?php endif; ?>

      <button type="submit">Cadastrar</button>
    </form>
  </div>
</div>

</body>
</html>