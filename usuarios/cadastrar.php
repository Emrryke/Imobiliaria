<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/imobiliaria/style.css">
  <title>Cadastrar Usuário</title>
</head>
<body>
<header>
<div class="navbar">
  <div class="wrapper">
    <nav>
      <h1>Imobiliária</h1>
      <div class="menu">
        <a href="/imobiliaria/inicio.php">Início</a>

        <?php 
          // Mostrar links de cadastro apenas se o usuário estiver logado
          if(isset($_SESSION['id'])) {
              echo '<a href="/imobiliaria/imoveis/cadastrar.php">Cadastrar Imóvel</a>';
              echo '<a href="/imobiliaria/usuarios/cadastrar.php">Cadastrar Usuário</a>';
          }
        ?>
      </div>
    </nav>
  </div>
</div>
</header>

<div class="wrapper">
  <div class="container mt-4">
    <h2>Cadastrar Usuário</h2>

    <?php
    if(isset($_SESSION['erro'])){
        echo '<p class="msg-erro">'.$_SESSION['erro'].'</p>';
        unset($_SESSION['erro']);
    }
    if(isset($_SESSION['sucesso'])){
        echo '<p class="msg-sucesso">'.$_SESSION['sucesso'].'</p>';
        unset($_SESSION['sucesso']);
    }
    ?>

    <form action="salvar.php" method="POST">
      Nome*:<br>
      <input type="text" name="nome" placeholder="Digite o nome" required><br><br>

      CPF*:<br>
      <input type="text" name="cpf" placeholder="Digite o CPF" required><br><br>

      Sexo*:<br>
      <select name="sexo" required>
        <option value="">Selecione</option>
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
        <option value="Outro">Outro</option>
      </select>
      <br><br>

      Data de nascimento*:<br>
      <input type="date" name="data_nascimento" required><br><br>

      Email*:<br>
      <input type="email" name="email" placeholder="Digite o email" required><br><br>

      Senha*:<br>
      <input type="password" name="senha" placeholder="Digite a senha" required><br><br>

      Telefone:<br>
      <input type="text" name="telefone" placeholder="Opcional"><br><br>

      <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin'): ?>
        Tipo de usuário:<br>
        <select name="tipo">
          <option value="usuario">Usuário</option>
          <option value="admin">Administrador</option>
        </select>
        <br><br>
      <?php endif; ?>

      <button type="submit">Cadastrar Usuário</button>
      <button type="button" onclick="window.location.href='/imobiliaria/inicio.php'">Cancelar</button>
    </form>
  </div>
</div>

</body>
</html>