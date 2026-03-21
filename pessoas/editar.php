<?php
include("../conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM pessoas WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Editar Pessoa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
  <h2 class="mb-4">Editar Pessoa</h2>

  <form action="atualizar.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    Nome:<br>
    <input type="text" name="nome" value="<?php echo $row['nome']; ?>" required><br><br>

    Data de nascimento:<br>
    <input type="date" name="data_nascimento" value="<?php echo $row['data_nascimento']; ?>" required><br><br>

    CPF:<br>
    <input type="text" name="cpf" value="<?php echo $row['cpf']; ?>" required><br><br>

    Sexo:<br>
    <select name="sexo" required>
      <option value="Masculino" <?php if($row['sexo']=="Masculino") echo "selected"; ?>>Masculino</option>
      <option value="Feminino" <?php if($row['sexo']=="Feminino") echo "selected"; ?>>Feminino</option>
    </select>
    <br><br>

    Telefone:<br>
    <input type="text" name="telefone" value="<?php echo $row['telefone']; ?>"><br><br>

    Email:<br>
    <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>

    <button type="submit">Atualizar</button>

  </form>
</div>
</body>
</html>