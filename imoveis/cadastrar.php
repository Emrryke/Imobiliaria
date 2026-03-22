<?php
session_start();
include __DIR__ . '/../conexao.php';

// Se admin, busca todos usuários para dropdown
if($_SESSION['tipo'] === 'admin'){
    $usuarios = $conn->query("SELECT id, nome FROM usuarios");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/imobiliaria/style.css">
  <title>Cadastrar Imóvel</title>
</head>
<body>

<div class="wrapper">
  <div class="container mt-4">
    <h2>Cadastrar Imóvel</h2>
    <form action="salvar.php" method="POST">

      Logradouro:<br>
      <input type="text" name="logradouro" required><br><br>

      Número:<br>
      <input type="text" name="numero" required><br><br>

      Bairro:<br>
      <input type="text" name="bairro" required><br><br>

      Complemento:<br>
      <input type="text" name="complemento"><br><br>

      <?php if($_SESSION['tipo'] === 'admin'): ?>
        Contribuinte:<br>
        <select name="usuario_id" required>
          <?php while($u = $usuarios->fetch_assoc()): ?>
            <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nome']) ?></option>
          <?php endwhile; ?>
        </select>
        <br><br>
      <?php else: ?>
        <input type="hidden" name="usuario_id" value="<?= $_SESSION['id'] ?>">
      <?php endif; ?>

      <button type="submit">Cadastrar Imóvel</button>
    </form>
  </div>
</div>

</body>
</html>