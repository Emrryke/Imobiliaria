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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
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
</body>
</html>