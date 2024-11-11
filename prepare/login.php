<?php
// Conexão ao banco de dados
$servername = "localhost";
$port = 7306;
$username = "root";
$password = "";
$dbname = "banco_de_dados";

// Configuração da conexão PDO
$dsn = "mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Inicialização da conexão PDO
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Consulta segura usando consultas preparadas
$username = $_POST['username'];
$password = $_POST['password'];

// Preparar a consulta
$sql = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $pdo->prepare($sql);

// Verificar se a preparação da consulta foi bem-sucedida
if ($stmt) {
    // Executar a consulta
    $stmt->execute([$username, $password]);
    
    // Obter o resultado da consulta
    $user = $stmt->fetch();

    // Verificar se foi encontrado um usuário
    if ($user) {
        echo "Login bem-sucedido!";
    } else {
        echo "Usuário ou senha incorretos!";
    }
} else {
    // Tratar caso a preparação da consulta falhe
    echo "Erro na preparação da consulta";
}
?>
