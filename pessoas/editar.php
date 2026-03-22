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
  </div>
</main>
</body>
</html>