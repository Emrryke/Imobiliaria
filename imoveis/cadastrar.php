<?php
include("../conexao.php");
$pessoas = $conn->query("SELECT id, nome FROM pessoas");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cadastrar Imóvel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
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
<select name="pessoa_id" required>
  <option value="">Selecione o proprietário</option>

<?php
while($p = $pessoas->fetch_assoc()){
    echo "<option value='".$p['id']."'>".$p['nome']."</option>";
}
?>

</select>

<br><br>

<button type="submit">Cadastrar Imóvel</button>

</form>
</div>
</body>
</html>