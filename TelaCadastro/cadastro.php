<?php

// conexão com o banco de dados
$servidor = "127.0.0.1:3306";
$username = "root";
$password = "";

$conn = new mysqli($servidor, $username, $password);

// Verificando se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o banco de dados e as tabelas existem, caso contrário, cria-os
$queryCriarBanco = "CREATE DATABASE IF NOT EXISTS gameCrud";
mysqli_query($conn, $queryCriarBanco);

mysqli_select_db($conn, "gameCrud");


// criando a tabela "aluno"
$sql = "CREATE TABLE IF NOT EXISTS aluno (
    id_aluno INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    idade INT(3),
    escola VARCHAR(50) NOT NULL,
    email_responsavel VARCHAR(50),
    senha VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) !== true) {
    die("Erro ao criar tabela aluno: " . $conn->error);
}

// criando a tabela "professor"
$sql = "CREATE TABLE IF NOT EXISTS professor (
    id_professor INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    cpf VARCHAR(11),
    escola VARCHAR(50) NOT NULL,
    email_responsavel VARCHAR(50),
    senha VARCHAR(50) NOT NULL,
    codigo_verif VARCHAR(8) NOT NULL
)";

if ($conn->query($sql) !== true) {
    die("Erro ao criar tabela professor: " . $conn->error);
}

$sql = "CREATE TABLE IF NOT EXISTS verificacao (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(8) NOT NULL,
    nome_professor VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) !== true) {
    die("Erro ao criar tabela professor: " . $conn->error);
}

// recebimento dos dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo_cadastro = isset($_POST["submit"]) ? $_POST["submit"] : "";
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $idade = isset($_POST["idade"]) ? $_POST["idade"] : "";
    $escola = isset($_POST["escola"]) ? $_POST["escola"] : "";
    $cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : "";
    $email_responsavel = isset($_POST["email_responsavel"]) ? $_POST["email_responsavel"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
    $codVerif = isset($_POST["codigo_verif"]) ? $_POST["codigo_verif"] : "";

    // Verifica se o código de verificação existe na tabela "verificacao"
    $stmt_verificacao = $conn->prepare("SELECT codigo FROM verificacao WHERE codigo = ?");
    $stmt_verificacao->bind_param("s", $codVerif);
    $stmt_verificacao->execute();
    $result_verificacao = $stmt_verificacao->get_result();

    // inserção dos dados na tabela correta
    if ($tipo_cadastro == "aluno") {
        $sql = "INSERT INTO aluno (nome, idade, escola, email_responsavel, senha) VALUES (?, ?, ?, ?, ?)";
    } elseif ($tipo_cadastro == "professor") {
        if ($result_verificacao->num_rows > 0) {
            // O código de verificação existe na tabela, insere os dados na tabela "professor"
            $sql = "INSERT INTO professor (nome, cpf, escola, email_responsavel, senha, codigo_verif) VALUES (?, ?, ?, ?, ?, ?)";
            // $stmt->bind_param("ssssss", $nome, $cpf, $escola, $email_responsavel, $senha, $codVerif);
        } else {
            echo "<script>
            alert('Codigo de verificação incorreto!');
            window.location.href = '/GameSaber/index.php';
        </script>";
            $stmt_verificacao->close();
            $conn->close();
            exit;
        }
    }
    

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    // bind dos parâmetros e execução do statement
    if ($tipo_cadastro == "aluno") {
        $params = [$nome, $idade, $escola, $email_responsavel, $senha];
        $stmt->bind_param("sisss", ...$params);
    } elseif ($tipo_cadastro == "professor") {
        $params = [$nome, $cpf, $escola, $email_responsavel, $senha, $codVerif];
        $stmt->bind_param("ssssss", ...$params);
    }

    if ($stmt->execute()) {
        echo "<script>
        alert('Cadastrado com sucesso!');
        window.location.href = '/GameSaber/index.php';
    </script>";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
    $stmt->close();
}

// Fecha a conexão com o banco de dados
$conn->close();
?>



   