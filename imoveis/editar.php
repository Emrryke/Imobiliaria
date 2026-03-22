<?php
session_start();
include("../conexao.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("SELECT * FROM imoveis WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$imovel = $result->fetch_assoc();
$stmt->close();

$usuarios = $conn->query("SELECT id, email FROM usuarios");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Editar Imóvel</title>
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
  <h2 class="mb-4">Editar Imóvel</h2>
  <form action="atualizar.php" method="POST">
    <input type="hidden" name="id" value="<?= $imovel['id'] ?>">

    Logradouro:<br>
    <input type="text" name="logradouro" value="<?= htmlspecialchars($imovel['logradouro']) ?>" required><br><br>

    Número:<br>
    <input type="text" name="numero" value="<?= htmlspecialchars($imovel['numero']) ?>" required><br><br>

    Bairro:<br>
    <input type="text" name="bairro" value="<?= htmlspecialchars($imovel['bairro']) ?>" required><br><br>

    Complemento:<br>
    <input type="text" name="complemento" value="<?= htmlspecialchars($imovel['complemento']) ?>"><br><br>

    Proprietário:<br>
    <select name="usuario_id" required>
      <?php while($u = $usuarios->fetch_assoc()): ?>
        <option value="<?= $u['id'] ?>" <?= ($u['id'] == $imovel['usuario_id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($u['email']) ?>
        </option>
      <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Atualizar</button>
  </form>
</div>
</div>
</main>
</body>
</html>