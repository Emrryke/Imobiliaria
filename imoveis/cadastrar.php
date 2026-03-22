<?php
include("../conexao.php");
$pessoas = $conn->query("SELECT id, nome FROM pessoas");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cadastrar Imóvel</title>
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

        Contribuinte:<br>
        <select name="pessoa_id" required>
            <option value="">Selecione o contribuinte</option>
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
  </div>
</main>
</body>
</html>