
          
<?php
session_start();


if (!isset($_SESSION['nome'])) {
    header("Location: login.php"); 
    exit();
}


if ($_SESSION['nome'] !== 'Administrador') {
    echo "Acesso negado.";
    exit();
}

?>

<html>
<body>
    <center>
        <?php
        echo "<h1>Lista de Usuários Cadastrados</h1>";
        echo "<ul>";
        
        include('conexao.php');

        $query = "SELECT nome FROM login";
        $resultado = mysqli_query($conexao, $query);

        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<li>" . $row['nome'] . "</li>";
            }
        } else {
            echo "Erro ao recuperar usuários cadastrados.";
        }

        mysqli_close($conexao);

        echo "</ul>";
        ?>
        <br>
        <a href="index.php">Voltar</a>
    </center>
</body>
</html>