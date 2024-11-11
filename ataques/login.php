<?php
// Conexão ao banco de dados
$servername = "localhost";
$port = 7306;
$username = "root";
$password = "";
$dbname = "banco_de_dados";

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Verificar a conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Consulta vulnerável a SQL injection
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "Login bem-sucedido!";
} else {
    echo "Usuário ou senha incorretos!";
}

mysqli_close($conn);
?>
