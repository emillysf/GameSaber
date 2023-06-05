<?php
// Estabeleça a conexão com o banco de dados MySQL
$servidor="127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "gamecrud";

$conn = new mysqli($servidor, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Receba os dados da requisição AJAX
$divId = $_POST["divId"];
$nome = $_POST["nome"];
$data = date("Y-m-d H:i:s"); // Use a data atual ou modifique conforme necessário

// Prepare a declaração SQL usando prepared statements
$stmt = $conn->prepare("INSERT INTO turmas (nome, data) VALUES (?, ?)");
$stmt->bind_param("ss", $nome, $data);

// Execute a declaração preparada
if ($stmt->execute()) {
    echo "Dados da div foram salvos com sucesso.";
} else {
    echo "Erro ao salvar os dados da div: " . $conn->error;
}

// Receba os dados da requisição AJAX
$divId = $_POST["divId"];
$nome = $_POST["nome"];

// Prepare a declaração SQL usando prepared statements
$stmt = $conn->prepare("UPDATE turmas SET nome = ? WHERE id = ?");
$stmt->bind_param("si", $nome, $divId);

// Execute a declaração preparada
if ($stmt->execute()) {
    echo "Dados da div foram atualizados com sucesso.";
} else {
    echo "Erro ao atualizar os dados da div: " . $stmt->error;
}

$stmt->close();
$stmt->close();
$conn->close();
?>