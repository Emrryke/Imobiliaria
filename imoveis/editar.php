<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../conexao.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// BUSCA IMÓVEL
$stmt = $conn->prepare("SELECT id, logradouro, numero, bairro, complemento, pessoa_id FROM imoveis WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id_db, $logradouro, $numero, $bairro, $complemento, $pessoa_id);
$stmt->fetch();
$stmt->close();

if(!$id_db){
  echo "Imóvel não encontrado";
  exit;
}

// BUSCA PESSOAS
$pessoas = $conn->query("SELECT id, nome FROM pessoas");
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
          <a href="/imobiliaria/pessoas/cadastrar.php">Cadastrar Pessoa</a>
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
        <input type="hidden" name="id" value="<?= $id_db ?>">
        Logradouro:<br>
        <input type="text" name="logradouro" value="<?= $logradouro ?>" required><br><br>

        Número:<br>
        <input type="text" name="numero" value="<?= $numero ?>" required><br><br>

        Bairro:<br>
        <input type="text" name="bairro" value="<?= $bairro ?>" required><br><br>

        Complemento:<br>
        <input type="text" name="complemento" value="<?= $complemento ?>"><br><br>

        Contribuinte:<br>
        <select name="pessoa_id" required>
          <?php while($p = $pessoas->fetch_assoc()): ?>
            <option value="<?= $p['id'] ?>" <?= ($p['id'] == $pessoa_id) ? 'selected' : '' ?>>
              <?= $p['nome'] ?>
            </option>
          <?php endwhile; ?>
        </select>
        <br><br>

        <button type="submit">Atualizar</button>
      </form>
    </div>
  </div>
</main>
</body>
</html>