<?php
// Configurações do banco de dados
$servidor="127.0.0.1:3306";
$username = "root";
$password = "";

// Conexão com o banco de dados
$conexao = mysqli_connect($servidor, $username, $password);
if (!$conexao) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Seleção do banco de dados
mysqli_select_db($conexao, "gameCrud");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verifica se as informações estão na tabela Professores
    $queryProfessor = "SELECT * FROM professor WHERE email_responsavel = '$email' AND senha = '$senha'";
    $resultProfessor = mysqli_query($conexao, $queryProfessor);
    if (mysqli_num_rows($resultProfessor) > 0) {
        // Redireciona para a página 1
        header("Location: /GameSaber/AreaProfessor/professor.php");
        exit();
    }

    // Verifica se as informações estão na tabela Aluno
    $queryAluno = "SELECT * FROM aluno WHERE email_responsavel = '$email' AND senha = '$senha'";
    $resultAluno = mysqli_query($conexao, $queryAluno);
    if (mysqli_num_rows($resultAluno) > 0) {
        // Redireciona para a página 2
        header("Location: /GameSaber/AreaAluno/aluno.php");
        exit();
    }

    // Se as informações não estiverem em nenhuma tabela, exibe uma mensagem de erro
    echo "<script>
    
    window.location.href = '/GameSaber/index.php';
    alert('Email ou senha incorreta!');
    </script>";
}

mysqli_close($conexao);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/5500660c81.js" crossorigin="anonymous"></script>
    <title>Login - Game do Saber</title>
</head>
<body>
    <div class="login">
        <div class="container">
            <div class="container-logo">
                <img src="/GameSaber/img/lggame.png" alt="" width="300px" height="116px" class="logo">
            </div>
            <?php if (isset($erro)) { ?>
                <p style="color: red;"><?php echo $erro; ?></p>
            <?php } ?>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="signin">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <i class="fas fa-envelope iEmail"></i>
                <input type="password" id="senha" name="senha" placeholder="Senha" required><br>
                <i class="fas fa-lock iPassword"></i>
                <button type="submit">Entrar</button>
            </form>
            <div class="cadas">
                        <a href="/GameSaber/TelaCadastro/cadastrar.php">Cadastre-se</a>
            </div>
        </div>
    </div>
</body>
</html>