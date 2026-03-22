<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/imobiliaria/style.css">
  <title>Login</title>
</head>
<body>

<div class="wrapper">
  <div class="login">
    <h2>Login</h2>

    <?php if(isset($_GET['erro'])): ?>
      <p style="color:red;">Email ou senha inválidos</p>
    <?php endif; ?>

    <form method="POST" action="verifica_login.php">
      <input type="email" name="email" placeholder="Email" required><br><br>
      <input type="password" name="senha" placeholder="Senha" required><br><br>
      <button class="btn btn-primary">Entrar</button>
    </form>
  </div>
</div>

</body>
</html>