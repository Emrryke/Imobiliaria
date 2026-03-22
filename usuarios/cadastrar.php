<?php
session_start();
include __DIR__ . '/../conexao.php';

// Define tipo de usuário a criar
$tipo = 'usuario'; // padrão
if(isset($_GET['tipo']) && $_GET['tipo'] === 'admin' && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'){
    $tipo = 'admin';
}
?>

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
      <input type="hidden" name="tipo" value="<?= $tipo ?>">

      Nome:<br>
      <input type="text" name="nome" required><br><br>

      Email:<br>
      <input type="email" name="email" required><br><br>

      Senha:<br>
      <input type="password" name="senha" required><br><br>

      <button type="submit">Cadastrar</button>
    </form>
  </div>
</div>

</body>
</html>