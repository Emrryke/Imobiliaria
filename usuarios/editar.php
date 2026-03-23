<?php
session_start();
include("../conexao.php");

// Só admin pode editar
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: /imobiliaria/login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Usuário não encontrado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuário</title>
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
          <a href="/imobiliaria/imoveis/cadastrar.php">Cadastrar Imóvel</a>
          <a href="/imobiliaria/usuarios/cadastrar.php">Cadastrar Usuário</a>
        </div>
      </nav>
    </div>
  </div>
</header>

<div class="wrapper">
  <div class="container mt-4">
    <h2>Editar Usuário</h2>

    <form action="atualizar.php" method="POST">
      <input type="hidden" name="id" value="<?= $user['id'] ?>">

      Nome:<br>
      <input type="text" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required><br><br>

      Data de nascimento:<br>
      <input type="date" name="data_nascimento" value="<?= $user['data_nascimento'] ?>"><br><br>

      CPF:<br>
      <input type="text" name="cpf" value="<?= htmlspecialchars($user['cpf']) ?>"><br><br>

      Sexo:<br>
      <select name="sexo">
        <option value="">Selecione</option>
        <option value="Masculino" <?= ($user['sexo']=='Masculino')?'selected':'' ?>>Masculino</option>
        <option value="Feminino" <?= ($user['sexo']=='Feminino')?'selected':'' ?>>Feminino</option>
      </select>
      <br><br>

      Telefone:<br>
      <input type="text" name="telefone" value="<?= htmlspecialchars($user['telefone']) ?>"><br><br>

      Email:<br>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

      Senha:<br>
      <input type="password" name="senha" placeholder="Deixe vazio para não alterar"><br><br>

      Tipo:<br>
      <select name="tipo" required>
        <option value="admin" <?= ($user['tipo']=='admin')?'selected':'' ?>>Admin</option>
        <option value="user" <?= ($user['tipo']=='user')?'selected':'' ?>>User</option>
      </select>
      <br><br>

      <button type="submit">Atualizar</button>
      <button type="button" onclick="window.location.href='/imobiliaria/inicio.php'">Cancelar</button>
    </form>
  </div>
</div>
</body>
</html>