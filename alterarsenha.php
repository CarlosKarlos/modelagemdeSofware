<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: login.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $conexao = mysqli_connect('localhost', 'root', '', 'projetoa3','3306');

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $novasenha = $_POST['nova_senha'];
    $confirmarsenha = $_POST['confirmar_senha'];

    if ($novasenha !== $confirmarsenha) {
        die("Dados não correspondem.");
    }

    $nomeUsuario = $_SESSION['nome']; 
    $senhaHash = $novasenha;

    $sql = "UPDATE login SET senha = '$senhaHash' WHERE nome = '$nomeUsuario'";
    if (mysqli_query($conexao, $sql)) {
        echo "Senha atualizada";
        echo '<br><br>';
        echo '<a href="login.php">Voltar para a página de login</a>'; 
    } else {
        echo "Erro ao atualizar senha: " . mysqli_error($conexao);
    }

    
    mysqli_close($conexao);
}
?>

<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>

<body>
  <center>
 
    <h1>Alterar Senha</h1>
    <form method="POST" action="alterarsenha.php">
      <label for="nova_senha">Nova senha:</label>
      <input type="password" name="nova_senha" id="nova_senha" required><br>

      <label for="confirmar_senha">Confirmar nova senha:</label>
      <input type="password" name="confirmar_senha" id="confirmar_senha" required><br>

      <input type="submit" value="Alterar Senha">
    </form>
  </center>
</body>

</html>
